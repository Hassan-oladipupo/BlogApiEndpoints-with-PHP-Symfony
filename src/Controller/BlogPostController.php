<?php

namespace App\Controller;

use App\Entity\AppUser;
use App\Entity\Comment;
use App\Entity\BlogPost;
use Psr\Log\LoggerInterface;
use App\Service\ImgurService;
use App\Service\BlogPostFormatter;
use App\Repository\CommentRepository;
use App\Repository\BlogPostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BlogPostController extends AbstractController
{
    private LoggerInterface $logger;
    private BlogPostFormatter $blogPostFormatter;
    private ImgurService $imgurService;

    public function __construct(LoggerInterface $logger, BlogPostFormatter $blogPostFormatter, ImgurService $imgurService)
    {
        $this->logger = $logger;
        $this->blogPostFormatter = $blogPostFormatter;
        $this->imgurService = $imgurService;
    }

    #[Route('/api/blog/post', name: 'app_blog_post', methods: ['GET'])]
    public function retrieveAllBlog(BlogPostRepository $repo): JsonResponse
    {
        try {
            $blogPosts = $repo->findAllWithComments();
            $response = $this->blogPostFormatter->formatBlogPosts($blogPosts);
            return new JsonResponse($response, 200);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());
            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/api/blog-post/top-liked', name: 'app_blog_topliked', methods: ['GET'])]
    public function topLiked(BlogPostRepository $repo): JsonResponse
    {
        try {
            $topLike = $repo->findAllWithMinLikes(2);
            $response = $this->blogPostFormatter->formatBlogPosts($topLike);
            return new JsonResponse($response, 200);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());
            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/api/blog/post/{blog}', name: 'app_blog_singlepost', methods: ['GET'])]
    public function retrieveSingleBlog(BlogPost $blog): JsonResponse
    {
        try {
            if (!$blog) {
                return new JsonResponse(['message' => 'Post not found'], 404);
            }
            $response = $this->blogPostFormatter->formatBlogPost($blog);
            return new JsonResponse($response, 200);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());
            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/api/blog-post/follows', name: 'app_blog_post_follows', methods: ['GET'])]
    public function followPosts(BlogPostRepository $repo): JsonResponse
    {
        try {
            /** @var AppUser $currentUser */
            $currentUser = $this->getUser();

            if (!$currentUser instanceof AppUser) {
                return new JsonResponse(['message' => 'User not authenticated'], 401);
            }

            $followPosts = $repo->findAllByAuthors($currentUser->getFollow());

            if (empty($followPosts)) {
                return new JsonResponse(['message' => 'No posts yet'], 200);
            }

            $json = $this->blogPostFormatter->formatBlogPosts($followPosts);

            return new JsonResponse($json, 200, [], true);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());
            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/api/blog-post/add', name: 'app_blog_posts_add', methods: ['POST'])]
    public function addBlog(
        Request $request,
        BlogPostRepository $repo,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        LoggerInterface $logger,
        ImgurService $imgurService
    ): JsonResponse {
        try {
            /** @var AppUser $currentUser */
            $currentUser = $this->getUser();
            if (!$currentUser) {
                return $this->json(['message' => 'Only logged-in users can add a post.'], 400);
            }

            $data = $request->request->all();
            $blogPost = $serializer->deserialize(json_encode($data), BlogPost::class, 'json', ['groups' => 'blogpost']);

            $errors = $validator->validate($blogPost);
            if (count($errors) > 0) {
                $errorMessages = [];
                /** @var \Symfony\Component\Validator\ConstraintViolation $error */
                foreach ($errors as $error) {
                    $errorMessages[] = $error->getMessage();
                }
                return $this->json(['errors' => $errorMessages], 422);
            }

            /** @var UploadedFile|null $blogImage */
            $blogImage = $request->files->get('blogImage');
            if ($blogImage instanceof UploadedFile) {
                $constraints = [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Please upload a valid PNG/JPEG image',
                    ]),
                ];

                $violations = $validator->validate($blogImage, $constraints);
                if (count($violations) > 0) {
                    return new JsonResponse(['message' => $violations[0]->getMessage()], 400);
                }

                try {
                    $stream = fopen($blogImage->getPathname(), 'r');
                    $uploadResult = $imgurService->uploadImageStream($stream);
                    fclose($stream);

                    if ($uploadResult['success']) {
                        $blogPost->setBlogImage($uploadResult['data']['link']);
                    } else {
                        throw new \Exception('Imgur upload failed: ' . $uploadResult['message']);
                    }
                } catch (FileException $e) {
                    $logger->error('File upload failed: ' . $e->getMessage());
                    return new JsonResponse(['message' => 'File upload failed: ' . $e->getMessage()], 500);
                } catch (\Exception $e) {
                    $logger->error('Imgur upload failed: ' . $e->getMessage());
                    return new JsonResponse(['message' => 'Imgur upload failed: ' . $e->getMessage()], 500);
                }
            } else {
                $blogPost->setBlogImage(null);
            }

            $blogPost->setAuthor($currentUser);
            $repo->save($blogPost, true);

            return $this->json([
                'message' => "Blog added successfully",
                'blogPost' => $blogPost
            ], 201, [], ['groups' => 'blogpost']);
        } catch (\Exception $e) {
            $logger->error('An error occurred: ' . $e->getMessage());
            return $this->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }



    #[Route('/api/blog-post/{blog}/edit', name: 'app_blog_post_edit', methods: ['PUT'])]
    public function editBlog(
        BlogPost $blog,
        Request $request,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        LoggerInterface $logger,
        Security $security,
        ImgurService $imgurService
    ): JsonResponse {
        $currentUser = $security->getUser();

        if ($blog->getAuthor() !== $currentUser) {
            return $this->json(['message' => 'You do not have permission to edit this blog post.'], 403);
        }

        $jsonData = $request->request->all();
        $blogImage = $request->files->get('blogImage');

        try {
            $editBlog = $serializer->deserialize(json_encode($jsonData), BlogPost::class, 'json', [
                AbstractNormalizer::OBJECT_TO_POPULATE => $blog
            ]);


            $errors = $validator->validate($editBlog);
            if (count($errors) > 0) {
                $errorMessages = [];
                foreach ($errors as $error) {
                    $errorMessages[] = $error->getMessage();
                }
                $logger->error('Validation errors: ' . json_encode($errorMessages));
                return $this->json(['message' => $errorMessages], 422);
            }

            if ($blogImage instanceof UploadedFile) {
                $constraints = [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/jpeg', 'image/png'],
                        'mimeTypesMessage' => 'Please upload a valid PNG/JPEG image',
                    ]),
                ];

                $violations = $validator->validate($blogImage, $constraints);
                if (count($violations) > 0) {
                    return new JsonResponse(['message' => $violations[0]->getMessage()], 400);
                }

                try {
                    $stream = fopen($blogImage->getPathname(), 'r');
                    $uploadResult = $imgurService->uploadImageStream($stream);
                    fclose($stream);

                    // Log Imgur upload result
                    $logger->info('Imgur upload result: ' . json_encode($uploadResult));

                    if ($uploadResult['success']) {
                        $editBlog->setBlogImage($uploadResult['data']['link']);
                    } else {
                        throw new \Exception('Imgur upload failed: ' . $uploadResult['message']);
                    }
                } catch (FileException $e) {
                    $logger->error('File upload failed: ' . $e->getMessage());
                    return $this->json(['message' => 'File upload failed: ' . $e->getMessage()], 500);
                }
            }

            // Persist changes using the Entity Manager
            $entityManager->persist($editBlog);
            $entityManager->flush();

            return $this->json([
                'message' => "Blog edited successfully",
                'blogPost' => $editBlog
            ], 200, [], ['groups' => 'blogpost']);
        } catch (\Exception $e) {
            $logger->error('An error occurred: ' . $e->getMessage());
            return $this->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/api/blog-post/{blog}/comment', name: 'app_blog_post_comment', methods: ['POST'])]
    public function addComment(BlogPost $blog, Request $request, CommentRepository $repo, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        try {
            $data = $request->getContent();

            $blogComment = $serializer->deserialize($data, Comment::class, 'json', ['groups' => 'comment']);

            $errors = $validator->validate($blogComment);

            if (count($errors) > 0) {
                $errorMessages = [];
                /** @var \Symfony\Component\Validator\ConstraintViolation $error */
                foreach ($errors as $error) {
                    $errorMessages[] = $error->getMessage();
                }

                return $this->json(['message' => $errorMessages], 422);
            }

            $blogComment->setBlogPost($blog);
            $repo->save($blogComment, true);

            return $this->json([
                'message' => "Comment added successfully",
                'comment' => $blogComment
            ], 201, [], ['groups' => 'comment']);
        } catch (\Exception $e) {
            return $this->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }



    #[Route('/api/blog-post/{id}', name: 'app_blog_post_delete', methods: ['DELETE'])]
    public function deleteBlogPost(int $id, BlogPostRepository $repo, ManagerRegistry $doctrine, LoggerInterface $logger, Security $security): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $currentUser = $security->getUser();

        try {
            $blogPost = $repo->find($id);

            if (!$blogPost) {
                return new JsonResponse(['message' => 'Blog post not found'], 404);
            }

            if ($blogPost->getAuthor() !== $currentUser) {
                return $this->json(['message' => 'You do not have permission to delete this blog post.'], 403);
            }

            $entityManager->remove($blogPost);
            $entityManager->flush();

            return new JsonResponse(['message' => 'Blog post deleted successfully'], 200);
        } catch (\Exception $e) {
            $logger->error('An error occurred: ' . $e->getMessage());

            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}

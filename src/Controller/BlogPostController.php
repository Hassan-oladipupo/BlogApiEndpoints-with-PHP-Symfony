<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\BlogPost;
use Psr\Log\LoggerInterface;
use App\Repository\CommentRepository;
use App\Repository\BlogPostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class BlogPostController extends AbstractController
{

    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }



    #[Route('/api/blog/post', name: 'app_blog_post', methods: ['GET'])]
    public function retrieveAllBlog(BlogPostRepository $repo, SerializerInterface $serializer): JsonResponse
    {
        try {

            $blogPosts = $repo->findAllWithComments();

            $json = $serializer->serialize($blogPosts, 'json', ['groups' => 'blogpost']);

            return new JsonResponse($json, 200, [], true);
        } catch (\Exception $e) {

            $this->logger->error('An error occurred: ' . $e->getMessage());


            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/api/blog-post/top-liked', name: 'app_blog_topliked', methods: ['GET'])]
    public function topLiked(BlogPostRepository $repo, SerializerInterface $serializer): jsonResponse
    {

        try {

            $topLike = $repo->findAllWithMinLikes(2);

            $json = $serializer->serialize($topLike, 'json', ['groups' => 'blogpost']);

            return new JsonResponse($json, 200, [], true);
        } catch (\Exception $e) {

            $this->logger->error('An error occurred: ' . $e->getMessage());

            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    #[Route('/api/blog-post/follows', name: 'app_blog_post_follows', methods: ['GET'])]
    public function followPosts(BlogPostRepository $repo, SerializerInterface $serializer): jsonResponse
    {

        try {
            /** @var AppUser $currentUser */

            $currentUser = $this->getUser();

            $followPosts = $repo->findAllByAuthors($currentUser->getFollow());

            if (empty($followPosts)) {

                return new JsonResponse(['message' => ' No post yet'], 200);
            }

            $json = $serializer->serialize($followPosts, 'json', ['groups' => 'blogpost']);

            return new JsonResponse($json, 200, [], true);
        } catch (\Exception $e) {

            $this->logger->error('An error occurred: ' . $e->getMessage());

            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    #[Route('/api/blog-post/{blog}', name: 'app_blog_post_show', methods: ['GET'])]
    public function retrieveSingleBlog(BlogPost $blog, SerializerInterface $serializer): JsonResponse
    {
        $data = $serializer->serialize($blog, 'json', ['groups' => 'blogpost']);
        return new JsonResponse($data, 200, [], true);
    }



    #[Route('/api/blog-post/add', name: 'app_blog_posts_add', methods: ['POST'])]
    public function addBlog(Request $request, BlogPostRepository $repo, SerializerInterface $serializer, ValidatorInterface $validator, LoggerInterface $logger): JsonResponse
    {
        try {
            /** @var AppUser $currentUser */
            $currentUser = $this->getUser();
            if (!$currentUser) {
                return $this->json(['message' => 'Only logged-in users can add a post.'], 400);
            }

            $data = $request->getContent();
            $blogPost = $serializer->deserialize($data, BlogPost::class, 'json', ['groups' => 'blogpost']);

            $errors = $validator->validate($blogPost);
            if (count($errors) > 0) {
                return $this->json(['errors' => $errors], 422);
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
    public function editBlog(BlogPost $blog, Request $request, BlogPostRepository $repo, SerializerInterface $serializer, ValidatorInterface $validator, LoggerInterface $logger, Security $security): JsonResponse
    {

        $currentUser = $security->getUser();

        if ($blog->getAuthor() !== $currentUser) {
            return $this->json(['message' => 'You do not have permission to edit this blog post.'], 403);
        }

        $data = $request->getContent();
        try {
            $editBlog = $serializer->deserialize($data, BlogPost::class, 'json', [
                AbstractNormalizer::OBJECT_TO_POPULATE => $blog
            ]);

            $errors = $validator->validate($editBlog);

            if (count($errors) > 0) {
                $errorMessages = [];
                /** @var \Symfony\Component\Validator\ConstraintViolation $error */
                foreach ($errors as $error) {
                    $errorMessages[] = $error->getMessage();
                }

                return $this->json(['message' => $errorMessages], 422);
            }



            $repo->save($editBlog, true);
            return $this->json([
                'message' => "Blog Edited successfully",
                'blogPost' => $editBlog
            ], 200, [], ['groups' => 'blogpost']);
        } catch (\Exception $e) {
            $logger->error('An error occurred: ' . $e->getMessage());
            return $this->json(['message' => 'An error occurred' . $e->getMessage()], 500);
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
                return $this->json(['message' => $errors], 422);
            }

            $blogComment->setBlog($blog);
            $blogComment->setAuthor($this->getUser());
            $repo->save($blogComment, true);

            $data = $serializer->serialize($blogComment, 'json', ['groups' => 'comment']);

            return $this->json([
                'message' => "Your Comment has been added",
                'blogComment' =>  $blogComment
            ], 200, [], ['groups' => 'comment']);
        } catch (\Exception $e) {

            $this->logger->error('An error occurred: ' . $e->getMessage());


            return $this->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    //delete blogpost
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

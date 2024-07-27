<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class LikeController extends AbstractController
{
    //Like post
    #[Route('api/like/{id}', name: 'app_like', methods: ['POST'])]
    public function like(BlogPost $blog, BlogPostRepository $repo, Request $request): JsonResponse
    {

        if (!$blog) {
            return new JsonResponse(['error' => 'Blog post not found'], 404);
        }

        $currentUser = $this->getUser();

        $blog->addLikedBy($currentUser);

        try {
            $repo->save($blog, true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to save the like'], 500);
        }

        return new JsonResponse(['message' => 'You just liked a post']);
    }


    //Unlike Post
    #[Route('/api/unlike/{id}', name: 'app_unlike', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function unlike(BlogPost $blog, BlogPostRepository $repo, Request $request): JsonResponse
    {

        if (!$blog) {
            return new JsonResponse(['error' => 'Blog post not found'], 404);
        }

        $currentUser = $this->getUser();

        $blog->removeLikedBy($currentUser);

        try {
            $repo->save($blog, true);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to save the like'], 500);
        }

        return new JsonResponse(['message' => 'You just unlike a post']);
    }
}

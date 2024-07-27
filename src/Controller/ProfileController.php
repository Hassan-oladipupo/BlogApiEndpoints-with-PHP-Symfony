<?php

namespace App\Controller;

use App\Entity\AppUser;
use Psr\Log\LoggerInterface;
use App\Repository\AppUserRepository;
use App\Repository\BlogPostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/api/profile/{id}', name: 'app_profile', methods: ['GET'])]
    public function show(AppUser $user, BlogPostRepository $repo, SerializerInterface $serializer): JsonResponse
    {
        try {
            $blogPosts = $repo->findAllByAuthor($user);

            $json = $serializer->serialize($blogPosts, 'json', ['groups' => 'blogpost']);

            return new JsonResponse($json, 200, [], true);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());

            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    #[Route('/api/profile/{id}/following', name: 'app_profile_following', methods: ['GET'])]
    public function following(AppUser $user, AppUserRepository $repo): JsonResponse
    {
        /** @var AppUser $currentUser */
        $currentUser = $this->getUser();

        if ($currentUser === null) {
            return new JsonResponse(['message' => 'User not logged in'], 401);
        }

        if ($user->getId() !== $currentUser->getId()) {
            return new JsonResponse(['message' => 'Access denied'], 403);
        }

        try {
            $userFollowing = $repo->findFollowingUsernames($currentUser->getId());

            if (empty($userFollowing)) {
                return new JsonResponse(['message' => 'The list is currently empty'], 200);
            }

            return new JsonResponse(['following' => $userFollowing], 200);
        } catch (\Exception $e) {
            $this->logger->error('Failed to retrieve following list: ' . $e->getMessage());
            return new JsonResponse(['message' => 'Failed to retrieve following list'], 500);
        }
    }


    #[Route('/api/profile/{id}/followers', name: 'app_profile_followers', methods: ['GET'])]
    public function followers(AppUser $user, AppUserRepository $repo): JsonResponse
    {
        /** @var AppUser $currentUser */
        $currentUser = $this->getUser();

        if ($currentUser === null || !$currentUser instanceof AppUser) {
            return new JsonResponse(['message' => 'User not logged in'], 401);
        }

        if ($user->getId() !== $currentUser->getId()) {
            return new JsonResponse(['message' => 'Access denied'], 403);
        }

        try {
            $userFollowers = $repo->findFollowerUsernames($currentUser->getId());

            if (empty($userFollowers)) {
                return new JsonResponse(['message' => 'The list is currently empty'], 200);
            }

            return new JsonResponse(['followers' => $userFollowers], 200);
        } catch (\Exception $e) {
            $this->logger->error('Failed to retrieve followers list: ' . $e->getMessage());
            return new JsonResponse(['message' => 'Failed to retrieve followers list'], 500);
        }
    }
}

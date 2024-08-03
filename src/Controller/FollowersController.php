<?php

namespace App\Controller;

use App\Entity\AppUser;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FollowersController extends AbstractController
{
    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    #[Route('/api/Follow/{id}', name: 'app_Follow', methods: ['POST'])]
    public function follow(AppUser $userToFollow, ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        /** @var AppUser $currentUser */
        $currentUser = $this->getUser();

        if (!$currentUser) {
            return new JsonResponse(['message' => 'User not authenticated'], 401);
        }

        if (!$userToFollow || $userToFollow->getId() === $currentUser->getId()) {
            return new JsonResponse(['message' => 'Invalid user or cannot follow yourself'], 400);
        }

        try {

            $currentUser->follow($userToFollow);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($currentUser);
            $entityManager->flush();

            return new JsonResponse(['message' => 'You have followed the user'], 200);
        } catch (\Exception $e) {
            $this->logger->error('Failed to follow the user: ' . $e->getMessage());

            return new JsonResponse(['error' => 'Failed to follow the user'], 500);
        }
    }



    #[Route('/api/unFollow/{id}', name: 'app_unFollow', methods: ['POST'])]
    public function unFollow(AppUser $userToUnFollow, ManagerRegistry $doctrine, Request $request): JsonResponse
    {
        /** @var AppUser $currentUser */
        $currentUser = $this->getUser();

        if (!$currentUser) {
            return new JsonResponse(['message' => 'User not authenticated'], 401);
        }

        if (!$userToUnFollow || $userToUnFollow->getId() === $currentUser->getId()) {
            return new JsonResponse(['message' => 'Invalid user '], 400);
        }

        try {


            $currentUser->unFollow($userToUnFollow);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($currentUser);
            $entityManager->flush();

            return new JsonResponse(['message' => 'You have unfollowed the user'], 200);
        } catch (\Exception $e) {
            $this->logger->error('Failed to unfollow the user: ' . $e->getMessage());

            return new JsonResponse(['message' => 'Failed to unfollow the user'], 500);
        }
    }
}

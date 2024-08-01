<?php

namespace App\Controller;

use App\Entity\AppUser;
use App\Entity\UserProfile;
use App\Repository\AppUserRepository;
use App\Service\ImgurService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\File;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ProfileSettingController extends AbstractController
{
    private $logger;
    private $imgurService;

    public function __construct(LoggerInterface $logger, ImgurService $imgurService)
    {
        $this->logger = $logger;
        $this->imgurService = $imgurService;
    }

    #[Route('/api/settings/profile-image', name: 'app_settings_profile_image', methods: ['POST'])]
    public function profileImage(Request $request, SluggerInterface $slugger, AppUserRepository $repo, ValidatorInterface $validator): JsonResponse
    {
        $profileImageFile = $request->files->get('image');

        if (!$profileImageFile instanceof UploadedFile) {
            return new JsonResponse(['message' => 'No image uploaded.'], 400);
        }

        $constraints = [
            new File([
                'maxSize' => '1024k',
                'mimeTypes' => ['image/jpeg', 'image/png'],
                'mimeTypesMessage' => 'Please upload a valid PNG/JPEG image',
            ]),
        ];

        $violations = $validator->validate($profileImageFile, $constraints);

        if (count($violations) > 0) {
            return new JsonResponse(['message' => $violations[0]->getMessage()], 400);
        }

        try {
            $originalFileName = pathinfo($profileImageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFileName);
            $newFileName = $safeFilename . '-' . uniqid() . '.' . $profileImageFile->guessExtension();

            $stream = fopen($profileImageFile->getPathname(), 'r');

            $uploadResult = $this->imgurService->uploadImageStream($stream);

            if ($uploadResult['success']) {
                /** @var AppUser $user */
                $user = $this->getUser();

                $profile = $user->getUserProfile() ?? new UserProfile();
                $profile->setImage($uploadResult['data']['link'] ?? '');
                $user->setUserProfile($profile);

                $repo->save($user, true);

                fclose($stream);

                return new JsonResponse(['message' => 'Your profile image was updated']);
            } else {
                fclose($stream);
                throw new \Exception('Imgur upload failed: ' . $uploadResult['message']);
            }
        } catch (FileException $e) {
            $this->logger->error('Failed to upload profile image: ' . $e->getMessage());
            return new JsonResponse(['message' => 'Failed to upload profile image.'], 500);
        } catch (\Exception $e) {
            $this->logger->error('Imgur upload failed: ' . $e->getMessage());
            return new JsonResponse(['message' => 'Imgur upload failed: ' . $e->getMessage()], 500);
        }
    }



    #[Route('/api/settings-profile', name: 'app_settings_profile', methods: ['POST'])]
    public function profile(Request $request, AppUserRepository $repo, SerializerInterface $serializer, ValidatorInterface $validator, ManagerRegistry $doctrine): JsonResponse
    {
        try {
            /** @var AppUser $user */
            $user = $this->getUser();

            $getUserProfile = $user->getUserProfile() ?? new UserProfile();

            $data = $request->getContent();
            $userProfile = $serializer->deserialize($data, UserProfile::class, 'json');

            $getUserProfile->setName($userProfile->getName());
            $getUserProfile->setBio($userProfile->getBio());
            $getUserProfile->setWebsiteUrl($userProfile->getWebsiteUrl());
            $getUserProfile->setTwitterUsername($userProfile->getTwitterUsername());
            $getUserProfile->setCompany($userProfile->getCompany());
            $getUserProfile->setLocation($userProfile->getLocation());
            $getUserProfile->setDateOfBirth($userProfile->getDateOfBirth());

            $errors = $validator->validate($getUserProfile);

            if (count($errors) > 0) {
                return $this->json(['message' => $errors], 422);
            }

            $user->setUserProfile($getUserProfile);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($getUserProfile);
            $entityManager->flush();

            return new JsonResponse(['message' => 'Your user profile settings were saved'], 200);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());
            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/api/settings-profile', name: 'app_get_user_profile', methods: ['GET'])]
    public function retrieveUserProfile(): JsonResponse
    {
        try {
            if (!$this->isGranted('IS_AUTHENTICATED_FULLY')) {
                return new JsonResponse(['message' => 'User is not authenticated'], 401);
            }

            /** @var AppUser $user */
            $user = $this->getUser();
            $userProfile = $user->getUserProfile();

            if (!$userProfile) {
                return new JsonResponse(['message' => 'User profile not found'], 200);
            }

            $profileData = [
                'firstName' => $userProfile->getName(),
                'dateOfBirth' => $userProfile->getDateOfBirth() ? $userProfile->getDateOfBirth()->format('Y-m-d') : null,
                'profileImage' => $userProfile->getImage(),
                'bio' => $userProfile->getBio(),
                'websiteUrl' => $userProfile->getWebsiteUrl(),
                'twitterUsername' => $userProfile->getTwitterUsername(),
                'company' => $userProfile->getCompany(),
                'location' => $userProfile->getLocation(),
            ];

            return new JsonResponse($profileData, 200);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());
            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/api/setting-profile', name: 'app_update_user_profile', methods: ['PUT'])]
    public function updateUserProfile(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, ManagerRegistry $doctrine): JsonResponse
    {
        try {
            /** @var AppUser $user */
            $user = $this->getUser();

            $userProfile = $user->getUserProfile();

            if (!$userProfile) {
                return new JsonResponse(['message' => 'User profile not found'], 404);
            }

            $data = $request->getContent();
            $updatedProfile = $serializer->deserialize($data, UserProfile::class, 'json', [
                AbstractNormalizer::OBJECT_TO_POPULATE => $userProfile
            ]);

            $errors = $validator->validate($updatedProfile);
            if (count($errors) > 0) {
                $errorMessages = [];
                foreach ($errors as $error) {
                    $errorMessages[] = $error->getMessage();
                }
                return new JsonResponse(['message' => $errorMessages], 422);
            }

            $entityManager = $doctrine->getManager();
            $entityManager->persist($updatedProfile);
            $entityManager->flush();

            return new JsonResponse(['message' => 'User profile updated successfully'], 200);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred: ' . $e->getMessage());
            return new JsonResponse(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}

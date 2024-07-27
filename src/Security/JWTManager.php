<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\AppUser;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager as BaseJWTManager;

class JWTManager extends BaseJWTManager
{
    private $eventDispatcher;

    public function __construct(JWTEncoderInterface $jwtEncoder, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($jwtEncoder, $eventDispatcher);
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createJwt(UserInterface $user): string
    {
        if (!$user instanceof AppUser) {
            throw new \InvalidArgumentException('User must be an instance of App\Entity\AppUser');
        }

        $userProfile = $user->getUserProfile();

        $payload = [
            'user_id' => $user->getId(),
            'username' => $user->getUserIdentifier(),
            'profileImage' => $userProfile ? $userProfile->getImage() : null,

        ];

        $jwtEvent = new JWTCreatedEvent($payload, $user);
        $this->eventDispatcher->dispatch($jwtEvent, Events::JWT_CREATED);

        return $this->jwtEncoder->encode($jwtEvent->getData());
    }
}

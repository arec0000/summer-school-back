<?php

namespace App\EventListener;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use League\Bundle\OAuth2ServerBundle\Event\UserResolveEvent;

final class UserResolveListener
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $userPasswordHasher;

    public function __construct(
        private EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function onUserResolve(UserResolveEvent $event): void
    {


        $user = $this->entityManager->getRepository(User::class) -> findOneBy(['email'=> $event -> getUsername()]);
        if (!$user) {
            throw new AuthenticationCredentialsNotFoundException('invalid data', Response::HTTP_NOT_FOUND);
        }

        if (!$this->userPasswordHasher->isPasswordValid($user, $event->getPassword())) {
            throw new AuthenticationCredentialsNotFoundException('invalid data', Response::HTTP_NOT_FOUND);
        }
        $event->setUser($user);
    }
}
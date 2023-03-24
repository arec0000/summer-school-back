<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
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

        if (!user) {
            throw new AuthenticationCredentialsNotFoundException('invalid data', Response::HTTP_NOT_FOUND);
        }

        if (!$this->userPasswordHasher->isPasswordValid($user, $event->getPassword())) {
            throw new AuthenticationCredentialsNotFoundException('invalid data', Response::HTTP_NOT_FOUND);
        }
        $event->setUser($user);
    }
}
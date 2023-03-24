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
        //dd($user);

        if (!$this->userPasswordHasher) {
            throw new AuthenticationCredentialsNotFoundException('invalid data', Response::HTTP_NOT_FOUND);
        }
        //dd($user);
        $event->setUser($user);

    }
}
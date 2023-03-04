<?php

namespace App\Entity\User;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;


//Аннотации для того чтобы сущность появилась в swagger и также была таблицей в бд
#[ApiResource]
#[ORM\Entity]
class User
{
    // Аннотации для того чтобы свойство класса стало атрибутом в бд
    // для того чтобы создать бд нужно заполнить .env параметр DATABASE_URL
    // после настройки, чтобы перевести эту сущность в таблицу в бд нужно через консоль выполнять следующее:
    // bin/console d:d:c && bin/console d:s:u --force --dump-sql
    // развернуть проект можно используя symfony serve -d

    //TODO сделать абстрактный класс BaseEntity, от которого будут наследоваться все остальные. В нем собрать все поля по умолчанию
    // id, dateCreate, dateUpdate
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    protected int $id;

    #[ORM\Column(type: "string")]
    public string $name;

    // обязательные поля в базе данных, и соответственно необходимые поля для создания пишутся так.
    #[ORM\Column(type: "string")]
    public string $surname;

    // необязательные поля, зануляются по умолчанию в бд и в коде вот так.
    #[ORM\Column(type: "string", nullable: true)]
    public ?string $patronymic = null;

    #[ORM\Column(type: "integer", nullable: true)]
    public ?int $age = null;

    #[ORM\Column(type: "string", nullable: true)]
    public ?string $email = null;

    #[ORM\Column(type: "string", nullable: true)]
    public ?string $phone = null;

    #[ORM\Column(type: "string")]
    private string $password;

    // TODO добавить поле role, когда будет таска на авторизацию

    // Методы пишем после свойств. Поля пароля и айди приватные по умолчанию
    // для них нужны гетеры и сетеры, функции которые позволяют получать приватные свойства из объекта класса.
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }




}

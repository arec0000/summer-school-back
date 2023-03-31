<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\User\UserFactory;
use Zenstruck\Foundry\Test\Factories;

class UserTest extends ApiTestCase
{
    use Factories;

    /** @test */
    public function PostUserTest(): void
    {
        UserFactory::createMany(20 );

        static::createClient()->request('POST', '/user');


        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(["message"=> "OK"]);
        $this-> assertResponseStatusCodeSame(201);
    }
}

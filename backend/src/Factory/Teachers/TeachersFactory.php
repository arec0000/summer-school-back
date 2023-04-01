<?php

namespace App\Factory\Teachers;

use App\Entity\Teachers\Teachers;
use App\Factory\Course\CourseFactory;
use App\Factory\User\UserFactory;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Teachers>
 *
 * @method        Teachers|Proxy create(array|callable $attributes = [])
 * @method static Teachers|Proxy createOne(array $attributes = [])
 * @method static Teachers|Proxy find(object|array|mixed $criteria)
 * @method static Teachers|Proxy findOrCreate(array $attributes)
 * @method static Teachers|Proxy first(string $sortedField = 'id')
 * @method static Teachers|Proxy last(string $sortedField = 'id')
 * @method static Teachers|Proxy random(array $attributes = [])
 * @method static Teachers|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Teachers[]|Proxy[] all()
 * @method static Teachers[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Teachers[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Teachers[]|Proxy[] findBy(array $attributes)
 * @method static Teachers[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Teachers[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TeachersFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->name(255),
            'surname' => self::faker()->name(255),
            'patronymic' => self::faker()->name(255),
            'age' => self::faker()->numberBetween(0,100),
            'phone'=> self::faker()->phoneNumber(),
            'email' => self::faker()->unique()->email(),
            'course'=> CourseFactory::createOne(),
            'user' => UserFactory::createOne(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Teachers $teachers): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Teachers::class;
    }
}

<?php

namespace App\Factory\Applications;

use App\Entity\Applications\Applications;
use App\Factory\Course\CourseFactory;
use App\Factory\User\UserFactory;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Applications>
 *
 * @method        Applications|Proxy create(array|callable $attributes = [])
 * @method static Applications|Proxy createOne(array $attributes = [])
 * @method static Applications|Proxy find(object|array|mixed $criteria)
 * @method static Applications|Proxy findOrCreate(array $attributes)
 * @method static Applications|Proxy first(string $sortedField = 'id')
 * @method static Applications|Proxy last(string $sortedField = 'id')
 * @method static Applications|Proxy random(array $attributes = [])
 * @method static Applications|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Applications[]|Proxy[] all()
 * @method static Applications[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Applications[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Applications[]|Proxy[] findBy(array $attributes)
 * @method static Applications[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Applications[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ApplicationsFactory extends ModelFactory
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
            'status' => self::faker()->text(),
            'user' => UserFactory::new(),
            'course' => CourseFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Applications $applications): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Applications::class;
    }
}

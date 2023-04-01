<?php

namespace App\Factory\Goals;

use App\Entity\Goals\Goal;
use App\Factory\Course\CourseFactory;
use App\Factory\User\UserFactory;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Goal>
 *
 * @method        Goal|Proxy create(array|callable $attributes = [])
 * @method static Goal|Proxy createOne(array $attributes = [])
 * @method static Goal|Proxy find(object|array|mixed $criteria)
 * @method static Goal|Proxy findOrCreate(array $attributes)
 * @method static Goal|Proxy first(string $sortedField = 'id')
 * @method static Goal|Proxy last(string $sortedField = 'id')
 * @method static Goal|Proxy random(array $attributes = [])
 * @method static Goal|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Goal[]|Proxy[] all()
 * @method static Goal[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Goal[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Goal[]|Proxy[] findBy(array $attributes)
 * @method static Goal[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Goal[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class GoalFactory extends ModelFactory
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
            'goalText' => self::faker()->text(),
            'course' => CourseFactory::new(),
            'user' => UserFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Goal $goal): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Goal::class;
    }
}

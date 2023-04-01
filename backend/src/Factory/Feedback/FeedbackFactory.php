<?php

namespace App\Factory\Feedback;

use App\Entity\Feedback\Feedback;
use App\Factory\Course\CourseFactory;
use App\Factory\User\UserFactory;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Feedback>
 *
 * @method        Feedback|Proxy create(array|callable $attributes = [])
 * @method static Feedback|Proxy createOne(array $attributes = [])
 * @method static Feedback|Proxy find(object|array|mixed $criteria)
 * @method static Feedback|Proxy findOrCreate(array $attributes)
 * @method static Feedback|Proxy first(string $sortedField = 'id')
 * @method static Feedback|Proxy last(string $sortedField = 'id')
 * @method static Feedback|Proxy random(array $attributes = [])
 * @method static Feedback|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Feedback[]|Proxy[] all()
 * @method static Feedback[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Feedback[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Feedback[]|Proxy[] findBy(array $attributes)
 * @method static Feedback[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Feedback[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FeedbackFactory extends ModelFactory
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
            'feedbackText' => self::faker()->text(),
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
            // ->afterInstantiate(function(Feedback $feedback): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Feedback::class;
    }
}

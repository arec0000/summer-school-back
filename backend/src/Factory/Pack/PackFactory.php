<?php

namespace App\Factory\Pack;

use App\Entity\Pack\Pack;
use App\Factory\Course\CourseFactory;
use App\Factory\Lesson\LessonFactory;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Pack>
 *
 * @method        Pack|Proxy create(array|callable $attributes = [])
 * @method static Pack|Proxy createOne(array $attributes = [])
 * @method static Pack|Proxy find(object|array|mixed $criteria)
 * @method static Pack|Proxy findOrCreate(array $attributes)
 * @method static Pack|Proxy first(string $sortedField = 'id')
 * @method static Pack|Proxy last(string $sortedField = 'id')
 * @method static Pack|Proxy random(array $attributes = [])
 * @method static Pack|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Pack[]|Proxy[] all()
 * @method static Pack[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Pack[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Pack[]|Proxy[] findBy(array $attributes)
 * @method static Pack[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Pack[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PackFactory extends ModelFactory
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
            'packName' => self::faker()->text(255),
            'calendarUrl' => self::faker()->url(),
            'course' => CourseFactory::createOne(),
            'lessons' => LessonFactory::createOne(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Pack $pack): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Pack::class;
    }
}

<?php

namespace App\Factory\Lesson;

use App\Entity\Lesson\Lesson;
use App\Factory\Pack\PackFactory;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Lesson>
 *
 * @method        Lesson|Proxy create(array|callable $attributes = [])
 * @method static Lesson|Proxy createOne(array $attributes = [])
 * @method static Lesson|Proxy find(object|array|mixed $criteria)
 * @method static Lesson|Proxy findOrCreate(array $attributes)
 * @method static Lesson|Proxy first(string $sortedField = 'id')
 * @method static Lesson|Proxy last(string $sortedField = 'id')
 * @method static Lesson|Proxy random(array $attributes = [])
 * @method static Lesson|Proxy randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Lesson[]|Proxy[] all()
 * @method static Lesson[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Lesson[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Lesson[]|Proxy[] findBy(array $attributes)
 * @method static Lesson[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Lesson[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class LessonFactory extends ModelFactory
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
            'description' => self::faker()->text(),
            'title' => self::faker()->text(255),
            'topic' => self::faker()->text(255),
            'date' => self::faker()->date(),
            'startTime'=> self::faker()->time(),
            'endTime'=> self::faker()->time(),
            'pack' => PackFactory::new(),

        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Lesson $lesson): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Lesson::class;
    }
}

<?php

namespace App\Support\ServiceHub;

use App\Contracts\ServiceHubContent;
use App\Support\ServiceHub\Hubs\AluminiumWorksHubContent;
use InvalidArgumentException;

class ServiceHubRegistry
{
    /**
     * @var array<int, class-string<ServiceHubContent>>
     */
    private const HUBS = [
        AluminiumWorksHubContent::class,
    ];

    /**
     * @return array<int, ServiceHubContent>
     */
    public static function all(): array
    {
        return array_map(
            static fn (string $class): ServiceHubContent => app($class),
            self::HUBS,
        );
    }

    public static function resolve(string $slug): ?ServiceHubContent
    {
        foreach (self::all() as $hub) {
            if ($hub->slug() === $slug || in_array($slug, $hub->aliases(), true)) {
                return $hub;
            }
        }

        return null;
    }

    public static function isHub(string $slug): bool
    {
        return self::resolve($slug) !== null;
    }

  /**
     * @return array<int, string>
     */
    public static function slugs(): array
    {
        $slugs = [];

        foreach (self::all() as $hub) {
            $slugs[] = $hub->slug();
            $slugs = array_merge($slugs, $hub->aliases());
        }

        return array_values(array_unique($slugs));
    }

    public static function canonicalSlug(string $slug): string
    {
        $hub = self::resolve($slug);

        if ($hub === null) {
            throw new InvalidArgumentException("Hub not found for slug [{$slug}]");
        }

        return $hub->slug();
    }
}

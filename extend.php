<?php

namespace Dashzeveg\Openlinksinnewtab;

use Flarum\Extend;
use Laminas\Diactoros\Uri;

return [
    (new Extend\Link)
        ->setTarget(function (Uri $uri, Uri $siteUrl, array $attributes): string {
            // return $uri->getHost() === $siteUrl->getHost() ? '_self' : '_blank';
            return '_blank';
        })
        ->setRel(function (Uri $uri, Uri $siteUrl, array $attributes): string {
            // return $uri->getHost() === $siteUrl->getHost() ? 'ugc' : 'noopener ugc nofollow';
            $internalPrefixes = [
                '/d/',
                '/t/',
                '/u/',
                '/following',
                '/tags',
                '/settings',
                '/blog',
            ];

            $path = $uri->getPath();

            foreach ($internalPrefixes as $prefix) {
                if (str_starts_with($path, $prefix)) {
                    return 'noopener';
                }
            }

            return 'noopener noreferrer ugc nofollow';
        }),
];
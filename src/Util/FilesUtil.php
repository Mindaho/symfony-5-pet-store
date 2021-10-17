<?php

declare(strict_types=1);

namespace App\Util;

use Symfony\Component\Finder\Finder;

class FilesUtil
{
    public static function getFiles(string $directory, array $format): array
    {
        $finder = new Finder();

        $finder->files()->in($directory);

        $files = $finder->files()->name($format);

        $names = [];
        foreach ($files->getIterator() as $file) {
            $names[] = $file->getFilename();
        }

        return $names;
    }
}
<?php

namespace App\Tests\Unit;

use App\Util\FilesUtil;
use PHPUnit\Framework\TestCase;

class FileUtilTest extends TestCase
{
    /**
     * @dataProvider getImagesProvider
     */
    public function testGetImages(string $directory, array $format, array $expected)
    {
        $this->assertSame($expected, FilesUtil::getFiles($directory, $format));
    }

    public function getImagesProvider(): array
    {
        return [
            'no format provided' =>[
                "./tests/fixtures/images",
                [],
                ['bob.png', 'dog.jpeg', 'cat.jpg']
            ],
            'only jpg' =>[
                "./tests/fixtures/images",
                ['*.jpg'],
                ['cat.jpg']
            ],
            'only png' =>[
                "./tests/fixtures/images",
                ['*.png'],
                ['bob.png']
            ],
            'only jpeg' =>[
                "./tests/fixtures/images",
                ['*.jpeg'],
                ['dog.jpeg']
            ],
            'non existing format' =>[
                "./tests/fixtures/images",
                ['*.test'],
                []
            ],
        ];
    }
}
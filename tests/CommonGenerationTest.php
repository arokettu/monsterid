<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Tests;

use Arokettu\MonsterID\Monster;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

use function Arokettu\MonsterID\build_monster;
use function Arokettu\MonsterID\stream_monster;

class CommonGenerationTest extends TestCase
{
    public function testImageSize(): void
    {
        $monster1 = (new Monster('test@example.com'))->getImage(); // default size is 120

        [$width1, $height1] = getimagesizefromstring($monster1);

        self::assertEquals(120, $width1);
        self::assertEquals(120, $height1);

        $monster2 = (new Monster('test@example.com', 64))->getImage(); // shrink

        [$width2, $height2] = getimagesizefromstring($monster2);

        self::assertEquals(64, $width2);
        self::assertEquals(64, $height2);

        $monster3 = (new Monster('test@example.com', 256))->getImage(); // expand

        [$width3, $height3] = getimagesizefromstring($monster3);

        self::assertEquals(256, $width3);
        self::assertEquals(256, $height3);
    }

    public function testInvalidStream(): void
    {
        $this->expectException(InvalidArgumentException::class);
        stream_monster('not a stream', '');
    }

    public function testNoNegativeSizes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        build_monster('test', -100);
    }
}

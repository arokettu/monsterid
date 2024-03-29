<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Tests;

use Arokettu\MonsterID\Config;
use Arokettu\MonsterID\Monster;
use Arokettu\MonsterID\Randomizer\FactoryInterface;
use PHPUnit\Framework\TestCase;

use function Arokettu\MonsterID\build_monster;
use function Arokettu\MonsterID\build_monster_gd;
use function Arokettu\MonsterID\build_monster_response;
use function Arokettu\MonsterID\stream_monster;

abstract class MonsterGenerationTestTemplate extends TestCase
{
    abstract protected function getDir(): string;
    abstract protected function getFactory(): FactoryInterface;

    public function setUp(): void
    {
        Config::setRandomizerFactory($this->getFactory());
    }

    public function tearDown(): void
    {
        Config::setRandomizerFactory(); // reset to the default
    }

    private function getImageFile(string $string, int $size): string
    {
        $dir = $this->getDir();

        // for test updates
        // file_put_contents(
        //     __DIR__ . "/data/{$dir}/{$string}-{$size}.png",
        //     (new Monster($string, $size))->getImage()
        // );

        // recode png to ignore gd compression difference
        $image = imagecreatefrompng(__DIR__ . "/data/{$dir}/{$string}-{$size}.png");
        ob_start();
        imagepng($image);
        return ob_get_clean();
    }

    public function testGenerateForSeed(): void
    {
        $monster1 = build_monster('test@example.com');

        self::assertNotEmpty($monster1); // some monster is generated

        $monsterBuilder = new Monster('test@example.com');

        $monster2 = $monsterBuilder->getImage();
        $monster3 = $monsterBuilder->getImage();

        self::assertEquals($monster1, $monster2); // Two generations with same seed should result in the same monster
        self::assertEquals($monster2, $monster3); // Two generations by same builder should result in the same monster
    }

    public function testImageContent(): void
    {
        $monster1 = (new Monster('test@example.com'))->getImage();
        self::assertEquals($this->getImageFile('test@example.com', 120), $monster1);

        $monster3 = (new Monster('test@example.com', 240))->getImage();
        self::assertEquals($this->getImageFile('test@example.com', 240), $monster3);
    }

    public function testSeedEdgeCases(): void
    {
        $negSeedMonster = (new Monster('37854182738c08d1@example.com'))->getImage();
        self::assertEquals($this->getImageFile('37854182738c08d1@example.com', 120), $negSeedMonster);

        $posSeedMonster = (new Monster('50e6614de5e62689@example.com'))->getImage();
        self::assertEquals($this->getImageFile('50e6614de5e62689@example.com', 120), $posSeedMonster);
    }

    public function testGdExport(): void
    {
        $image = build_monster_gd('test@example.com');
        ob_start();
        imagepng($image);
        $png = ob_get_clean();

        self::assertEquals($this->getImageFile('test@example.com', 120), $png);
    }

    public function testStreamOutput(): void
    {
        $stream = fopen('php://memory', 'r+');

        stream_monster($stream, 'test@example.com');
        rewind($stream);

        self::assertEquals($this->getImageFile('test@example.com', 120), stream_get_contents($stream));
    }

    public function testResponse(): void
    {
        $response = build_monster_response('test@example.com', 240);

        self::assertEquals($this->getImageFile('test@example.com', 240), $response->getBody()->getContents());
    }

    public function testSerialization(): void
    {
        $monster = new Monster('test@example.com', 240);
        $monster->getImage(); // create resource (non-serializable)

        $monsterImage = unserialize(serialize($monster))->getImage();
        self::assertEquals($this->getImageFile('test@example.com', 240), $monsterImage);
    }
}

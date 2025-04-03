<?php

declare(strict_types=1);

namespace Arokettu\MonsterID\Tests;

use Arokettu\MonsterID\Config;
use Arokettu\MonsterID\Randomizer\DefaultV0Factory;
use Arokettu\MonsterID\Randomizer\DefaultV3Factory;
use Arokettu\MonsterID\Tests\Helpers\HttpFactory;
use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ResponseFactory as SlimResponseFactory;
use Slim\Psr7\Factory\StreamFactory as SlimStreamFactory;

class ConfigTest extends TestCase
{
    public function testRandomizerFactory(): void
    {
        self::assertInstanceOf(DefaultV3Factory::class, Config::getRandomizerFactory());

        Config::setRandomizerFactory(new DefaultV0Factory());
        self::assertInstanceOf(DefaultV0Factory::class, Config::getRandomizerFactory());

        // reset to default
        Config::setRandomizerFactory();
        self::assertInstanceOf(DefaultV3Factory::class, Config::getRandomizerFactory());
    }

    public function testResponseFactory(): void
    {
        // @see extra.discovery in composer.json
        self::assertInstanceOf(HttpFactory::class, Config::getResponseFactory());

        Config::setResponseFactory(new SlimResponseFactory());
        self::assertInstanceOf(SlimResponseFactory::class, Config::getResponseFactory());

        // reset to default
        Config::setResponseFactory();
        self::assertInstanceOf(HttpFactory::class, Config::getResponseFactory());
    }

    public function testStreamFactory(): void
    {
        // @see extra.discovery in composer.json
        self::assertInstanceOf(HttpFactory::class, Config::getStreamFactory());

        Config::setStreamFactory(new SlimStreamFactory());
        self::assertInstanceOf(SlimStreamFactory::class, Config::getStreamFactory());

        // reset to default
        Config::setStreamFactory();
        self::assertInstanceOf(HttpFactory::class, Config::getStreamFactory());
    }
}

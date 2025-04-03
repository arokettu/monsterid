<?php

declare(strict_types=1);

namespace Arokettu\MonsterID;

use Arokettu\MonsterID\Randomizer\DefaultV3Factory;
use Arokettu\MonsterID\Randomizer\FactoryInterface;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use RuntimeException;

final class Config
{
    private static FactoryInterface $randomizerFactory;
    private static ResponseFactoryInterface $responseFactory;
    private static StreamFactoryInterface $streamFactory;

    private static function buildDefaultRandomizerFactory(): FactoryInterface
    {
        return new DefaultV3Factory();
    }

    public static function setRandomizerFactory(FactoryInterface|null $factory = null): void
    {
        self::$randomizerFactory = $factory ?? self::buildDefaultRandomizerFactory();
    }

    public static function getRandomizerFactory(): FactoryInterface
    {
        return self::$randomizerFactory ??= self::buildDefaultRandomizerFactory();
    }

    private static function buildDefaultResponseFactory(): ResponseFactoryInterface
    {
        $factoryFactory = [Psr17FactoryDiscovery::class, 'findResponseFactory'];

        return \is_callable($factoryFactory) ? $factoryFactory() : throw new RuntimeException(
            'Response Factory not found. Please pass it explicitly or install php-http/discovery'
        );
    }

    public static function setResponseFactory(ResponseFactoryInterface|null $factory): void
    {
        self::$responseFactory = $factory ?? self::buildDefaultResponseFactory();
    }

    public static function getResponseFactory(): ResponseFactoryInterface
    {
        return self::$responseFactory ??= self::buildDefaultResponseFactory();
    }

    private static function buildDefaultStreamFactory(): StreamFactoryInterface
    {
        $factoryFactory = [Psr17FactoryDiscovery::class, 'findStreamFactory'];

        return \is_callable($factoryFactory) ? $factoryFactory() : throw new RuntimeException(
            'StreamFactory not found. Please pass it explicitly or install php-http/discovery'
        );
    }

    public static function setStreamFactory(StreamFactoryInterface|null $factory): void
    {
        self::$streamFactory = $factory ?? self::buildDefaultResponseFactory();
    }

    public static function getStreamFactory(): StreamFactoryInterface
    {
        return self::$streamFactory ??= self::buildDefaultStreamFactory();
    }
}

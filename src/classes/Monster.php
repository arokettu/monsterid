<?php

declare(strict_types=1);

namespace Arokettu\MonsterID;

use Arokettu\MonsterID\Randomizer\FactoryInterface;
use DomainException;
use GdImage;
use Http\Discovery\Psr17FactoryDiscovery;
use InvalidArgumentException;
use LogicException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Random\Randomizer;

use function Arokettu\IsResource\try_get_resource_type;

final class Monster
{
    public const DEFAULT_SIZE = MONSTER_DEFAULT_SIZE;
    public const MIME = MONSTER_MIME;

    private const PARTS_PATH = __DIR__ . '/../../assets/parts';

    private GdImage $monster;
    private FactoryInterface $rngFactory;

    public function __construct(
        private string $string,
        private int $size = self::DEFAULT_SIZE,
        FactoryInterface|null $rngFactory = null
    ) {
        if ($size < 1) {
            throw new DomainException('$size must be 1 or more');
        }

        $this->rngFactory = $rngFactory ?? Config::getRandomizerFactory();
    }

    public function getGdImage(): GdImage
    {
        if (!isset($this->monster)) {
            $this->buildImage();
        }

        $newmonster = imagecreatetruecolor($this->size, $this->size);
        imagecopy($newmonster, $this->monster, 0, 0, 0, 0, $this->size, $this->size);

        return $newmonster;
    }

    /**
     * @param resource|null $stream write png image to string
     * @return resource the same resource
     */
    public function writeToStream($stream = null)
    {
        if ($stream) {
            if (try_get_resource_type($stream) !== 'stream') {
                throw new InvalidArgumentException('$stream should be a writable stream');
            }
        } else {
            $stream = fopen('php://temp', 'r+');
        }

        if (!isset($this->monster)) {
            $this->buildImage();
        }

        imagepng($this->monster, $stream);

        return $stream;
    }

    /**
     * @return string png image content
     */
    public function getImage(): string
    {
        $stream = $this->writeToStream();
        rewind($stream);
        $image = stream_get_contents($stream);
        fclose($stream);

        return $image;
    }

    public function getResponse(
        ResponseFactoryInterface|null $responseFactory = null,
        StreamFactoryInterface|null $streamFactory = null,
    ): ResponseInterface {
        $responseFactory ??= Config::getResponseFactory();
        $streamFactory ??= Config::getStreamFactory();

        $stream = $this->writeToStream();
        rewind($stream);

        return $responseFactory->createResponse()
            ->withBody($streamFactory->createStreamFromResource($stream))
            ->withHeader('Content-Type', self::MIME);
    }

    private function buildImage(): void
    {
        $randomizer = new Randomizer($this->rngFactory->getRandomizer($this->string));

        $monster = $this->createImage();
        $parts = $this->generateRandomParts($randomizer);

        // add parts
        foreach ($parts as $part => $number) {
            $this->applyPartToImage($monster, $part, $number, $randomizer);
        }

        $this->monster = $this->prepareOutput($monster);
    }

    private function createImage(): GdImage
    {
        // create background
        $monster = imagecreatetruecolor(MONSTER_DEFAULT_SIZE, MONSTER_DEFAULT_SIZE);
        if (!$monster) {
            throw new LogicException('GD image create failed'); // @codeCoverageIgnore
        }
        $white = imagecolorallocate($monster, 255, 255, 255);
        imagefill($monster, 0, 0, $white);

        return $monster;
    }

    private function applyPartToImage(GdImage $monster, string $part, int $number, Randomizer $randomizer): void
    {
        $file = self::PARTS_PATH . DIRECTORY_SEPARATOR . "{$part}_{$number}.png";

        $partImage = imagecreatefrompng($file);
        if (!$partImage) {
            throw new LogicException('Failed to load ' . $file); // @codeCoverageIgnore
        }
        imagesavealpha($partImage, true);
        imagecopy($monster, $partImage, 0, 0, 0, 0, MONSTER_DEFAULT_SIZE, MONSTER_DEFAULT_SIZE);
        imagedestroy($partImage);

        // color the body
        if ($part == 'body') {
            $color = imagecolorallocate(
                $monster,
                $randomizer->getInt(20, 235),
                $randomizer->getInt(20, 235),
                $randomizer->getInt(20, 235)
            );
            imagefill($monster, MONSTER_DEFAULT_SIZE / 2, MONSTER_DEFAULT_SIZE / 2, $color);
        }
    }

    private function prepareOutput(GdImage $monster): GdImage
    {
        // resize if needed, then output
        if ($this->size === MONSTER_DEFAULT_SIZE) {
            return $monster;
        } else {
            $out = imagecreatetruecolor($this->size, $this->size);
            if (!$out) {
                throw new LogicException('GD image create failed'); // @codeCoverageIgnore
            }
            imagecopyresampled($out, $monster, 0, 0, 0, 0, $this->size, $this->size, 120, 120);
            imagedestroy($monster);
            return $out;
        }
    }

    /**
     * @return array<string, int>
     */
    private function generateRandomParts(Randomizer $randomizer): array
    {
        // throw the dice for body parts
        return [
            'legs' =>   $randomizer->getInt(1, 5),
            'hair' =>   $randomizer->getInt(1, 5),
            'arms' =>   $randomizer->getInt(1, 5),
            'body' =>   $randomizer->getInt(1, 15),
            'eyes' =>   $randomizer->getInt(1, 15),
            'mouth' =>  $randomizer->getInt(1, 10),
        ];
    }

    public function __serialize(): array
    {
        return [
            'string'        => $this->string,
            'size'          => $this->size,
            'rngFactory'    => $this->rngFactory,
        ];
    }

    public function __unserialize(array $data): void
    {
        [
            'string'        => $this->string,
            'size'          => $this->size,
            'rngFactory'    => $this->rngFactory,
        ] = $data;
    }
}

<?php

namespace SandFox\MonsterID;

final class Monster
{
    private const PARTS_PATH = __DIR__ . '/../../assets/parts';

    /** @var int */
    private $seed;
    /** @var int */
    private $size;

    /** @var resource|\GdImage|null */
    private $monster = null;

    public function __construct(?string $seed = null, int $size = MONSTER_DEFAULT_SIZE)
    {
        if ($seed === null) {
            $this->seed = random_int(0, 2 ** 24); // get something random
        } else {
            // first index of unpack is 1
            // convert to 32bit signed integer
            [/* $_ */, $intSeed] = unpack('l', md5($seed, true));

            // make 31 bit positive integer
            if ($intSeed < 0) {
                $intSeed = -1 - $intSeed;
            }

            $this->seed = $intSeed;
        }

        $this->size = $size;

        if ($this->size < 1) {
            throw new \InvalidArgumentException('$size must be 1 or more');
        }
    }

    public function __destruct()
    {
        if ($this->monster) {
            imagedestroy($this->monster);
        }
    }

    /**
     * @return \GdImage|resource
     */
    public function getGdImage()
    {
        if ($this->monster === null) {
            $this->build();
        }

        $newmonster = imagecreatetruecolor($this->size, $this->size);
        imagecopy($newmonster, $this->monster, 0, 0, 0, 0, $this->size, $this->size);

        return $newmonster;
    }

    /**
     * @param resource $stream write png image to string
     */
    public function writeToStream($stream): void
    {
        if ($this->monster === null) {
            $this->build();
        }

        imagepng($this->monster, $stream);
    }

    /**
     * @return string png image content
     */
    public function getImage(): string
    {
        $stream = fopen('php://temp','r+');
        $this->writeToStream($stream);
        rewind($stream);

        return stream_get_contents($stream);
    }

    private function build(): void
    {
        $randomizer = new Randomizer($this->seed);

        $monster = $this->createImage();
        $parts = $this->generateRandomParts($randomizer);

        // add parts
        foreach ($parts as $part => $number) {
            $this->applyPartToImage($monster, $part, $number, $randomizer);
        }

        $this->monster = $this->prepareOutput($monster);
    }

    /**
     * @return \GdImage|resource
     */
    private function createImage()
    {
        // create background
        $monster = imagecreatetruecolor(MONSTER_DEFAULT_SIZE, MONSTER_DEFAULT_SIZE);
        if (!$monster) {
            throw new ImageNotCreatedException('GD image create failed'); // @codeCoverageIgnore
        }
        $white = imagecolorallocate($monster, 255, 255, 255);
        imagefill($monster, 0, 0, $white);

        return $monster;
    }

    /**
     * @param resource|\GdImage $monster
     * @param string $part
     * @param int $number
     * @param Randomizer $randomizer
     */
    private function applyPartToImage($monster, string $part, int $number, Randomizer $randomizer): void
    {
        $file = self::PARTS_PATH . DIRECTORY_SEPARATOR . "{$part}_{$number}.png";

        $partImage = imagecreatefrompng($file);
        if (!$partImage) {
            throw new PartNotLoadedException('Failed to load ' . $file); // @codeCoverageIgnore
        }
        imagesavealpha($partImage, true);
        imagecopy($monster, $partImage, 0, 0, 0, 0, MONSTER_DEFAULT_SIZE, MONSTER_DEFAULT_SIZE);
        imagedestroy($partImage);

        // color the body
        if ($part == 'body') {
            $color = imagecolorallocate(
                $monster,
                $randomizer->rand(20, 235),
                $randomizer->rand(20, 235),
                $randomizer->rand(20, 235)
            );
            imagefill($monster, MONSTER_DEFAULT_SIZE / 2, MONSTER_DEFAULT_SIZE / 2, $color);
        }
    }

    /**
     * @param resource|\GdImage $monster
     * @return resource|\GdImage
     */
    private function prepareOutput($monster)
    {
        // resize if needed, then output
        if ($this->size === MONSTER_DEFAULT_SIZE) {
            return $monster;
        } else {
            $out = imagecreatetruecolor($this->size, $this->size);
            if (!$out) {
                throw new ImageNotCreatedException('GD image create failed'); // @codeCoverageIgnore
            }
            imagecopyresampled($out, $monster, 0, 0, 0, 0, $this->size, $this->size, 120, 120);
            imagedestroy($monster);
            return $out;
        }
    }

    private function generateRandomParts(Randomizer $randomizer): array
    {
        // throw the dice for body parts
        return [
            'legs' =>   $randomizer->rand(1, 5),
            'hair' =>   $randomizer->rand(1, 5),
            'arms' =>   $randomizer->rand(1, 5),
            'body' =>   $randomizer->rand(1, 15),
            'eyes' =>   $randomizer->rand(1, 15),
            'mouth' =>  $randomizer->rand(1, 10),
        ];
    }
}

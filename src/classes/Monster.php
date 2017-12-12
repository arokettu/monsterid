<?php

namespace SandFoxMe\MonsterID;

class Monster
{
    private $seed;

    private static $partsPath;

    public function __construct($seed)
    {
        $this->seed = null;

        if ($seed) {
            // first index of unpack is 1
            list(/* $_ */, $intSeed) = unpack('l',
                substr(
                    md5($seed, true),   // raw md5 hash
                    0, 4                // 4 bytes
                )
            );                          // convert to 32bit signed integer

            $this->seed = $intSeed;
        }
    }

    public function build($size = null)
    {
        $this->initRandom();

        $parts      = $this->generateRandomParts();
        $monster    = $this->createImage();

        // add parts
        foreach ($parts as $part => $number) {
            $this->applyPartToImage($monster, $part, $number);
        }

        $this->restoreRandom();

        return $this->prepareOutput($monster, $size);
    }

    private function createImage()
    {
        // create background
        $monster = imagecreatetruecolor(120, 120);
        if (!$monster) {
            throw new ImageNotCreatedException('GD image create failed');
        }
        $white = imagecolorallocate($monster, 255, 255, 255);
        imagefill($monster, 0, 0, $white);

        return $monster;
    }

    private function applyPartToImage($image, $part, $number)
    {
        $file = implode(DIRECTORY_SEPARATOR, array(self::getPartsPath(), "{$part}_{$number}.png"));

        $partImage = imagecreatefrompng($file);
        if (!$partImage) {
            throw new PartNotLoadedException('Failed to load ' . $file);
        }
        imagesavealpha($partImage, true);
        imagecopy($image, $partImage, 0, 0, 0, 0, 120, 120);
        imagedestroy($partImage);

        // color the body
        if ($part == 'body') {
            $color = imagecolorallocate($image, rand(20, 235), rand(20, 235), rand(20, 235));
            imagefill($image, 60, 60, $color);
        }
    }

    private function prepareOutput($image, $size)
    {
        // resize if needed, then output
        if ($size && $size < 400) {
            $out = imagecreatetruecolor($size, $size);
            if (!$out) {
                throw new ImageNotCreatedException('GD image create failed');
            }
            imagecopyresampled($out, $image, 0, 0, 0, 0, $size, $size, 120, 120);

            imagedestroy($image);
        } else {
            $out = $image;
        }

        ob_start();
        imagepng($out);
        $buffer = ob_get_clean();
        imagedestroy($out);

        return $buffer;
    }

    private function initRandom()
    {
        // init random seed
        if ($this->seed !== false) {
            srand($this->seed);
        }
    }

    private function restoreRandom()
    {
        // restore random seed
        if ($this->seed !== false) {
            srand();
        }
    }

    private function generateRandomParts()
    {
        // throw the dice for body parts
        return array(
            'legs' =>   rand(1, 5),
            'hair' =>   rand(1, 5),
            'arms' =>   rand(1, 5),
            'body' =>   rand(1, 15),
            'eyes' =>   rand(1, 15),
            'mouth' =>  rand(1, 10),
        );
    }

    private static function getPartsPath()
    {
        if (!self::$partsPath) {
            self::$partsPath = realpath(__DIR__ . '/../../assets/parts');
        }

        return self::$partsPath;
    }
}

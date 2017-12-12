<?php

namespace SandFoxMe\MonsterID;

class Monster
{
    private $seed;
    private $monster;

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

    public function __destruct()
    {
        if ($this->monster) {
            imagedestroy($this->monster);
        }
    }

    public function build($size = null)
    {
        try {
            $this->initRandom();
            $this->createImage();

            $parts = $this->generateRandomParts();

            // add parts
            foreach ($parts as $part => $number) {
                $this->applyPartToImage($part, $number);
            }

            $this->restoreRandom();

            return $this->prepareOutput($size);
        } finally {
            if ($this->monster) {
                imagedestroy($this->monster);
            }
        }
    }

    private function createImage()
    {
        // create background
        $this->monster = imagecreatetruecolor(120, 120);
        if (!$this->monster) {
            throw new ImageNotCreatedException('GD image create failed');
        }
        $white = imagecolorallocate($this->monster, 255, 255, 255);
        imagefill($this->monster, 0, 0, $white);
    }

    private function applyPartToImage($part, $number)
    {
        $file = implode(DIRECTORY_SEPARATOR, array(self::getPartsPath(), "{$part}_{$number}.png"));

        $partImage = imagecreatefrompng($file);
        if (!$partImage) {
            throw new PartNotLoadedException('Failed to load ' . $file);
        }
        imagesavealpha($partImage, true);
        imagecopy($this->monster, $partImage, 0, 0, 0, 0, 120, 120);
        imagedestroy($partImage);

        // color the body
        if ($part == 'body') {
            $color = imagecolorallocate($this->monster, rand(20, 235), rand(20, 235), rand(20, 235));
            imagefill($this->monster, 60, 60, $color);
        }
    }

    private function prepareOutput($size)
    {
        // resize if needed, then output
        if ($size && $size < 400) {
            $out = imagecreatetruecolor($size, $size);
            if (!$out) {
                throw new ImageNotCreatedException('GD image create failed');
            }
            imagecopyresampled($out, $this->monster, 0, 0, 0, 0, $size, $size, 120, 120);

            imagedestroy($this->monster);
        } else {
            $out = $this->monster;
        }

        $this->monster = null; // monster is either destroyed or moved to $out

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

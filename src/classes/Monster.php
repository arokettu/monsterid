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
            list($intSeed) = unpack('l',
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
        $seed = $this->seed;

        $PARTS_PATH = self::getPartsPath();

        // init random seed
        if ($seed) {
            srand($seed);
        }

        // throw the dice for body parts
        $parts = array(
            'legs' => rand(1, 5),
            'hair' => rand(1, 5),
            'arms' => rand(1, 5),
            'body' => rand(1, 15),
            'eyes' => rand(1, 15),
            'mouth' => rand(1, 10)
        );

        // create background
        $monster = imagecreatetruecolor(120, 120);
        if (!$monster) {
            throw new ImageNotCreatedException('GD image create failed');
        }
        $white = imagecolorallocate($monster, 255, 255, 255);
        imagefill($monster, 0, 0, $white);

        // add parts
        foreach ($parts as $part => $num) {
            $file = "{$PARTS_PATH}/{$part}_{$num}.png";

            $im = imagecreatefrompng($file);
            if (!$im) {
                throw new PartNotLoadedException('Failed to load ' . $file);
            }
            imagesavealpha($im, true);
            imagecopy($monster, $im, 0, 0, 0, 0, 120, 120);
            imagedestroy($im);

            // color the body
            if ($part == 'body') {
                $color = imagecolorallocate($monster, rand(20, 235), rand(20, 235), rand(20, 235));
                imagefill($monster, 60, 60, $color);
            }
        }

        // restore random seed
        if ($seed) {
            srand();
        }

        // resize if needed, then output
        if ($size && $size < 400) {
            $out = imagecreatetruecolor($size, $size);
            if (!$out) {
                throw new ImageNotCreatedException('GD image create failed');
            }
            imagecopyresampled($out, $monster, 0, 0, 0, 0, $size, $size, 120, 120);

            imagedestroy($monster);
        } else {
            $out = $monster;
        }

        ob_start();
        imagepng($out);
        $image = ob_get_clean();
        imagedestroy($out);

        return $image;
    }

    private static function getPartsPath()
    {
        if (!self::$partsPath) {
            self::$partsPath = realpath(__DIR__ . '/../../assets/parts');
        }

        return self::$partsPath;
    }
}

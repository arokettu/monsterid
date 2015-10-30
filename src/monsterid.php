<?php

namespace SandFoxIM\MonsterID;

class MonsterException extends \RuntimeException {}
class PartNotLoadedException extends MonsterException {}
class ImageNotCreatedException extends MonsterException {}

/**
 * @param  string $seed any string id like email or openid
 * @param  int    $size Image size (square size x size)
 * @return string       PNG image content (dump it to page or save to file)
 * @throws PartNotLoadedException
 * @throws ImageNotCreatedException
 */
function build_monster($seed = null, $size = null)
{
    static $PARTS_PATH;
    if (!$PARTS_PATH) {
        $PARTS_PATH = realpath(__DIR__ . '/../assets/parts');
    }

    // init random seed
    if ($seed) {
        srand(hexdec(substr(md5($seed), 0, 6)));
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
        imageSaveAlpha($im, true);
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

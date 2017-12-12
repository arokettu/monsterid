<?php

class MonsterGenerationTest extends \PHPUnit\Framework\TestCase
{
    public function testGenerateForSeed()
    {
        $monster1 = \SandFoxMe\MonsterID\build_monster('sandfox@sandfox.me');

        $this->assertNotEmpty($monster1);                   // some monster is generated

        $monsterBuilder = new \SandFoxMe\MonsterID\Monster('sandfox@sandfox.me');

        $monster2 = $monsterBuilder->build();
        $monster3 = $monsterBuilder->build();

        $this->assertEquals($monster1, $monster2); // Two generations with same seed should result in the same monster
        $this->assertEquals($monster2, $monster3); // Two generations by same builder should result in the same monster
    }

    public function testGenerateRandom()
    {
        $monster1 = \SandFoxMe\MonsterID\build_monster();
        $monster2 = \SandFoxMe\MonsterID\build_monster();

        $this->assertNotEquals($monster1, $monster2);       // two runs with empty seed should result in different monsters
        // we may have failures here from time to time due to randomness
    }

    public function testImageSize()
    {
        $monsterBuilder = new \SandFoxMe\MonsterID\Monster('sandfox@sandfox.me');

        $monster1 = $monsterBuilder->build(); // default size is 120

        list($width1, $height1) = getimagesizefromstring($monster1);

        $this->assertEquals(120, $width1);
        $this->assertEquals(120, $height1);

        $monster2 = $monsterBuilder->build(64); // shrink

        list($width2, $height2) = getimagesizefromstring($monster2);

        $this->assertEquals(64, $width2);
        $this->assertEquals(64, $height2);

        $monster3 = $monsterBuilder->build(256); // expand

        list($width3, $height3) = getimagesizefromstring($monster3);

        $this->assertEquals(256, $width3);
        $this->assertEquals(256, $height3);
    }
}

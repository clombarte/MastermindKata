<?php

/**
 * Test for CodeMaker class.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class CodeMakerTest extends \PHPUnit_Framework_TestCase
{
    public function testThatEachCodeCharacterIsValid()
    {
        $obj                = new MastermindKata\CodeMaker();
        $code               = $obj->getRandomCode();
        $valid_characters   = array(
            'A',
            'B',
            'C',
            'D',
            'E',
            'F'
        );

        $this->assertContains( $valid_characters, $code[0], 'The character ' . $code[0] . ' is not valid' );
        $this->assertContains( $valid_characters, $code[1], 'The character ' . $code[1] . ' is not valid' );
        $this->assertContains( $valid_characters, $code[2], 'The character ' . $code[2] . ' is not valid' );
        $this->assertContains( $valid_characters, $code[3], 'The character ' . $code[3] . ' is not valid' );
    }
}
<?php

/**
 * Test suite for the ClueGenerator class.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */

namespace MastermindKata;

class ClueGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The object to be tested.
     *
     * @var ClueGenerator
     */
    private $obj;

    /**
     * The tested object dependency to generate a clue.
     *
     * @var ClueEngineInterface
     */
    private $code_generator;

    /**
     * Executes before every test case.
     */
    public function setUp()
    {
        $this->obj = new ClueGenerator();
    }

    /**
     * Executes after every test case.
     */
    public function tearDown()
    {
        $this->obj = null;
    }

    /**
     * Tests that getClueForGivenCode throws exception when player's code has different length with secret code.
     */
    public function testThatGetClueForGivenCodeThrowsExceptionWhenPlayersCodeHasDifferentLengthOfSecretCode()
    {
        $this->obj->setSecretCode( 'AAAA' );
        $this->obj->setUserCode( 'BBBBBB' );
        $this->setExpectedException( 'MastermindKata\DifferentCodeLengthException' );
        $this->obj->getClue();
    }

    /**
     * Tests that getClueForGivenCode throws EmptyCodeException when player's code or secret code is empty.
     */
    public function testThatGetClueForGivenCodeThrowsEmptyCodeExceptionWhenPlayersCodeOrSecretCodeIsEmpty()
    {
        $this->obj->setSecretCode( '' );
        $this->obj->setUserCode( 'BBBBBB' );
        $this->setExpectedException( 'MastermindKata\EmptyCodeException' );
        $this->obj->getClue();
    }

    /**
     * Data provider for getClueForGivenCode method.
     *
     * @return array
     */
    public function getClueForGivenCodeProvider()
    {
        return array(
            'All characters correct but wrong position' => array(
                'guess' => 'AABC',
                'secret_code' => 'BCAA',
                'expected' => '****',
                'message' => 'This method must return **** when all the characters are part of the secret code'
            ),
            'Three characters and position correct' => array(
                'guess' => 'AAAC',
                'secret_code' => 'AAAB',
                'expected' => 'XXX',
                'message' => 'This method must return XXX when three of the characters in the code are correct'
            ),
            'Zero characters and position correct' => array(
                'guess' => 'AAAA',
                'secret_code' => 'BBBB',
                'expected' => 'No matches, keep trying!',
                'message' => 'This method must return No matches, keep trying! when nothing is correct'
            ),
            'X always before *' => array(
                'guess' => 'ABCF',
                'secret_code' => 'FCBF',
                'expected' => 'X**',
                'message' => 'This method must return the \'X\' always before than the \'*\''
            ),
            'One correct only when guess is the same character' => array(
                'guess' => 'BBBB',
                'secret_code' => 'ABCD',
                'expected' => '*',
                'message' => 'This method must return * when one character is correct when a guess is the same character'
            ),
        );
    }

    /**
     * Tests that getClueForGivenCode handles correctly all possible cases.
     *
     * @dataProvider getClueForGivenCodeProvider
     */
    public function testGetClueForGivenCode( $guess, $secret_code, $expected, $message )
    {
        $this->obj->setSecretCode( $secret_code );
        $this->obj->setUserCode( $guess );

        $this->assertEquals( $expected, $this->obj->getClue( $guess ), $message );
    }
}
 
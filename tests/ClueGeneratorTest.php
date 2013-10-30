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
     * Data provider used to test the getClue method Exceptions.
     *
     * @return array
     */
    public function getClueExceptionsProvider()
    {
        return array(
            'The codes have different length' => array(
                'secret_code'           => 'AAAA',
                'user_code'             => 'BBBBBBBB',
                'expected_exception'    => 'MastermindKata\DifferentCodeLengthException',
            ),
            'Secret code is empty' => array(
                'secret_code'           => '',
                'user_code'             => 'FFFF',
                'expected_exception'    => 'MastermindKata\EmptyCodeException',
            ),
            'User code is empty' => array(
                'secret_code'           => 'DDDD',
                'user_code'             => '',
                'expected_exception'    => 'MastermindKata\EmptyCodeException',
            ),
        );
    }

    /**
     * Tests that getClue throws the appropriate exceptions when certain conditions are met.
     *
     * @dataProvider getClueExceptionsProvider
     *
     * @param string $secret_code           The secret code that has to be broken.
     * @param string $user_code             The user guess attempt to break the secret code.
     * @param string $expected_exception    The expected exception to be thrown, including the namespace.
     */
    public function testThatGetClueThrowsTheAppropriateExceptions( $secret_code, $user_code, $expected_exception )
    {
        $this->setExpectedException( $expected_exception );
        $this->obj->getClue( $secret_code, $user_code );
    }

    /**
     * Data provider for getClue method.
     *
     * @return array
     */
    public function getClueProvider()
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
     * Tests that getClue handles correctly all the possible clue cases.
     *
     * @dataProvider getClueProvider
     */
    public function testGetClueForGivenCode( $guess, $secret_code, $expected, $message )
    {
        $this->assertEquals( $expected, $this->obj->getClue( $secret_code, $guess ), $message );
    }
}
 
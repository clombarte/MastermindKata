<?php

namespace MastermindKata;

/**
 * Test suite for the CodeGenerator class.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class CodeGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The object to test.
     *
     * @var RandomEngineInterface
     */
    private $obj;

    /**
     * Executes before every test case.
     */
    public function setUp()
    {
        $this->obj = new CodeGenerator();
    }

    /**
     * Executes after every test case.
     */
    public function tearDown()
    {
        $this->obj = null;
    }

    /**
     * Test that getRandomCode returns an string.
     */
    public function testThatGenerateRandomCodeReturnsString()
    {
        $this->assertInternalType(
            \PHPUnit_Framework_Constraint_IsType::TYPE_STRING,
            $this->obj->getRandomCode(),
            'This method must return an string'
        );
    }

    /**
     * Tests that getRandomCode is made of N number of characters.
     */
    public function testThatGenerateRandomCodeHasTheExpectedNumberOfCharacters()
    {
        $expected_characters = 4;
        $result = str_split( $this->obj->getRandomCode() );

        $this->assertCount(
            $expected_characters,
            $result,
            'This method must return a code of ' . $expected_characters . ' characters'
        );
    }

    /**
     * Tests that generateRandomCode generates a random code each time.
     */
    public function testThatGenerateRandomCodeIsReallyRandom()
    {
        $expected = $this->obj->getRandomCode();

        $this->assertNotEquals( $expected, $this->obj->getRandomCode(), 'This method must generate random codes' );
    }
}
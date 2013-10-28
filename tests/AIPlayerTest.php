<?php

namespace MastermindKata;

/**
 * Test suite for the IAPlayer class.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class IAPlayerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * The object to test.
     *
     * @var IAPlayer
     */
    private $obj;

    /**
     * The code generator mock.
     *
     * @var RandomEngineInterface
     */
    private $code_generator;

    /**
     * The clue generator mock.
     *
     * @var ClueEngineInterface
     */
    private $clue_generator;

    /**
     * Executes before every test case.
     */
    public function setUp()
    {
        $this->code_generator = $this->getMock( 'MastermindKata\CodeGenerator', array( 'getRandomCode' ) );
        $this->clue_generator = $this->getMock( 'MastermindKata\ClueGenerator' );
        $this->obj = new IAPlayer( $this->code_generator, $this->clue_generator );
    }

    /**
     * Executes after every test case.
     */
    public function tearDown()
    {
        $this->obj              = null;
        $this->code_generator   = null;
        $this->clue_generator   = null;
    }
    /**
     * Tests that isGivenCodeCorrect returns true if the code is correct.
     */
    public function testThatIsGivenCodeReturnsTrueIfCodeIsCorrect()
    {
        $code = 'AABF';
        $this->code_generator->expects( $this->once() )
            ->method( 'getRandomCode' )
            ->will( $this->returnValue( $code ) );

        $this->obj = new IAPlayer( $this->code_generator, $this->clue_generator );
        $this->obj->generateRandomCode();

        $this->assertTrue( $this->obj->isGivenCodeCorrect( $code ), 'This method must return true when the code is correct' );
    }

    /**
     * Tests that isGivenCodeCorrect returns a clue if the player's guess was incorrect.
     */
    public function testThatIsGivenCodeCorrectReturnsAClueIfGuessWasWrong()
    {
        $code = 'AABF';
        $this->code_generator->expects( $this->once() )
            ->method( 'getRandomCode' )
            ->will( $this->returnValue( 'FFFF' ) );

        $this->clue_generator->expects( $this->once() )
            ->method( 'setSecretCode' );
        $this->clue_generator->expects( $this->once() )
            ->method( 'setUserCode' );
        $this->clue_generator->expects( $this->once() )
            ->method( 'getClue' );

        $this->obj = new IAPlayer( $this->code_generator, $this->clue_generator );
        $this->obj->generateRandomCode();
        $this->obj->isGivenCodeCorrect( $code );
    }
}
<?php

namespace MastermindKata;

/**
 * Sets a secret code that other player has to guess, if the player's guesses are incorrect, this class gives a clue
 * to the player.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class AIPlayer
{
    /**
     * Class that can generate a code.
     *
     * @var RandomEngineInterface
     */
    private $code_generator;

    /**
     * Class that can generate a clue.
     *
     * @var ClueEngineInterface
     */
    private $clue_generator;

    /**
     * The secret code to be guessed by the player.
     *
     * @var string
     */
    private $secret_code = '';

    /**
     * Construct of the class, sets the dependencies of this class.
     *
     * @param RandomEngineInterface     $code_generator The class that can generate a code.
     * @param ClueEngineInterface       $clue_generator The class that generates the clue for the player.
     */
    public function __construct( RandomEngineInterface $code_generator, ClueEngineInterface $clue_generator )
    {
        $this->code_generator = $code_generator;
        $this->clue_generator = $clue_generator;
    }

    /**
     * Generates a random code for the player.
     */
    public function generateRandomCode()
    {
        $this->secret_code = $this->code_generator->getRandomCode();
    }

    /**
     * Checks if a given code is correct or not, if not, gives a clue to the player.
     *
     * @param string $user_code The code to check if it is correct or not.
     *
     * @return mixed Boolean when the user guessed the correct code, string otherwise.
     */
    public function isGivenCodeCorrect( $user_code )
    {
        if ( $user_code == $this->secret_code )
        {
            return true;
        }

        return $this->clue_generator->getClue( $this->secret_code, $user_code );
    }
}
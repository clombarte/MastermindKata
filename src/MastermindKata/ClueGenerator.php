<?php

namespace MastermindKata;

/**
 * Generates a clue for the given code.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class ClueGenerator implements ClueEngineInterface
{
    /**
     * The actual secret code.
     *
     * @var string
     */
    private $secret_code;

    /**
     * Player's given guess for the secret code.
     *
     * @var string
     */
    private $user_code;

    /**
     * Character used when a character in the code is correct but it is not in a correct place.
     *
     * @var string
     */
    const CORRECT_BUT_MISPLACED = '*';

    /**
     * Character used when a character in the code is correct and in place.
     *
     * @var string
     */
    const CORRECT_IN_PLACE = 'X';

    /**
     * Message given to the user when nothing on the code was correct.
     *
     * @var string
     */
    const RETRY_MESSAGE = 'No matches, keep trying!';

    /**
     * Saves the secret code.
     *
     * @param string $secret_code The secret code to compare with player's guess.
     */
    public function setSecretCode( $secret_code )
    {
        $this->secret_code = $secret_code;
    }

    /**
     * Saves the user guess.
     *
     * @param string $user_code The user given guess.
     */
    public function setUserCode( $user_code )
    {
        $this->user_code = $user_code;
    }

    /**
     * Returns the clue to the player.
     *
     * @return string The clue to return to the player.
     */
    public function getClue()
    {
        return $this->getClueForGivenCode( $this->user_code );
    }

    /**
     * Generates a clue depending on the given code.
     *
     * @param string $code The code to check to create the clue.
     *
     * @throws DifferentCodeLengthException
     * @throws EmptyCodeException
     *
     * @return string The generated clue.
     */
    private function getClueForGivenCode( $code )
    {
        if ( !$this->secret_code || !$this->user_code )
        {
            throw new EmptyCodeException( 'The user guess code or the secret code is empty' );
        }
        elseif ( strlen( $code ) != strlen( $this->secret_code ) )
        {
            throw new DifferentCodeLengthException( $code . ' is different in length with the secret code' );
        }

        $secret_code    = str_split( $this->secret_code );
        $user_code      = str_split( $code );
        $clue           = array();

        for ( $i = 0; $i < count( $user_code ); $i++ )
        {
            if ( isset( $secret_code[$i] ) && $user_code[$i] == $secret_code[$i] )
            {
                $clue[] = self::CORRECT_IN_PLACE;
                unset( $secret_code[$i] );
            }
            elseif ( false !== ( $key = array_search( $user_code[$i], $secret_code ) ) )
            {
                $clue[] = self::CORRECT_BUT_MISPLACED;
                unset( $secret_code[$key] );
            }
        }

        // Always return 'X' before '*'.
        rsort( $clue );

        return $clue ? implode( '', $clue ) : self::RETRY_MESSAGE;
    }
}
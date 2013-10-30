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
     * Generates a clue depending on the user guess.
     *
     * @param string $secret_code   The code to discover.
     * @param string $user_code     User's secret code guess attempt.
     *
     * @throws DifferentCodeLengthException Thrown when the user code and the secret code are different in length.
     * @throws EmptyCodeException Thrown when the user code or the secret code is empty.
     *
     * @return string The clue to return to the player.
     */
    public function getClue( $secret_code, $user_code )
    {
        if ( !$secret_code || !$user_code )
        {
            throw new EmptyCodeException( 'The user guess code or the secret code is empty' );
        }
        elseif ( strlen( $user_code ) != strlen( $secret_code ) )
        {
            throw new DifferentCodeLengthException( $user_code . ' is different in length with the secret code' );
        }

        $secret_code    = str_split( $secret_code );
        $user_code      = str_split( $user_code );
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
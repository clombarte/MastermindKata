<?php

namespace MastermindKata;

/**
 * Responsible of generating a random code.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class CodeGenerator implements RandomEngineInterface
{
    /**
     * The maximum characters in the code.
     *
     * @var integer
     */
    const MAXIMUM_CODE_CHARACTERS = 4;

    /**
     * The lowest possible character in the code.
     *
     * @var string
     */
    const LOWEST_CHARACTER = 'A';

    /**
     * The highest possible character in the code.
     *
     * @var string
     */
    const HIGHEST_CHARACTER = 'F';

    /**
     * Generates a random code.
     *
     * @return string The generated random code.
     */
    public function getRandomCode()
    {
        $code               = '';
        $lowest_character   = ord( self::LOWEST_CHARACTER );
        $highest_character  = ord( self::HIGHEST_CHARACTER );

        for ( $i = 0; $i < self::MAXIMUM_CODE_CHARACTERS; $i++ )
        {
            $code .= chr( rand( $lowest_character, $highest_character ) );
        }

        return $code;
    }
} 
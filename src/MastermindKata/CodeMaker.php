<?php

namespace MastermindKata;

/**
 * Generates a code made of 4 alphabetic characters between A and F both included.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class CodeMaker
{
    /**
     * Generates a random alphabetic code.
     */
    public function getRandomCode()
    {
        return array(
            rand( 'A', 'F' ),
            rand( 'A', 'F' ),
            rand( 'A', 'F' ),
            rand( 'A', 'F' ),
        );
    }
}
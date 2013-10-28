<?php

namespace MastermindKata;

/**
 * Detailed class description here.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */

interface RandomEngine
{
    /**
     * Generates a random code.
     *
     * @param integer $maximum_characters   The maximum characters that the code will be made of.
     * @param integer $lowest_limit         The lowest possible character in the code.
     * @param integer $highest_limit        The highest possible character in the code.
     * @return string The generated random code.
     */
    public function getRandomCode( $maximum_characters, $lowest_limit, $highest_limit );
}
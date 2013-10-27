<?php

/**
 * Reads input from the user.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class InputReader
{
    /**
     * Reads input from the user using the readline function.
     *
     * @param mixed $prompt Message shown to the user when waiting for his input, defaults to null.
     * @return string The user input.
     */
    public function readUserInput( $prompt = null )
    {
        return readline( $prompt );
    }
}
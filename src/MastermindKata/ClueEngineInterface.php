<?php

namespace MastermindKata;

/**
 * Interface for classes that generates clues.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
interface ClueEngineInterface
{
    /**
     * This method generates a clue.
     *
     * @param string $secret_code   The code to discover.
     * @param string $user_code     User's secret code guess attempt.
     *
     * @return string The generated clue.
     */
    public function getClue( $secret_code, $user_code );
}
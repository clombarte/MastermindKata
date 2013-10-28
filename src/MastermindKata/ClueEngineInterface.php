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
     * @return string The generated clue.
     */
    public function getClue();
}
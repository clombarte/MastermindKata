<?php

namespace MastermindKata;

/**
 * Interface for classes that generate random values.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */

interface RandomEngineInterface
{
    /**
     * Generates a random code.
     *
     * @return mixed The generated random code.
     */
    public function getRandomCode();
}
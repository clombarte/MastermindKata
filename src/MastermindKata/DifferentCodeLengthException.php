<?php

namespace MastermindKata;

/**
 * Exception used when the code given by the user is not equal to the stored secret code in IAPlayer class.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class DifferentCodeLengthException extends \Exception{}
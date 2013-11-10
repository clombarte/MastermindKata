<?php

namespace MastermindKata;

/**
 * Exception used when the code given by the user is not equal in length to the stored secret code.
 *
 * @author Carlos Lombarte <lombartec@gmail.com>
 */
class DifferentCodeLengthException extends \Exception{}
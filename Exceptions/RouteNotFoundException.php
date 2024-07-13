<?php

namespace Exceptions;

use http\Message;

class RouteNotFoundException extends \Exception
{
    protected $message = 'Cette route n\'existe pas.';

}
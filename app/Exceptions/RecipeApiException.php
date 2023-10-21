<?php

namespace App\Exceptions;

use Exception;

class RecipeApiException extends Exception
{
    public static function apikeyNotSet(): self
    {
        return new self('The Recipe API key is not set.');
    }

    public static function apiurlNotSet(): self
    {
        return new self('The Recipe API URL is not set.');
    }
}

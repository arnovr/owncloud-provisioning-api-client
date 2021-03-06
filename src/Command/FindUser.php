<?php

namespace Arnovr\OwncloudProvisioning\Command;

use Assert\Assertion;

class FindUser
{
    /**
     * FindUser constructor.
     *
     * @param string $userName
     */
    public function __construct($userName = '')
    {
        Assertion::notEmpty($userName, 'Username is a required field to find a user');

        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }
}
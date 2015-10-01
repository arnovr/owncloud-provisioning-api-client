<?php

namespace Arnovr\OwncloudProvisioning\Command;

use Assert\Assertion;

class DeleteUser
{
    /**
     * DeleteUser constructor.
     *
     * @param string $userName
     */
    public function __construct($userName = '')
    {
        Assertion::notEmpty($userName, 'Username is a required field to delete a user');

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
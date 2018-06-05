<?php

namespace Arnovr\OwncloudProvisioning\Client\Command;

use Assert\Assertion;

class FindSubAdminGroupsOfUser
{
    /**
     * FindSubAdminGroupsOfUser constructor.
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

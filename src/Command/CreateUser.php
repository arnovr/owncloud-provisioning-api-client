<?php

namespace Arnovr\OwncloudProvisioning\Command;

use Assert\Assertion;

class CreateUser
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $password;

    /**
     * CreateUser constructor.
     *
     * @param string $userName
     * @param string $password
     */
    public function __construct($userName = '', $password = '')
    {
        Assertion::notEmpty($userName, 'Username is a required field to create a user');
        Assertion::notEmpty($password, 'Password is a required field to create a user');

        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
<?php

namespace Arnovr\OwncloudProvisioning\Command;

use Assert\Assertion;

class EditUser
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $quota;

    /**
     * @var string
     */
    public $display;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    private $userName;

    /**
     * EditUser constructor.
     *
     * @param string $userName
     */
    public function __construct($userName = '')
    {
        Assertion::notEmpty($userName, 'Username is a required field to edit a user');

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
<?php

namespace Arnovr\OwncloudProvisioning\Users;

use Assert\Assertion;

class User
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $quota;

    /**
     * @var string
     */
    private $enabled = false;

    /**
     * @param string  $email
     * @param integer $quota
     * @param boolean $enabled
     */
    private function __construct($statusCode, $email, $quota, $enabled) {

        Assertion::integer($statusCode);
        Assertion::email($email);
        Assertion::integer($quota);
        Assertion::boolean($enabled);

        $this->statusCode = $statusCode;
        $this->email = $email;
        $this->quota = $quota;
        $this->enabled = $enabled;
    }

    /**
     * @param string $email
     * @param integer $quota
     * @param boolean $enabled
     * @return User
     */
    public static function from($email, $quota, $enabled)
    {
        return new self($email, $quota, $enabled);
    }
}

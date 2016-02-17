<?php

namespace Arnovr\OwncloudProvisioning\Users;

use Assert\Assertion;

class User
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $quota;

    /**
     * @var string
     */
    private $enabled = false;

    /**
     * @param string  $userName
     * @param integer $quota
     * @param boolean $enabled
     */
    private function __construct($userName, $quota, $enabled) {

        Assertion::email($userName);
        Assertion::integer($quota);
        Assertion::boolean($enabled);

        $this->userName = $userName;
        $this->quota = $quota;
        $this->enabled = $enabled;
    }

    /**
     * @param string  $userName
     * @param integer $quota
     * @param boolean $enabled
     * @return User
     */
    public static function from($userName, $quota, $enabled)
    {
        return new self($userName, $quota, $enabled);
    }

    /**
     * @return string
     */
    public function userName()
    {
        return $this->userName;
    }
}

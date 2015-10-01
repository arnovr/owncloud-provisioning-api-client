<?php


namespace Arnovr\OwncloudProvisioning\Result;


class User extends StatusResult
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
    public $enabled;
}
<?php

namespace Arnovr\OwncloudProvisioning\Users;

use Arnovr\OwncloudProvisioning\Client\Command\FindUser;
use Arnovr\OwncloudProvisioning\Client\OwncloudClient;
use Assert\Assertion;

class UserRepository
{
    /**
     * @var OwncloudClient
     */
    private $owncloudClient;

    /**
     * UserRepository constructor.
     * @param OwncloudClient $owncloudClient
     */
    public function __construct(OwncloudClient $owncloudClient)
    {
        $this->owncloudClient = $owncloudClient;
    }

    /**
     * @param string $userName
     * @return User
     */
    public function findUser($userName)
    {
        Assertion::notEmpty($userName, 'Username is a required field to find a user');

        $findUserCommand = new FindUser();
        $findUserCommand->userName = $userName;

        $userResult = $this->owncloudClient->findUser(
            $findUserCommand
        );
        return User::from(
            $userResult['email'],
            (integer) $userResult['quota'],
            (bool) $userResult['enabled']
        );
    }
}

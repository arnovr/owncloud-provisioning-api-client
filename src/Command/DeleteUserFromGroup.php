<?php

namespace Arnovr\OwncloudProvisioning\Command;


class DeleteUserFromGroup
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $groupId;

    /**
     * DeleteUserFromGroup constructor.
     *
     * @param string $userName
     * @param string $groupId
     */
    public function __construct($userName = '', $groupId = '')
    {
        Assertion::notEmpty($userName, 'Username is a required field to add a user to a group');
        Assertion::notEmpty($groupId, 'Group id is a required field to add a user to a group');

        $this->userName = $userName;
        $this->groupId = $groupId;
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
    public function getGroupId()
    {
        return $this->groupId;
    }
}

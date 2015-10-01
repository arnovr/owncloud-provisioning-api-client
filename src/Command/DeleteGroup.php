<?php

namespace Arnovr\OwncloudProvisioning\Command;

use Assert\Assertion;

class DeleteGroup
{
    /**
     * @var string
     */
    private $groupId;

    /**
     * DeleteGroup constructor.
     *
     * @param string $groupId
     */
    public function __construct($groupId = '')
    {
        Assertion::notEmpty($groupId, 'Group id is a required field to delete a group');

        $this->groupId = $groupId;
    }

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }
}
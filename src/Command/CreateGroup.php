<?php


namespace Arnovr\OwncloudProvisioning\Command;


use Assert\Assertion;

class CreateGroup
{
    /**
     * @var string
     */
    private $groupId;

    /**
     * CreateGroup constructor.
     *
     * @param string $groupId
     */
    public function __construct($groupId = '')
    {
        Assertion::notEmpty($groupId, 'Group id is a required field to add a group');

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
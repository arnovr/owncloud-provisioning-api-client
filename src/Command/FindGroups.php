<?php

namespace Arnovr\OwncloudProvisioning\Command;

class FindGroups
{
    /**
     * @var string
     */
    private $searchGroup;

    /**
     * FindGroups constructor.
     *
     * @param string $searchGroup
     */
    public function __construct($searchGroup = '')
    {
        Assertion::notEmpty($searchGroup, 'Group to search for is a required field to find a group');

        $this->searchGroup = $searchGroup;
    }

    /**
     * @return string
     */
    public function getSearchGroup()
    {
        return $this->searchGroup;
    }
}
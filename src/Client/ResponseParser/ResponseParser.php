<?php

namespace Arnovr\OwncloudProvisioning\Client\ResponseParser;

use Arnovr\OwncloudProvisioning\Client\Result\GroupsList;
use Arnovr\OwncloudProvisioning\Client\Result\User;
use Arnovr\OwncloudProvisioning\Client\Result\UserList;
use Arnovr\OwncloudProvisioning\Client\Result\StatusResult;
use Psr\Http\Message\ResponseInterface;

interface ResponseParser
{
    /**
    * @param ResponseInterface $response
    * @return StatusResult
    */
    public function parseResponse(ResponseInterface $response);

    /**
     * @param ResponseInterface $response
     * @return User
     */
    public function parseFindUser(ResponseInterface $response);

    /**
     * @param ResponseInterface $response
     * @return UserList
     */
    public function parseFindUsers(ResponseInterface $response);

    /**
     * @param ResponseInterface $response
     * @return GroupsList
     */
    public function parseFindGroup(ResponseInterface $response);
}

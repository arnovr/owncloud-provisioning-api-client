<?php

namespace Arnovr\OwncloudProvisioning;

use GuzzleHttp\Client;

/**
 * Class ApiConnection
 * @package Arnovr\OwncloudProvisioning
 */
class ApiConnection
{
    /**
     * @var integer
     */
    private $timeout = 5;

    /**
     * @var string
     */
    private $owncloudUrl;

    /**
     * @var Client
     */
    private $apiClient;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $password;

    /**
     * ApiConnection constructor.
     * @param Client $apiClient
     * @param string $owncloudUrl
     * @param string $userName
     * @param string $password
     * @param integer $timeout
     */
    public function __construct(Client $apiClient, $owncloudUrl, $userName, $password, $timeout = 5)
    {
        $this->owncloudUrl = $owncloudUrl;
        $this->apiClient = $apiClient;
        $this->timeout = $timeout;
        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest($method, $url, array $body = [])
    {
        $auth = ['auth' => [$this->userName, $this->password]];
        $body = array_merge($auth, $body);

        return $this->apiClient->request($method, $this->owncloudUrl . $url,
            $body
        );
    }
}

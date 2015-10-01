<?php

namespace Arnovr\OwncloudProvisioning;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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
     * ApiConnection constructor.
     * @param Client $apiClient
     * @param string $owncloudUrl
     * @param int $timeout
     */
    public function __construct(Client $apiClient, $owncloudUrl, $timeout = 5)
    {
        $this->owncloudUrl = $owncloudUrl;
        $this->apiClient = $apiClient;
        $this->timeout = $timeout;
    }

    /**
     * @param string $method
     * @param string $url
     * @param $body
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest($method, $url, $body)
    {
        $request = new Request($method, $this->owncloudUrl . $url, [], $body);
        return $this->apiClient->send($request, ['timeout' => $this->timeout]);
    }
}
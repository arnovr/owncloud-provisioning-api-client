<?php

use Arnovr\OwncloudProvisioning\ApiConnection;
use Arnovr\OwncloudProvisioning\ProvisioningClient;
use Arnovr\OwncloudProvisioning\ResponseParser\XMLResponseParser;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

class ProvisioningClientCreator
{
    public static function createProvisioningClient(HandlerStack $handler)
    {
        $guzzleClient = new Client(['handler' => $handler]);

        return new ProvisioningClient(
            new ApiConnection(
                $guzzleClient,
                'http://owncloud.url'
            ),
            new XMLResponseParser()
        );
    }
}
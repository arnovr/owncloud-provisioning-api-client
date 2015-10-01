<?php

use Arnovr\OwncloudProvisioning\Command\FindUser;
use Arnovr\OwncloudProvisioning\ProvisioningClient;
use Arnovr\OwncloudProvisioning\Result\User;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class FindUserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ProvisioningClient
     */
    private $client;

    /**
     * @test
     */
    public function shouldGetUser()
    {
        $mock = new MockHandler([
            new Response(200, [], '<?xml version="1.0"?><ocs><meta><statuscode>100</statuscode><status>ok</status></meta><data><email>frank@example.org</email><quota>0</quota><enabled>true</enabled></data></ocs>'),
        ]);

        $handler = HandlerStack::create($mock);

        $this->client = ProvisioningClientCreator::createProvisioningClient($handler);

        $getUserCommand = new FindUser('username');
        /** @var User $getUserResult */
        $getUserResult = $this->client->findUser($getUserCommand);
        $this->assertInstanceOf(User::class, $getUserResult);

        $this->assertEquals(100,$getUserResult->statusCode);
        $this->assertEquals('frank@example.org',$getUserResult->email);
        $this->assertEquals('0',$getUserResult->quota);
        $this->assertEquals('true',$getUserResult->enabled);
    }

    /**
     * @test
     */
    public function shouldFailToGetUserWhenInvalidDataIsSupplied()
    {
        $mock = new MockHandler([
            new Response(200, [], '<?xml version="1.0"?><ocs><meta><statuscode>101</statuscode><status>ok</status></meta></ocs>'),
        ]);

        $handler = HandlerStack::create($mock);

        $this->client = ProvisioningClientCreator::createProvisioningClient($handler);


        $getUserCommand = new FindUser('username');
        /** @var User $getUserResult */
        $getUserResult = $this->client->findUser($getUserCommand);
        $this->assertInstanceOf(User::class, $getUserResult);

        $this->assertEquals(101,$getUserResult->statusCode);
    }
}

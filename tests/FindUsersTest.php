<?php

use Arnovr\OwncloudProvisioning\Command\FindUsers;
use Arnovr\OwncloudProvisioning\ProvisioningClient;
use Arnovr\OwncloudProvisioning\Result\UserList;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class FindUsersTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ProvisioningClient
     */
    private $client;

    /**
     * @test
     */
    public function shouldFindUsers()
    {
        $mock = new MockHandler([
            new Response(200, [], '<?xml version="1.0"?><ocs><meta><statuscode>100</statuscode><status>ok</status></meta><data><users><element>Frank</element><element>Frankie</element></users></data></ocs>'),
        ]);

        $handler = HandlerStack::create($mock);

        $this->client = ProvisioningClientCreator::createProvisioningClient($handler);

        $findUsersCommand = new FindUsers('frank');
        /** @var UserList $findUsersResult */
        $findUsersResult = $this->client->findUsers($findUsersCommand);
        $this->assertInstanceOf(UserList::class, $findUsersResult);

        $this->assertEquals(100,$findUsersResult->statusCode);
        $this->assertContains('Frank', $findUsersResult->users);
        $this->assertContains('Frankie', $findUsersResult->users);
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

        $findUsersCommand = new FindUsers('frank');
        /** @var UserList $findUsersResult */
        $findUsersResult = $this->client->findUsers($findUsersCommand);
        $this->assertInstanceOf(UserList::class, $findUsersResult);

        $this->assertEquals(101,$findUsersResult->statusCode);
    }
}

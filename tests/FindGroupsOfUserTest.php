<?php


use Arnovr\OwncloudProvisioning\Command\FindGroupsOfUser;
use Arnovr\OwncloudProvisioning\ProvisioningClient;
use Arnovr\OwncloudProvisioning\Result\GroupsList;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class FindGroupsOfUserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ProvisioningClient
     */
    private $client;

    /**
     * @test
     */
    public function shouldFindGroups()
    {
        $mock = new MockHandler([
            new Response(200, [], '<?xml version="1.0"?><ocs><meta><statuscode>100</statuscode><status>ok</status></meta><data><groups><element>group1</element><element>group2</element></groups></data></ocs>'),
        ]);

        $handler = HandlerStack::create($mock);

        $this->client = ProvisioningClientCreator::createProvisioningClient($handler);

        $findGroupOfUser = new FindGroupsOfUser('frank');
        $findUsersResult = $this->client->findGroupOfUsers($findGroupOfUser);
        $this->assertInstanceOf(GroupsList::class, $findUsersResult);

        $this->assertEquals(100, $findUsersResult->statusCode);
        $this->assertContains('group1', $findUsersResult->groups);
        $this->assertContains('group2', $findUsersResult->groups);
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


        $findGroupOfUser = new FindGroupsOfUser('frank');
        $findUsersResult = $this->client->findGroupOfUsers($findGroupOfUser);
        $this->assertEquals(101,$findUsersResult->statusCode);
    }
}
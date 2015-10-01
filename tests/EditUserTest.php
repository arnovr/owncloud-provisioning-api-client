<?php

use Arnovr\OwncloudProvisioning\Command\EditUser;
use Arnovr\OwncloudProvisioning\ProvisioningClient;
use Arnovr\OwncloudProvisioning\Result\EditUserResult;
use Arnovr\OwncloudProvisioning\Result\Exception\NothingToModifyException;
use Arnovr\OwncloudProvisioning\Result\StatusResult;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class EditUserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ProvisioningClient
     */
    private $client;

    /**
     * @test
     */
    public function shouldEditUser()
    {
        $mock = new MockHandler([
            new Response(200, [], '<?xml version="1.0"?><ocs><meta><statuscode>100</statuscode><status>ok</status></meta></ocs>'),
        ]);

        $handler = HandlerStack::create($mock);

        $this->client = ProvisioningClientCreator::createProvisioningClient($handler);


        $editUserCommand = new EditUser('username');
        $editUserCommand->email = 'email@email.com';
        $editUserCommand->quota = '1243545';
        $editUserCommand->display = 'Email at email dot com';
        $editUserCommand->password = 'mynewpassword';

        /** @var StatusResult $editUserResult */
        $editUserResult = $this->client->editUser($editUserCommand);
        $this->assertInstanceOf(StatusResult::class, $editUserResult);

        $this->assertEquals(
            100,
            $editUserResult->statusCode
        );
    }

    /**
     * @test
     */
    public function shouldFailToEditUserWhenNoDataIsSupplied()
    {
        $this->setExpectedException(NothingToModifyException::class);
        $handler = HandlerStack::create();

        $this->client = ProvisioningClientCreator::createProvisioningClient($handler);

        $editUserCommand = new EditUser('username');
        $this->client->editUser($editUserCommand);
    }
}

# Owncloud Provisioning API Client
This is the repository of the owncloud provisioning api client, 
which gives the ability to provision owncloud users, groups and apps

It implements the following provisioning API:
https://doc.owncloud.org/server/8.0/admin_manual/configuration_user/user_provisioning_api.html

## Initialize Provisioning Client:
````
use Arnovr\OwncloudProvisioning\ApiConnection;
use Arnovr\OwncloudProvisioning\ProvisioningClient;
use Arnovr\OwncloudProvisioning\ResponseParser\XMLResponseParser;
use GuzzleHttp\Client;

$provisioningClient = new ProvisioningClient(
    new ApiConnection(
        new Client(),
        'http://www.your-owncloud-instance.com/ocs/v1.php/cloud'
        'username',
        'password'
        5 //timeout is optional
    ),
    new XMLResponseParser()
);
````

## Create owncloud user
````
$user = new CreateUser('username', 'password');
$provisioningClient->createUser($user);
````

## Change Email address of a user
````
$user = new EditUser('usertochange@email.com');
$user->email = 'email@email.com';

$provisioningClient->editUser($user);
````

## Possible commands:
- AddUserToGroup
- CreateGroup
- CreateUser
- DeleteGroup
- DeleteUser
- DeleteUserFromGroup
- EditUser
- FindGroups
- FindGroupsOfUser
- FindSubAdminGroupsOfUser
- FindUser
- FindUsers
- FindUsersOfGroup
- MakeUserSubAdminOfGroup
- RemoveUsersSubAdminRightsFromGroup

## TODO:
- DisableApp
- EnableApp
- FindAppInfo
- FindInstalledApps
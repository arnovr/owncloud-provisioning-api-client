# Owncloud Provisioning API Client
This is the repository of the **ownCloud provisioning api client**, which gives the ability to provision ownCloud users, groups and apps.

It implements the following provisioning API: [User Provisioning API](https://doc.owncloud.org/server/8.0/admin_manual/configuration_user/user_provisioning_api.html)

## Installation

Install via composer
```bash
composer require arnovr/owncloud-provisioning-api-client
```

## Usage

### Initialize provisioning client:
```php
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
```

### Create ownCloud user
```php
$user = new CreateUser('username', 'password');
$provisioningClient->createUser($user);
```

### Change email address of a user
```php
$user = new EditUser('usertochange@email.com');
$user->email = 'email@email.com';

$provisioningClient->editUser($user);
```

### Possible commands:
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

### TODO:
- DisableApp
- EnableApp
- FindAppInfo
- FindInstalledApps

## License
This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

# Permissions

This is an extremely simple permission manager for the [Fish IRC-Bot](https://github.com/nkreer/Fish). It helps you with managing others' permissions on the fly, directly on IRC. To use it, you first must have set up your own account that has the permission "permissions.manage" or is an admin. To do that, put a file named yourusername.json in your users/network/ directory. It should contain the following:

```json
{
	"name":"yourusername",
	"lastSeen":0,
	"admin":true,
	"permissions":[]
}
```

## Installation

To install this plugin, drop the Permissions.phar-File into your plugins directory and either restart the Bot or run `loadPlugin Permissions` if you already have the permissions to do so. If you wish to pack the Phar yourself, drop the Permissions directory into your plugins folder, install [PluginTools](https://github.com/nkreer/PluginTools) and run `makeplugin Permissions`. If you wish to load it directly after making, append `load` to the command.

## Usage

To use any of the commands that this plugin provides, you need to be an admin or have the Permission `permissions.manage` set. There are various sub-permissions to run the sub-commands. These are:

| Permission					| Description	 |
|--------------------------|-------------|
| permissions.manage.add   | `permissions <User> add <permission>` | 
| permissions.manage.remove| `permissions <User> remove <permission>`|

`<User>` must be the nickname of a user that is known to the bot. Currently, there is no support for changing the permissions of offline-users, however, that might be implemented later.

## License

This code is licensed to the public domain.
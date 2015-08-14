# cakephp-3-acl-example
A very simple CakePHP 3 ACL plugin usage example.  This example is based on [Simple Acl controlled Application](http://book.cakephp.org/2.0/en/tutorials-and-examples/simple-acl-controlled-application/simple-acl-controlled-application.html) for CakePHP 2.  The differences are described in this document.  The files in this repository contain the changes and implementations of functions discuessed below.

### Getting started
- Run `composer update` from the `app` directory to download the CakePHP source
- Add the [CakePHP ACL plugin](https://github.com/cakephp/acl) to `app/composer.json`
- Run `composer update` to download the ACL source
- Include the ACL plugin in `app/config/bootstrap.php` 

```php
Plugin::load('Acl', ['bootstrap' => true]);
```

###Example schema
An example schema taken from the CakePHP 2 ACL tutorial can be found in the file `example.sql`.
After the schema is created, proceed to "bake" the application.

```bash
bin/cake bake all groups
bin/cake bake all users
bin/cake bake all posts
bin/cake bake all widgets
```

### Preparing to Add Auth
- Add `UsersController::login` function
- Add `UsersController::logout` function
- Add `src/Templates/Users/login.ctp`
- Modify `UsersTable::beforeSave` to hash the password before saving
- Include and configure the `AclComponent` and `AuthComponent` in `AppController`
 
### Add Temporary Auth Overrides
Temporarily allow access to `UsersController` and `GroupsController` so groups and users can be added. Add the following implementation of `beforeFilter` to `src/Controllers/UsersController.php` and `src/Controllers/GroupsController.php`:
```php
public function initialize()
{
	parent::initialize();
	
	$this->Auth->allow();
}
```  

### Initialize the Db Acl tables
- Create the ACL related tables by running `bin/cake Migrations.migrations migrate -p Acl`

### Model Setup
#### Acting as a requester
- Add the requester behavior to `GroupsTable` and `UsersTable`
 - Add `$this->addBehavior('Acl.Acl', ['type' => 'requester']);` to the `initialize` function in the files `src/Model/Table/UsersTable.php` and `src/Model/Table/GroupsTable.php`

#### Implement `parentNode` function in `Group` entity
Add the following implementation of `parentNode` to the file `src/Model/Entity/Group.php`:
```php
public function parentNode()
{
	return null;
}
```

#### Implement `parentNode` function in `User` entity
Add the following implementation of `parentNode` to the file `src/Model/Entity/User.php`:
```php
public function parentNode()
{
	if (!$this->id) {
		return null;
	}
	if (isset($this->group_id)) {
		$groupId = $this->group_id;
	} else {
		$Users = TableRegistry::get('Users');
		$user = $Users->find('all', ['fields' => ['group_id']])->where(['id' => $this->id])->first();
		$groupId = $user->group_id;
	}
	if (!$groupId) {
		return null;
	}
	return ['Groups' => ['id' => $groupId]];
}
```

### Creating ACOs
The [ACL Extras](https://github.com/markstory/acl_extras/) plugin referred to in the CakePHP 2 ACL tutorial is now integrated into the [CakePHP ACL plugin](https://github.com/cakephp/acl) for CakePHP 3.
- Run `bin/cake acl_extras aco_sync` to automatically create ACOs.
- ACOs and AROs can be managed manually using the ACL shell.  Run `bin/cake acl` for more information.

### Creating Users and Groups
#### Create Groups
- Navigate to `/groups/add` and add the groups
  - For this example, we will create `Administrator`, `Manager`, and `User`

#### Create Users
- Navigate to `/users/add` and add the users
  - For this example, we will create one user in each group
    - `test-administrator` is an `Administrator`
    - `test-manager` is a `Manager`
    - `test-user` is a `User`
	
### Remove Temporary Auth Overrides
Remove the temporary auth overrides by removing the `beforeFilter` function or the call to `$this->Auth->allow();` in `src/Controllers/UsersController.php` and `src/Controllers/GroupsController.php`.
	
### Configuring Permissions
#### Configuring permissions using the ACL shell
First, find the IDs of each group you want to grant permissions on.  There are several ways of doing this.  Since we will be at the console anyway, the quickest way is probably to run `bin/cake acl view aro` to view the ARO tree.  In this example, we will assume the `Administrator`, `Manager`, and `User` groups have IDs 1, 2, and 3 respectively.
- Grant members of the `Administrator` group permission to everything
  - Run `bin/cake acl grant Groups.1 controllers`
- Grant members of the `Manager` group permission to all actions in `Posts` and `Widgets`
  - Run `bin/cake acl deny Groups.2 controllers`
  - Run `bin/cake acl grant Groups.2 controllers/Posts`
  - Run `bin/cake acl grant Groups.2 controllers/Widgets`
- Grant members of the `User` group permission to view `Posts` and `Widgets`
  - Run `bin/cake acl deny Groups.3 controllers`
  - Run `bin/cake acl grant Groups.3 controllers/Posts/view`
  - Run `bin/cake acl grant Groups.3 controllers/Widgets/view`
- Allow all groups to logout
  - Run `bin/cake acl grant Groups.1 controllers/Users/logout`
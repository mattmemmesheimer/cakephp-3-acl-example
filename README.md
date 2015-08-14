# cakephp-3-acl-example
A very simple CakePHP 3 ACL plugin usage example.  This example is based on [Simple Acl controlled Application](http://book.cakephp.org/2.0/en/tutorials-and-examples/simple-acl-controlled-application/simple-acl-controlled-application.html) for CakePHP 2.

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
- Temporarily allow access to `UsersController` and `GroupsController`

### Initialize the Db Acl tables
- Create the ACL related tables by running `bin/cake Migrations.migrations migrate -p Acl`

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
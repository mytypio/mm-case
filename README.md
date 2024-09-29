
# Meditation Moments - Case

This demo project is created for Meditation Moments. it contains a User management application with a API intergration of Mixpanel.

![App Screenshot](https://raw.githubusercontent.com/mytypio/mm-case/refs/heads/master/resources/screenshots/screenshot-homepage.png)

## Requirements

This project requires PHP8.1 or later to run. To run PHPUnit tests with code-coverage raports you need PCOV or xDebug to be installed on the local system.

## Installation

To get started with this demo project you have to run a few commands as described in this file.


**Install packages**

First install all the packages by running composer install.

```bash 
composer install
```

**Setup database**

To setup the database for this project, you can run the following command:

```bash
  php artisan migrate
```

This command will create a database with tables that are needed for this project to run.

**Seed database**

Next up, we can load some dummy data into the database to get started:

```bash
  php db:seed
```

This command will generate 10 random users with a role ROLE_USER. These users can login and edit their profile. Next to that a user will be generated with the role ROLE_ADMIN, this user is able to manage the registered users.


**Run local server**

Then you can run the following command to setup a server:

```bash
  php artisan serve
```

The demo will be availible on http://127.0.0.1:8000

**Start worker**

To process async events you need to run the following command.

```bash
  php artisan queue:work
```
## Environment Variables

To run this project, you will need to add or modify the following environment variables to your .env file or just copy the .env.example

`DB_CONNECTION=sqlite`

`DB_DATABASE=/your/local/path/database/db.sqlite`

`DB_FOREIGN_KEYS=true`

`MIXPANEL_URL="https://the_url_to_mixpanel"`

`MIXPANEL_TOKEN="you_mixpanel_token"`

`QUEUE_CONNECTION=database`
## Functionalities
This demo application has some basic functionalities regarding registering and updating a User model. Trough some basic forms a user can register, login and update their profile.

### Creating a new User
A new user can be created by filling in a registration form. The only fields that are required are a firstname, lastname, emailaddress and password. The user is automaticlly logged in when completing the registration.

A couple of fields are required and are validated:

| Field  | Validation |
| ------------- | ------------- |
| FirstName  | ```'required', 'string', 'max:255'```  |
| LastName  | ```'required', 'string', 'max:255'```  |
| EmailAddress  | ```'required', 'string', 'max:255', 'lowercase', 'email', 'unique'```  |

Other fields that are required but automaticlly filled for creating a new user are: ```status```, ```userStorageType```, ```lastSyncedAt``` and ```role```.

### Updating a User
When a user is logged in, they are able to edit their profile. They can change their firstname, lastname and emailaddress.

There is also a posibility for a user to reset their password.

### Deleting a User
When a User is logged in, they are also able to delete their own account. This account will be soft deleted, that means the status of a user will be set at inactive and the field deleted_at is set to the current timestamp. This way data will be accessible for analyses.

### User management

A User with ROLE_ADMIN will be redirected to the user management dashboard. This dashboard gives the User the posibility to manage all registered Users.

Users can be edited or removed. All these actions are also synced with Mixpanel.
## Data syncronisation
This application supports data synchronization with external parties. Using the ```UserStorageAdapterFactory```, a storage adapter can be linked to a user. When a new adapter is added to the factory, integrating an additional external party becomes seamless. The new adapter must be compatible with the ```UserStorageInterface```, ensuring that all functions and events can be integrated with the new party without modifying the core system.

### Mixpanel Integration

User activities and events are seamlessly synced and logged through the Mixpanel API. For example, when a user updates or deletes their account, these actions are promptly reflected in Mixpanel.

To ensure optimal performance, events triggered within the application are processed using a database queue. This prevents any slowdown or downtime for the user, as events are queued and executed in the background.

The communication with Mixpanel is based on a "Project Token" provided by Mixepanel. This token is related to the Mixepanel project.


## Running Tests

To run tests, run the following command

```bash
  ./vendor/bin/phpunit
```

To run PHPUnit tests with coverage you need to install PCOV or xDebug.
(see: https://github.com/krakjoe/pcov/blob/develop/INSTALL.md)

A pre-generated coverage report is also availible in the ./tests/Report/ folder.


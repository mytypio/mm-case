# Meditation Moments - Demo Project

This is a demo project created for **Meditation Moments**. It features a user management application with Mixpanel API integration for tracking user activities and events.

![App Screenshot](https://raw.githubusercontent.com/mytypio/mm-case/refs/heads/master/resources/screenshots/screenshot-homepage.png)

## Requirements

- **PHP**: Version 8.1 or later.
- **PHPUnit**: For running tests with code coverage reports, PCOV or xDebug needs to be installed locally.

## Installation

To get started with the demo project, follow these steps:

### 1. Install Packages

Run the following command to install the required packages:

```bash 
composer install
```

### 2. Set Up the Database

Run the migration command to create the necessary database tables:

```bash
php artisan migrate
```

### 3. Seed the Database

Load sample data into the database to populate it with test users:

```bash
php artisan db:seed
```

This will generate:
- 10 random users with the `ROLE_USER`.
- 1 admin user with the `ROLE_ADMIN` who has access to manage registered users.

### 4. Run Local Server

Start a local development server:

```bash
php artisan serve
```

The application will be available at [http://127.0.0.1:8000](http://127.0.0.1:8000).

### 5. Start Queue Worker

To process asynchronous events, run the following command:

```bash
php artisan queue:work
```

## Environment Variables

You need to configure the following environment variables in your `.env` file (or copy and edit the `.env.example` file):

```bash
DB_CONNECTION=sqlite
DB_DATABASE=/your/local/path/database/db.sqlite
DB_FOREIGN_KEYS=true
MIXPANEL_URL="https://the_url_to_mixpanel"
MIXPANEL_TOKEN="your_mixpanel_token"
QUEUE_CONNECTION=database
```

## User Interface

The user interface is built using **Blade** and **TailwindCSS**, maintaining a clean, responsive design that works across all devices. Most components are sourced from **TailwindUI** to streamline development, and no custom CSS is used.

## Key Features

This demo application provides fundamental functionalities for user management, including user registration, profile updates, and account deletion.

### 1. Creating a New User

A new user can be registered by filling out a simple form. The following fields are required:

| Field         | Validation Rules                                        |
| ------------- | ------------------------------------------------------- |
| First Name    | `'required', 'string', 'max:255'`                       |
| Last Name     | `'required', 'string', 'max:255'`                       |
| Email Address | `'required', 'string', 'max:255', 'email', 'unique'`    |
| Password      | Required field with standard password validation        |

Upon successful registration, the user is automatically logged in. Additionally, fields like `status`, `userStorageType`, `lastSyncedAt`, and `role` are automatically populated.

### 2. Updating a User

Logged-in users can edit their profiles to update their first name, last name, and email address. They can also reset their password if needed.

### 3. Deleting a User

Users can delete their own account. This action soft-deletes the account, setting the status to "inactive" and timestamping the `deleted_at` field, making the data available for analysis without permanent deletion.

### 4. User Management (Admin)

Users with the `ROLE_ADMIN` will be redirected to a user management dashboard, where they can view, edit, and delete any registered users. All actions are synchronized with Mixpanel for tracking purposes.

## Data Synchronization

The application supports data synchronization with external systems. Using the `UserStorageAdapterFactory`, different storage adapters can be linked to users, facilitating seamless integration with multiple external parties. The adapter must be compatible with the `UserStorageInterface`, ensuring smooth functionality without modifying the core system.

## Mixpanel Integration

All user activities and events are logged and synced with Mixpanel via its API. For example, when users update or delete their accounts, these actions are reflected in Mixpanel in real-time.

To optimize performance, events are processed in the background using a queue system, ensuring no downtime or slowdowns for the user. Mixpanel integration relies on a project-specific token for communication.

## Running Tests

To run the test suite, execute:

```bash
./vendor/bin/phpunit
```

For code coverage reports, ensure PCOV or xDebug is installed. You can follow the [PCOV installation guide](https://github.com/krakjoe/pcov/blob/develop/INSTALL.md) for assistance.

A pre-generated coverage report is also available in the `./tests/Report/` folder.

### Code Coverage Summary:

- **Classes**: 84.00% (21/25)
- **Methods**: 89.61% (69/77)
- **Lines**: 96.43% (405/420)
```

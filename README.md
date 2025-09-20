# Aula 17 Eloquent ORM

This project demonstrates the use of Eloquent ORM in a PHP application. It provides a simple user model and a basic setup for interacting with a database.

## Project Structure

```
Aula_17_EloquentORM
├── config
│   └── database.php
├── public
│   └── index.php
├── src
│   ├── Models
│   │   └── User.php
│   └── bootstrap.php
├── composer.json
└── README.md
```

## Requirements

- PHP 7.2 or higher
- Composer

## Installation

1. Clone the repository or download the project files.
2. Navigate to the project directory:
   ```
   cd H:\laragon\www\Testes\Aula_17_EloquentORM
   ```
3. Install the dependencies using Composer:
   ```
   composer install
   ```

## Configuration

Edit the `config/database.php` file to set your database connection parameters:

```php
return [
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'your_database_name',
    'username' => 'your_username',
    'password' => 'your_password',
];
```

## Usage

To run the application, access the `public/index.php` file through your web server. This file serves as the entry point for handling requests.

## License

This project is open-source and available under the MIT License.
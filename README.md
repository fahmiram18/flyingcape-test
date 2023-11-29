# Flyingcape Test Project

API for E-Learning App

# Installation

Make sure you have Composer, Local Server (XAMPP, MAMP, LARAGON), Postman / Insomnia, and MySQL installed.

Clone the project 

```bash
git clone https://github.com/fahmiram18/flyingcape-test.git
cd flyingcape-test
```

Create database

```sql
CREATE DATABASE `db_flyingcape_test`;
USE db_flyingcape_test;
```

Install Dependencies

```bash
composer install
```

Copy env

```bash
cp .env.example .env
```

Generate App Key

```bash
php artisan key:generate
```

Run Migration

```bash
php artisan migrate --seed
```

Start the server
```bash
php artisan serve
```

# Testing

Duplicate the original database
```sql
CREATE TABLE db_flyingcape_test LIKE testing_db_flyingcape_test;
```

Run Test
```bash
php artisan test --testsuite=Feature --env=testing
```

# Request Collection

Import Flyingcape Test Project.postman_collection.json on Postman/Insomnia to see Request Collection.

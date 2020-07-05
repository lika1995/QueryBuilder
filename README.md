#QueryBuilder

Query Builder is a fast, simple, methods-chaining, dependency-free library to create 
SQL Queries simple and fast to write, extend and manage.

## Installation

add to your file composer.json this settings
```json
 "name": "yourProjectName",
    "description": "Your description",
    "type": "your type",
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/lika1995/querybuilder"
        }
    ],
    "require": {
        "lika1995/querybuilder": "dev-master"
    },
    "minimum-stability": "dev"
}
```
Add this package to your composer.

composer require lika1995/querybuilder


## Usage
```php
<?php
include 'QueryBuilder.php';

$connection = new PDO('dns...');
$qb = new QueryBuilder($connection);

// Select all

$qb->getAll('table_name');

// Insert

$qb->create('table_name', ['name' => 'Adam', 'age' => '...']);

// Select one by id

$qb->getOneById('table_name', $id);

// Update

$qb->update('table_name', ['name' => 'Alex'], $id);

//Delete

$qb->delete('table_name', $id);
```
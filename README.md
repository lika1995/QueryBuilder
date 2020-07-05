#QueryBuilder

Query Builder is a fast, simple, methods-chaining, dependency-free library to create 
SQL Queries simple and fast to write, extend and manage.

##Installation

Download QueryBuilder.php than save it to your project directory.

##Usage
```php
<?php
include 'QueryBuilder.php';

$connection = new PDO('dns...');
$qb = new QueryBuilder($connection);

//Select all

$qb->getAll('table_name');

//Insert

$qb->create('table_name', ['name' => 'Adam', 'age' => '...']);

//Select one by id

$qb->getOneById('table_name', $id);

//Update

$qb->update('table_name', ['name' => 'Alex'], $id);

//Delete

$qb->delete('table_name', $id);
```
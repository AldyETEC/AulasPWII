<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Create a new Capsule instance
$capsule = new Capsule;

// Add a connection
$capsule->addConnection(require __DIR__ . '/../config/database.php');

// Set the global Eloquent instance
$capsule->setAsGlobal();

// Boot Eloquent
$capsule->bootEloquent();
<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/loadenv.php';

loadEnv(__DIR__ . '/.env');

$DB_HOST = getenv('DB_HOST');
$DB_PORT = getenv('DB_PORT');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

if (!$DB_HOST || !$DB_PORT || !$DB_USER || !$DB_PASS) {
    die('Please set DB_HOST, DB_PORT, DB_USER, and DB_PASS environment variables.');
}

$client = new MongoDB\Client('mongodb://' . $DB_USER . ':' . $DB_PASS . '@' . $DB_HOST . ':' . $DB_PORT);

$db = $client->kampus;

$collection = $db->mahasiswa;

echo "Connected to MongoDB successfully!\n";

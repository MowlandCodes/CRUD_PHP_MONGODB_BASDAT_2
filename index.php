<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/loadenv.php';
loadEnv(__DIR__ . '/.env');

require __DIR__ . '/connection.php';

try {
  $conn = Database::getInstance();
  $db = $conn->getDatabase('dbBasdat');

  $collection = $db->getCollection('mahasiswa');

  $count = $collection->countDocuments();
  echo "<br>Jumlah data: $count";
} catch (Exception $e) {
  echo $e->getMessage();
  exit;
}

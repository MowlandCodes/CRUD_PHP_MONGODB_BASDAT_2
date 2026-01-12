<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/loadenv.php';
loadEnv(__DIR__ . '/.env');

require __DIR__ . '/connection.php';

try {
  $conn = Database::getInstance();

  $db = $conn->getDatabase('dbBasdat');
  $collection = $db->getCollection('mahasiswa');
} catch (Exception $e) {
  die("Error : {$e->getMessage()}");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/style.css">
  <title>Praktikum 15 | Basis Data 2</title>
</head>

<body>
  <main class="min-h-screen flex flex-col font-sans">
    <h1 class="text-3xl text-blue-400 font-bold">Hello World</h1>
  </main>
</body>

</html>

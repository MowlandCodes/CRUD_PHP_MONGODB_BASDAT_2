<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/loadenv.php';
loadEnv(__DIR__ . '/.env');

require __DIR__ . '/connection.php';

use MongoDB\BSON\ObjectId;

$conn = Database::getInstance();
$db = $conn->getDatabase('dbBasdat');
$collection = $db->getCollection('mahasiswa');

function redirect(string $url)
{
  header("Location: {$url}");
  exit();
}

/** @var 'add'|'edit'|'delete' */
$action = $_GET['action'] ?? null;

try {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch ($action) {
      case 'add':
        if (empty($_POST['nim']) || empty($_POST['nama']) || empty($_POST['prodi']) || empty($_POST['umur'])) {
          redirect('index.php');
        }

        $data = [
          'nim' => htmlspecialchars($_POST['nim']),
          'nama' => htmlspecialchars($_POST['nama']),
          'prodi' => htmlspecialchars($_POST['prodi']),
          'umur' => intval(htmlspecialchars($_POST['umur'])),
        ];


        $collection->insertOne($data);
        redirect('index.php');
        break;

      case 'edit':
        if (empty($_POST['nim']) || empty($_POST['nama']) || empty($_POST['prodi']) || empty($_POST['umur'])) {
          redirect('index.php');
        }

        $id = new ObjectId(htmlspecialchars($_POST['id']));

        $data = [
          'nim' => htmlspecialchars($_POST['nim']),
          'nama' => htmlspecialchars($_POST['nama']),
          'prodi' => htmlspecialchars($_POST['prodi']),
          'umur' => intval(htmlspecialchars($_POST['umur'])),
        ];

        $collection->updateOne(['_id' => $id], ['$set' => $data]);

        redirect('index.php');
        break;
    }
  }

  if ($action == 'delete' && isset($_GET['id'])) {
    $id = new ObjectId(htmlspecialchars($_GET['id']));
    $collection->deleteOne(['_id' => $id]);
    redirect('index.php');
  }
} catch (Exception $e) {
  throw new Exception($e->getMessage());
}

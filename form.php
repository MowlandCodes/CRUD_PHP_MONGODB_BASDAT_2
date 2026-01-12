<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/loadenv.php';
loadEnv(__DIR__ . '/.env');

require __DIR__ . '/connection.php';

use MongoDB\BSON\ObjectId;

$conn = Database::getInstance();
$db = $conn->getDatabase('dbBasdat');
$collection = $db->getCollection('mahasiswa');


$data = null;
$isEdit = false;

if (isset($_GET['id'])) {
  $id = new ObjectId(htmlspecialchars($_GET['id']));
  $data = $collection->findOne(['_id' => $id]);
  $isEdit = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?= $isEdit ? "Edit Mahasiswa" : "Tambah Mahasiswa" ?>
  </title>
  <link rel="stylesheet" href="assets/style.css">
</head>

<body class="bg-gray-900 text-white font-sans flex justify-center items-center h-screen">

  <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-400">
      <?= $isEdit ? '✏️ Edit Mahasiswa' : '➕ Tambah Mahasiswa' ?>
    </h2>

    <form action="process.php?action=<?= $isEdit ? 'edit' : 'add' ?>" method="POST">

      <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= $data['_id'] ?>">
      <?php endif; ?>

      <div class="mb-4">
        <label class="block text-gray-50 text-sm font-bold mb-2">Nama Lengkap</label>
        <input type="text" name="nama" required
          class="w-full px-3 py-2 text-gray-100 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          value="<?= $data['nama'] ?? '' ?>" placeholder="Contoh: Asep Knalpot">
      </div>

      <div class="mb-4">
        <label class="block text-gray-50 text-sm font-bold mb-2">NIM</label>
        <input type="text" name="nim" required
          class="w-full px-3 py-2 text-gray-100 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          value="<?= $data['nim'] ?? '' ?>" placeholder="Contoh: 12345678">
      </div>

      <div class="mb-4">
        <label class="block text-gray-50 text-sm font-bold mb-2">Prodi</label>
        <input type="text" name="prodi" required
          class="w-full px-3 py-2 text-gray-100 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          value="<?= $data['prodi'] ?? '' ?>" placeholder="Contoh: Teknik Memperbaiki Hati">
      </div>

      <div class="mb-6">
        <label class="block text-gray-50 text-sm font-bold mb-2">Umur</label>
        <input type="text" name="umur" required
          class="w-full px-3 py-2 text-gray-100 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
          value="<?= $data['umur'] ?? '' ?>" placeholder="Contoh: 17">
      </div>

      <div class="flex items-center justify-between">
        <a href="index.php" class="text-blue-200 hover:text-white text-sm transition">Batal</a>
        <button type="submit"
          class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-500">
          <?= $isEdit ? 'Update Data' : 'Simpan Data' ?>
        </button>
      </div>
    </form>
  </div>

</body>

</html>

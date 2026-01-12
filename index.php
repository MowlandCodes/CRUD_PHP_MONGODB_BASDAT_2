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
  throw new Exception($e->getMessage());
}

if (isset($collection)) {
  $cursor = $collection->find();
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

<body class="bg-gray-900 text-white font-sans antialiased">

  <div class="container mx-auto p-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-blue-500">Data Mahasiswa</h1>
      <a href="form.php" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded transition">
        + Tambah Data
      </a>
    </div>

    <div class="bg-gray-800 shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full leading-normal">
        <thead>
          <tr>
            <th
              class="px-5 py-3 border-b-2 border-gray-700 bg-gray-900 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
              Nama</th>
            <th
              class="px-5 py-3 border-b-2 border-gray-700 bg-gray-900 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
              NIM</th>
            <th
              class="px-5 py-3 border-b-2 border-gray-700 bg-gray-900 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
              Prodi</th>
            <th
              class="px-5 py-3 border-b-2 border-gray-700 bg-gray-900 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">
              Umur</th>
            <th
              class="px-5 py-3 border-b-2 border-gray-700 bg-gray-900 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">
              Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cursor as $mhs): ?>
            <tr class="hover:bg-gray-700 transition">
              <td class="px-5 py-5 border-b border-gray-700 text-sm">
                <p class="text-gray-200 whitespace-no-wrap">
                  <?= htmlspecialchars($mhs['nama'] ?? '-') ?>
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-700 text-sm">
                <span class="inline-block bg-gray-600 rounded-full px-3 py-1 text-xs font-semibold text-gray-200">
                  <?= htmlspecialchars($mhs['nim'] ?? '-') ?>
                </span>
              </td>
              <td class="px-5 py-5 border-b border-gray-700 text-sm">
                <p class="text-gray-200 whitespace-no-wrap">
                  <?= htmlspecialchars($mhs['prodi'] ?? '-') ?>
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-700 text-sm">
                <p class="text-gray-200 whitespace-no-wrap">
                  <?= htmlspecialchars($mhs['umur'] ?? '-') ?>
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-700 text-sm text-center">
                <a href="form.php?id=<?= $mhs['_id'] ?>" class="text-yellow-400 hover:text-yellow-300 mr-3">Edit</a>
                <a href="process.php?action=delete&id=<?= $mhs['_id'] ?>"
                  onclick="return confirm('Yakin mau ngehapus data ini?')"
                  class="text-red-400 hover:text-red-300">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php if ($collection->countDocuments() === 0): ?>
        <div class="p-4 text-center text-gray-500">Tidak ada data tersedia.</div>
      <?php endif; ?>
    </div>
  </div>

</body>

</html>

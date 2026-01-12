<?php

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database as MongoDatabase;

class Database
{
    /**
     * @var Database|null
     */
    private static ?Database $instance = null;

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var MongoDatabase
     */
    private MongoDatabase $db;

    private function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        if (!$host || !$port || !$user || !$pass) {
            throw new Exception('❌ Environment variables belum lengkap, woy!');
        }

        $userEncoded = urlencode($user);
        $passEncoded = urlencode($pass);

        $uri = "mongodb://{$userEncoded}:{$passEncoded}@{$host}:{$port}";

        try {
            $this->client = new Client($uri);

            $this->db = $this->client->selectDatabase('test');

            $this->db->command(['ping' => 1]);
        } catch (Exception $e) {
            die('🔥 Database Connection Error: ' . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
            echo "✅ New Connection Created\n";
        } else {
            echo "♻️ Using Existing Connection (Cached)\n";
        }

        return self::$instance;
    }

    public function getCollection(string $collectionName): Collection
    {
        return $this->db->$collectionName;
    }

    public function getDatabase(string $dbName): MongoDatabase
    {
        return $this->client->selectDatabase($dbName);
    }
}

<?php
namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use mysqli;

class ChatServer implements MessageComponentInterface {
    protected $clients;
    protected $conn;

    public function __construct() {
        $this->clients = [];

        // ✅ DB connection (adjust DB details here)
        $this->conn = new mysqli("localhost", "root", "", "chatapp");
        if ($this->conn->connect_error) {
            echo "Database connection failed: " . $this->conn->connect_error . "\n";
            exit;
        }
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients[$conn->resourceId] = $conn;
        echo "🟢 New connection: {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if (!isset($data['sender'], $data['receiver'], $data['message'])) return;

        $sender = $this->conn->real_escape_string($data['sender']);
        $receiver = $this->conn->real_escape_string($data['receiver']);
        $message = $this->conn->real_escape_string($data['message']);

        // ✅ Save to DB
        $this->conn->query("INSERT INTO messages (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')");

        $payload = json_encode([
            'sender' => $sender,
            'receiver' => $receiver,
            'message' => $message
        ]);

        foreach ($this->clients as $client) {
            $client->send($payload);
        }

        echo "📩 {$sender} → {$receiver}: {$message}\n";
    }

    public function onClose(ConnectionInterface $conn) {
        unset($this->clients[$conn->resourceId]);
        echo "🔴 Disconnected: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "❌ Error: {$e->getMessage()}\n";
        $conn->close();
    }
}

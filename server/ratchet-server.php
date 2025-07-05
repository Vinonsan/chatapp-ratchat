<?php
require_once __DIR__ . '/../vendor/autoload.php';


use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\ChatServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatServer()
        )
    ),
    2346 // Port
);

echo "✅ Ratchet server running at ws://0.0.0.0:2346\n";
$server->run();

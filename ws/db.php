<?php
function getDB() {
<<<<<<< HEAD
    static $pdo = null;
    if ($pdo === null) {
        $host = '127.0.0.1';
        $dbname = 'tp_flight';
        $username = 'root';
        $password = '';
=======
    $host = 'localhost';
    $dbname = 'tp_flight';
    $username = 'root';
    $password = 'root';
>>>>>>> Davida

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die(json_encode(['error' => $e->getMessage()]));
        }
    }
    return $pdo;
}

?>
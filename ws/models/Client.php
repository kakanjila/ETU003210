<?php
require_once __DIR__ . '/../db.php';

class Client {
    public static function getAll() {
        $db = getDB();
        $stmt = $db->query("SELECT * FROM clients");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM clients WHERE id_client = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getByEmail($email) {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM clients WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO clients (nom, email, mdp, telephone, date_naissance) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data->nom, $data->email, password_hash($data->mdp, PASSWORD_DEFAULT), $data->telephone, $data->date_naissance]);
        return $db->lastInsertId();
    }

    public static function update($id, $data) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE clients SET nom = ?, email = ?, telephone = ?, date_naissance = ? WHERE id_client = ?");
        $stmt->execute([$data->nom, $data->email, $data->telephone, $data->date_naissance, $id]);
    }

    public static function updatePassword($id, $newPassword) {
        $db = getDB();
        $stmt = $db->prepare("UPDATE clients SET mdp = ? WHERE id_client = ?");
        $stmt->execute([password_hash($newPassword, PASSWORD_DEFAULT), $id]);
    }

    public static function delete($id) {
        $db = getDB();
        $stmt = $db->prepare("DELETE FROM clients WHERE id_client = ?");
        $stmt->execute([$id]);
    }

    public static function verifyCredentials($email, $password) {
        $client = self::getByEmail($email);
        if ($client && password_verify($password, $client['mdp'])) {
            return $client;
        }
        return false;
    }
}
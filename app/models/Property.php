<?php

class Property
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function all(): array
    {
        $sql = "SELECT * FROM properties ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function find(int $id): object|false
    {
        $stmt = $this->db->prepare("SELECT * FROM properties WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function latest(int $limit = 6): array
    {
        $sql = "SELECT * FROM properties ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
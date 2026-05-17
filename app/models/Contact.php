<?php

class Contact
{
    private PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function all(): array
    {
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function store(array $data): bool
    {
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $subject = trim($data['subject'] ?? '');
        $message = trim($data['message'] ?? '');

        if ($name === '' || $email === '' || $message === '') {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        try {
            $sql = "INSERT INTO contacts (name, email, subject, message)
                    VALUES (:name, :email, :subject, :message)";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
            ]);
        } catch (PDOException $e) {
            Helper::log('Contact::store - ' . $e->getMessage());
            return false;
        }
    }
}
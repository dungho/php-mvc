<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *

 */
class User extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public function getAll()
    {
        $stmt = $this->db->query('SELECT id, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($params)
    {
        $this->query("INSERT INTO users(`name`, `email`) VALUES(:name, :email)");
        $this->bind(':name', $params['name']);
        $this->bind(':email', $params['email']);
        return $this->execute();
    }

    public function getByEmail($email)
    {
        $this->query("SELECT * FROM users where email=:email");
        $this->bind(':email', $email);
        return $this->single();
    }
}

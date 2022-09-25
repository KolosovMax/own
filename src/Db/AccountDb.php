<?php

namespace Disk\Db;

use Disk\Kernel\DbConnection;

use PDO;

class AccountDb
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = DbConnection::getInstance()->getConnection();
    }

    public function accountAdd($hash_pass, $email_value): void
    {
        $data = [
            'password' => $hash_pass,
            'email' => $email_value
        ];

        $sql = "INSERT INTO user(password, email)  VALUES (:password, :email) ";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute($data);
    }

    public function getAllUsers(): array
    {
        $sql = "SELECT password, email, id FROM user";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByName($email): array
    {
        $sql = "SELECT email,id FROM user WHERE  email = :email";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute(['email' => $email]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}


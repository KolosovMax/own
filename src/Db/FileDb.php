<?php

namespace Disk\Db;

use Disk\Kernel\DbConnection;
use PDO;

class FileDb
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = DbConnection::getInstance()->getConnection();
    }

    public function fileAdd($file_name, $folder_id): void
    {
        $data = [
            'name' => $file_name,
            'id_value' => $folder_id,
            'creation_date' => date('c')
        ];

        $sql = "INSERT INTO file(name, folder_id, creation_date)  VALUES (:name, :id_value, :creation_date) ";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute($data);
    }

    public function getFile($folder_value): array
    {
        $sql = "SELECT name, id FROM file WHERE folder_id = $folder_value";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFileById($file_id): array
    {
        $sql = "SELECT name,id FROM file WHERE id = $file_id";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getFileByName($file_name, $folder_id): array
    {
        $data = [
            'name' => "$file_name",
            'id_value' => $folder_id,
        ];

        $sql = "SELECT name FROM file WHERE name=:name  AND folder_id=:id_value ";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute($data);

        return $statement->fetch(PDO::FETCH_ASSOC);

    }

    public function deleteFile($file_id): void
    {
        $data = ['id' => $file_id];

        $sql = "DELETE FROM file WHERE id = :id";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute($data);
    }
}
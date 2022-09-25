<?php

namespace Disk\Db;

use Disk\Kernel\DbConnection;

use PDO;

class FolderDb
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = DbConnection::getInstance()->getConnection();
    }

    public function folderAdd($folder_name, $user_id): void
    {
        $data = [
            'name' => $folder_name,
            'id_value' => $user_id,
            'creation_date' => date('c')
        ];

        $sql = "INSERT INTO folder(name, user_id, creation_date)  VALUES (:name, :id_value, :creation_date) ";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute($data);
    }

    public function getFolder($user_value): array
    {
        $sql = "SELECT name, id FROM folder WHERE user_id = $user_value";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFolderById($id): array
    {
        $sql = "SELECT name,id FROM folder WHERE id = $id";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteFolder($folder_id): void
    {
        $data = ['id' => $folder_id];

        $sql = "DELETE FROM folder WHERE id=:id";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute($data);
    }

    public function getFolderByName($folder_name, $user_id): array
    {
        $data = [
            'name' => $folder_name,
            'user_id' => $user_id
        ];

        $sql = "SELECT name FROM folder WHERE name=:name AND user_id=:user_id";

        $statement = $this->dbConnection->prepare($sql);
        $statement->execute($data);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
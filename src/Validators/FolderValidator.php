<?php

namespace Disk\Validators;

use Disk\Db\FolderDb;

class FolderValidator
{
    public const NAME_ERROR = ' Папка с таким именем уже существует';
    public const STATUS_OK = 'ok';

    private $status = 'ok';
    private $folder_db;

    public function __construct()
    {
        $this->folder_db = new FolderDb();
    }

    public function validate(array $info): string
    {
        $this->nameValidate($info['folder_name'], $info['user_id']);

        return $this->status;
    }

    private function nameValidate($folder_name, $user_id): void
    {
        if (!($this->folder_db->getFolderByName($folder_name, $user_id))) {
            $this->status = self::STATUS_OK;
        } else {
            $this->status = $folder_name . '.' . self::NAME_ERROR . "\n";
        }
    }
}
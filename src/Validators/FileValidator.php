<?php

namespace Disk\Validators;

use Disk\Db\FileDb;

class FileValidator
{
    public const SIZE_ERROR = " Не правильный размер файла. Доступный размер 20Mb \n";
    public const UPLOAD_ERROR = " Что-то пошло не так \n";
    public const NAME_ERROR = " Файл с таким именем уже существует \n";
    public const STATUS_OK = "ok";

    private $file_db;
    private $status = 'ok';

    public function __construct()
    {
        $this->file_db = new FileDb();
    }

    public function validate($file): string
    {
        $this->sizeValidate($file['size']);
        $this->errorValidate($file['error']);
        $this->nameValidate($file['name'], $file['folder_id']);

        return $this->status;
    }

    protected function sizeValidate($size): void
    {
        if ($size < 2097152) $this->status = self::STATUS_OK;
        else $this->status = self::SIZE_ERROR;
    }

    protected function errorValidate($error): void
    {
        if (!$error) $this->status = self::STATUS_OK;
        else $this->status = self::UPLOAD_ERROR;
    }

    protected function nameValidate($file_name, $folder_id): void
    {
        if (!($this->file_db->getFileByName($file_name, $folder_id))) {
            $this->status = self::STATUS_OK;
        } else {
            $this->status = $file_name . '.' . self::NAME_ERROR . "\n";
        }
    }
}
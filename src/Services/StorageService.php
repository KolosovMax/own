<?php

namespace Disk\Services;

use Disk\Db\FileDb;
use Disk\Validators\FileValidator;

class StorageService
{
    private $file_db;
    private $file_validator;

    public function __construct()
    {
        $this->file_db = new FileDb();
        $this->file_validator = new FileValidator();
    }

    public function addFile($folder_id): string
    {
        if (($_FILES['file']['name'][0]) != '') {
            $files = $this->reArrayFiles($_FILES['file']);
            $everythingOk = true;

            foreach ($files as $file) {
                $file['folder_id'] = $folder_id;
                $file_name = $file['name'];
                $tmp_name = $file['tmp_name'];

                $result = $this->file_validator->validate($file);

                if ($result !== 'ok') {
                    $everythingOk = false;
                    continue;
                } else {
                    $full_file_name = $folder_id . '.' . $file_name;
                    move_uploaded_file($tmp_name, "storage/$full_file_name");

                    $this->file_db->fileAdd($file_name, $folder_id);
                }
            }

            if ($everythingOk) return 'ok';
            else return 'Некотрые файлы не были загружены';
        } else {
            return "Неверное имя файла";
        }
    }

    public function deleteFile($file_id, $folder_id): bool
    {
        $file = $this->file_db->getFileById($file_id);
        $file_name = $file['name'];

        if (unlink("storage/$folder_id.$file_name")) return true;
        else return false;
    }

    public function deleteAllFiles($folder_id): bool
    {
        $files = $this->file_db->getFile($folder_id);

        if (!empty($files)) {
            try {
                foreach ($files as $file) {
                    $file_name = $file['name'];
                    $file_id = $file['id'];

                    if (unlink("storage/$folder_id.$file_name")) {
                        $this->file_db->deleteFile($file_id);
                    }
                }
            } catch (\Exception $exception) {
                return false;
            }
        }

        return true;
    }

    public function reArrayFiles($file_post): array
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }

        return $file_ary;
    }
}
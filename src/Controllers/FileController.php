<?php

namespace Disk\Controllers;

use Disk\Db\FileDb;
use Disk\Kernel\Controller;
use Disk\Services\StorageService;
use Disk\Controllers\FolderController;

class FileController extends Controller
{
    private $folder_ctrl;
    private $file_db;
    private $storage;

    public function __construct()
    {
        $this->file_db = new FileDb();
        $this->storage = new StorageService();
        $this->folder_ctrl = new FolderController();
    }

    public function mainAction(): void
    {

    }

    public function addAction(): void
    {
        session_start();

        $folder_id = $_SESSION['folder_id'];
        $answer = $this->storage->addFile($folder_id);

        session_write_close();

        $table = $this->folder_ctrl->getFilesTable($folder_id);

        echo json_encode([
            'response' => $answer,
            'table' => $table
        ]);
    }

    public function deleteAction($file_id): void
    {
        session_start();

        $folder_id = $_SESSION['folder_id'];

        if ($this->storage->deleteFile($file_id, $folder_id)) {
            $this->file_db->deleteFile($file_id);
            header("location: /folder/detail/$folder_id");
        }
    }
}
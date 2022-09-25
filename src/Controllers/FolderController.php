<?php

namespace Disk\Controllers;

use Disk\Db\FolderDb;
use Disk\Db\FileDb;
use Disk\Kernel\Controller;
use Disk\Services\StorageService;
use Disk\Validators\FolderValidator;

class FolderController extends Controller
{
    private $storage;
    private $folder_db;
    private $file_db;
    private $folder_validator;

    public function __construct()
    {
        $this->folder_db = new FolderDb();
        $this->file_db = new FileDb();
        $this->storage = new StorageService();
        $this->folder_validator = new FolderValidator();
    }

    public function mainAction($response = null): void
    {
        session_start();

        $folders = $this->folder_db->getFolder($_SESSION['user_id']);

        echo $this->getTemplate('disk.php', [
            'folders' => $folders,
            'response' => $response
        ]);
    }

    public function detailAction($folder_id, $response = null): void
    {
        session_start();
        $_SESSION['folder_id'] = $folder_id;

        $files = $this->file_db->getFile($folder_id);
        $folder = $this->folder_db->getFolderById($folder_id);

        echo $this->getTemplate('folder.php', [
            'files' => $files,
            'folder' => $folder,
            'response' => $response
        ]);
    }

    public function getFilesTable($folder_id): string
    {
        $files = $this->file_db->getFile($folder_id);
        $folder = $this->folder_db->getFolderById($folder_id);

        return $this->getTemplate('file-table.php', [
            'files' => $files,
            'folder' => $folder
        ]);
    }

    public function addAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->mainAction();
        } else {
            session_start();

            $info = [
                'folder_name' => $_POST['folder'],
                'user_id' => $_SESSION['user_id']
            ];

            $result = $this->folder_validator->validate($info);

            session_write_close();

            if ($result != 'ok') {
                $this->mainAction($result);
            } else {
                $this->folder_db->folderAdd($info['folder_name'], $info['user_id']);
                $folders = $this->folder_db->getFolder($info['user_id']);

                echo $this->getTemplate('disk.php', [
                    'folders' => $folders,
                    'response' => $result
                ]);
            }
        }
    }

    public function deleteAction($folder_id): void
    {
        if ($this->storage->deleteAllFiles($folder_id)) {
            $this->folder_db->deleteFolder($folder_id);
            header('Location: /folder');
        }
    }
}
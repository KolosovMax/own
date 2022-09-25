<?php

namespace Disk\Controllers;

use Disk\Db\AccountDb;
use Disk\Kernel\Controller;
use Disk\Validators\AccountValidator;

class AccountController extends Controller
{
    private $user_db;
    private $accountValidate;

    public function __construct()
    {
        $this->user_db = new AccountDb();
        $this->accountValidate = new AccountValidator();
    }

    public function mainAction($response = null): void
    {
        session_start();

        if (isset($_SESSION['name'])) header('Location: /folder');
        else echo $this->getTemplate('login.php', ['response' => $response]);
    }

    public function registrationAction($response = null): void
    {
        echo $this->getTemplate('registration.php', ['response' => $response]);
    }

    public function addAction(): void
    {
        $email = strtolower($_POST['email']);
        $hash_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $result = $this->accountValidate->validate($email);

        if ($result != 'ok') {
            $this->registrationAction($result);
        } else {
            $result = 'Аккаунт успешно зарегестрирован';
            $this->user_db->accountAdd($hash_pass, $email);
            $this->mainAction($result);
        }
    }

    public function authAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $_POST;

            if ($this->accountValidate->authValidate($post) === false) {
                header('Location: /account');
                return;
            }
            header('Location: /folder');
        } else {
            header('Location: / ');
        }
    }
}
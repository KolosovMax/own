<?php

namespace Disk\Validators;

use Disk\Db\AccountDb;

class AccountValidator
{
    public const FORMAT_ERROR = ' Неверный формат email';
    public const UNIQUE_ERROR = 'Такой Email уже существует';
    public const STATUS_OK = 'ok';

    private $account_db;
    private $status = 'ok';

    public function __construct()
    {
        $this->account_db = new AccountDb();
    }

    public function validate($email): string
    {
        $this->formatValidate($email);
        $this->uniqueValidate($email);

        return $this->status;
    }

    protected function formatValidate($email): void
    {
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) $this->status = self::FORMAT_ERROR;
        else $this->status = self::STATUS_OK;
    }

    protected function uniqueValidate($email): void
    {
        if (!($this->account_db->getByName($email))) $this->status = self::STATUS_OK;
        else $this->status = self::UNIQUE_ERROR;
    }

    public function authValidate($post): bool
    {
        $results = $this->account_db->getAllUsers();

        foreach ($results as $result) {
            if ($result['email'] === strtolower($post['email']) && password_verify($post['password'], $result['password'])) {
                session_start();
                $_SESSION['name'] = $result['email'];
                $_SESSION['user_id'] = $result['id'];

                return true;
            }
        }
        return false;
    }
}
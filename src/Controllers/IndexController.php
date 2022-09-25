<?php

namespace Disk\Controllers;

use Disk\Kernel\Controller;

class IndexController extends Controller
{
    public function mainAction(): void
    {
        echo $this->getTemplate('main.php');
    }
}
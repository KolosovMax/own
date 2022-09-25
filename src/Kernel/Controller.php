<?php

namespace Disk\Kernel;

abstract class Controller
{
    protected function getTemplate($file, array $data = []): string
    {
        extract($data);
        ob_start();
        require_once '../templates/' . $file;
        $page = ob_get_contents();
        ob_clean();

        return $page;
    }
}

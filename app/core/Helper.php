<?php

class Helper
{
    public static function getPageTitle(): string
    {
        $script = $_SERVER['SCRIPT_NAME'];
        $page = ucfirst(basename($script, '.php'));
        return 'Villa Agency - ' . $page;
    }

    public static function log(string $message): void
    {
        $dir = __DIR__ . '/../../storage';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $line = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
        file_put_contents($dir . '/err.log', $line, FILE_APPEND);
    }
}

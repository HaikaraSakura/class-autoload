<?php

declare(strict_types=true);

// オートロード対象のディレクトリ
define('AUTOLOAD_BASE_DIRECTORIES', [
	'App\\' => '/home/public_html/sample/test_project/lib_app/app/'
]);

// オートローダを登録
spl_autoload_register(function (string $classname): bool {
    if (defined('AUTOLOAD_BASE_DIRECTORIES')) {
        foreach (AUTOLOAD_BASE_DIRECTORIES as $namespace => $directory) {
            $classname_after = ltrim($classname, $namespace);
            $filename = $directory . join('/', explode('\\', $classname_after)) . '.php';

            if (file_exists($filename) && is_readable($filename)) {
                require_once $filename;
                return true;
            }
        }
    }
    return false;
});

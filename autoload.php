<?php

declare(strict_types=true);

// オートロード対象のディレクトリ
define('AUTOLOAD_BASE_DIRECTORIES', [
	'App\\' => '/home/public_html/sample/test_project/lib_app/app/'
]);

// オートローダを登録
spl_autoload_register(function (string $class_fullname): bool {
    if (defined('AUTOLOAD_BASE_DIRECTORIES')) {
        foreach (AUTOLOAD_BASE_DIRECTORIES as $namespace => $directory) {
            $before_namespace = ltrim($class_fullname, $namespace);
            $file_name = $directory . join('/', explode('\\', $before_namespace)) . '.php';

            if (file_exists($file_name) && is_readable($file_name)) {
                require_once $file_name;
                return true;
            }
        }
    }
    return false;
});

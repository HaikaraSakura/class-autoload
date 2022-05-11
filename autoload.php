<?php

declare(strict_types=true);

// オートロード対象のディレクトリ
define('AUTOLOAD_BASE_DIRECTORIES', [
	'App\\' => '/home/public_html/sample/test_project/lib_app/app/'
]);

// オートローダを登録
spl_autoload_register(function (string $classname): bool {
    foreach (AUTOLOAD_BASE_DIRECTORIES as $namespace => $directory) {
        // クラスの完全修飾名が、$namespaceと前方一致するか
        if (strpos($classname, $namespace) === 0) {
            $classname_after = ltrim($classname, $namespace);
            $filename = $directory . join('/', explode('\\', $classname_after)) . '.php';

            if (is_file($filename) && is_readable($filename)) {
                require_once $filename;
                return true;
            }
        }
    }
    return false;
});

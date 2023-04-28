<?php

declare(strict_types=1);

// オートロード対象のディレクトリ
define('AUTOLOAD_BASE_DIRECTORIES', [
	'App\\' => '/home/public_html/sample/test_project/lib_app/app/'
]);

// オートローダを登録
spl_autoload_register(function (string $classname): bool {
    foreach (AUTOLOAD_BASE_DIRECTORIES as $namespace => $directory) {
        // クラスの完全修飾名が、$namespaceと前方一致するか
        if (str_starts_with($classname, $namespace)) {
            // クラスの完全修飾名から名前空間を取り除いた文字列を取得
            $classname_after = substr($classname, strlen($namespace));

            // ファイルパス組み立て
            $class_filepath = $directory . join('/', explode('\\', $classname_after)) . '.php';

            if (!file_exists($class_filepath)) {
                return false;
            }

            require_once $class_filepath;
            
            return true;
        }
    }

    return false;
});

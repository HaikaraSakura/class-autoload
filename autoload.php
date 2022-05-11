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
            // クラスの完全修飾名から名前空間を取り除いた文字列を取得
            $classname_after = ltrim($classname, $namespace);

            // ファイルのパスを組み立てて読み込む
            require_once $directory . join('/', explode('\\', $classname_after)) . '.php';
            
            return true;
        }
    }
    return false;
});

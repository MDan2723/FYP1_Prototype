<?php

$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$exp = explode('/', $_SERVER['REQUEST_URI']);
$subDirectory = $exp[0];

$requestUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .'://'. $_SERVER['HTTP_HOST'];
$baseDir = join(
    '/',
    array (
        $documentRoot,
        $subDirectory
    )
);
$baseUrl = join(
    '/',
    array (
        $requestUrl,
        $subDirectory
    )
);
define('BASE_DIR', $baseDir);
define('BASE_URL', $baseUrl);

$_SESSION['BASE_DIR']=BASE_DIR;
$_SESSION['BASE_URL']=BASE_URL;
?>
<?php
function dd($test){
    echo "<pre>";
    var_dump($test);
    echo "</pre>";
    die("YALLA PITHIE");
};

// function loadView(string $view, array $data=[]){
// extract($data);
// require_once(ROOT."views/".$view.".php");
// }

function loadView(string $view,array $datas=[],string $layout="base") {
    ob_start();
    extract($datas);
    require_once(ROOT."views/".$view.".php");
    $content=ob_get_clean();
    require_once ROOT."/views/layout/$layout.layout.php";
}

function path(string $controller, string $action): string{
    return WEBROOT."?controller=$controller&action=$action";
}

function countTable(string $table){
    $sql="SELECT COUNT(*) as total FROM $table";
   return executeSelect($sql,[],true)["total"];
}
<?php
function dd($test){
    echo "<pre>";
    var_dump($test);
    echo "</pre>";
    die("YALLA PITHIE");
};

function loadView(string $view, array $data=[]){
extract($data);
require_once(ROOT."views/".$view.".php");
}

function path(string $controller, string $action): string{
    return WEBROOT."?controller=$controller&action=$action";
}
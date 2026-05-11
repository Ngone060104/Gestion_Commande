<?php
require_once(ROOT."model/clientModel.php");
// echo "test controller";
function clientAction(){
    $clients = findAllClients();
    // echo "<pre>";
    // var_dump($clients);
    // echo "</pre>";
    require_once(ROOT. "views/client/listClient.php");
}

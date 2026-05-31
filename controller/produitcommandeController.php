<?php
require_once(ROOT."model/produitcommandeModel.php");
// echo "test controller";
function produitcommandeAction(){
    $produitcommandes = findAllProduitcommande();
    // echo "<pre>";
    // var_dump($produitcommandes);
    // echo "</pre>";
    // require_once(ROOT. "views/produit_commande/listProduitcommande.php");
    loadView("produit_commande/listProduitcommande",["produitcommandes"=>$produitcommandes]);
}

function indexAction(){
    produitcommandeAction();
}
?>

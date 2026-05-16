SELECT 
    c.nom AS nom_client, 
    c.prenom AS prenom_client, 
    cmd.date_commande, 
    cmd.libelle AS libelle_commande,
    p.libelle AS nom_produit,
    pc.quantite,
    pc.prix_vente
FROM produit_commande pc
JOIN commande cmd ON pc.id_commande = cmd.id_commande
JOIN client c ON cmd.id_client = c.id_client
JOIN produit p ON pc.id_produit = p.id_produit;

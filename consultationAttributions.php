<?php

include("_debut.inc.php");
include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival


$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Echec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}
if (!selectBase($connexion))
{
   ajouterErreur("La base de données festival est inexistante ou non accessible");
   afficherErreurs();
   exit();
}


// CONSULTER LES ATTRIBUTIONS DE TOUS LES ÉTABLISSEMENTS

// IL FAUT QU'IL Y AIT AU MOINS UN ÉTABLISSEMENT OFFRANT DES CHAMBRES POUR  
// AFFICHER LE LIEN VERS LA MODIFICATION
$nbEtab=obtenirNbEtabOffrantChambres($connexion);
if ($nbEtab!=0)
{

   
   // POUR CHAQUE ÉTABLISSEMENT : AFFICHAGE D'UN TABLEAU COMPORTANT 2 LIGNES 
   // D'EN-TÊTE ET LE DÉTAIL DES ATTRIBUTIONS
   $req=obtenirReqEtablissementsAyantChambresAttribuées();
   $rsEtab=mysql_query($req, $connexion);
   $lgEtab=mysql_fetch_array($rsEtab);
   // BOUCLE SUR LES ÉTABLISSEMENTS AYANT DÉJÀ DES CHAMBRES ATTRIBUÉES
   while($lgEtab!=FALSE)
   {
      $idEtab=$lgEtab['id'];
      $nomEtab=$lgEtab['nom'];
   
      echo "
   

      <table border='1' frame='void' rules='all' width='75%' cellspacing='0' cellpadding='0' align='center' 
      class='tabNonQuadrille'>";
     
      $nbOffre=$lgEtab["nombreChambresOffertes"];
      $nbOccup=obtenirNbOccup($connexion, $idEtab);
      // Calcul du nombre de chambres libres dans l'établissement
      $nbChLib = $nbOffre - $nbOccup;
      
      // AFFICHAGE DE LA 1ÈRE LIGNE D'EN-TÊTE 
      echo "
      <tr class='enTeteTabQuad'>
         <td colspan='2' align='left'><strong>$nomEtab</strong>
         (Offre : $nbOffre Disponibilités : $nbChLib)
         </td>
      </tr>";
          
      // AFFICHAGE DE LA 2ÈME LIGNE D'EN-TÊTE 
      echo "
      <tr class='ligneTabQuad'>
         <td width='65%' align='left'><i><strong>Nom groupe</strong></i></td>
         <td width='35%' align='left'><i><strong>Chambres attribuées</strong></i>
         </td>
      </tr>";
        
      // AFFICHAGE DU DÉTAIL DES ATTRIBUTIONS : UNE LIGNE PAR GROUPE AFFECTÉ 
      // DANS L'ÉTABLISSEMENT       
      $req=obtenirReqGroupesEtab($idEtab);
      $rsGroupe=mysql_query($req, $connexion);
      $lgGroupe=mysql_fetch_array($rsGroupe);
               
      // BOUCLE SUR LES GROUPES (CHAQUE GROUPE EST AFFICHÉ EN LIGNE)
      while($lgGroupe!=FALSE)
      {
         $idGroupe=$lgGroupe['id'];
         $nomGroupe=$lgGroupe['nom'];
         echo "
         <tr class='ligneTabQuad'>
            <td width='65%' align='left'>$nomGroupe</td>";
         // On recherche si des chambres ont déjà été attribuées à ce groupe
         // dans l'établissement
         $nbOccupGroupe=obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe);
         echo "
            <td width='35%' align='left'>$nbOccupGroupe</td>
         </tr>";
         $lgGroupe=mysql_fetch_array($rsGroupe);
      } // Fin de la boucle sur les groupes
      
      echo "
      </table><br>";
      $lgEtab=mysql_fetch_array($rsEtab);

   } // Fin de la boucle sur les établissements
}

echo " <a href='modificationAttributions.php?action=demanderModifAttrib' class='btn1 btn-inverse1'>Modifier les attributions</a><br><br><br>";


?>


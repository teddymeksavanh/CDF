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

// CRÉER UN ÉTABLISSEMENT 

// Déclaration du tableau des civilités
$tabCivilite=array("M.","Mme","Melle");  

$action=$_REQUEST['action'];

// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action=='demanderCreEtab') 
{  
   $id='';
   $nom='';
   $adresseRue='';
   $ville='';
   $codePostal='';
   $tel='';
   $adresseElectronique='';
   $type=0;
   $civiliteResponsable='Monsieur';
   $nomResponsable='';
   $prenomResponsable='';
   $nombreChambresOffertes='';
   $Informations_pratiques='';
   $ConventionSignee=0;
}
else
{
   $id=$_REQUEST['id']; 
   $nom=$_REQUEST['nom']; 
   $adresseRue=$_REQUEST['adresseRue'];
   $codePostal=$_REQUEST['codePostal'];
   $ville=$_REQUEST['ville'];
   $tel=$_REQUEST['tel'];
   $adresseElectronique=$_REQUEST['adresseElectronique'];
   $type=$_REQUEST['type'];
   $civiliteResponsable=$_REQUEST['civiliteResponsable'];
   $nomResponsable=$_REQUEST['nomResponsable'];
   $prenomResponsable=$_REQUEST['prenomResponsable'];
   $nombreChambresOffertes=$_REQUEST['nombreChambresOffertes'];
   $Informations_pratiques=$_REQUEST['Informations_pratiques'];
   $ConventionSignee=$_REQUEST['ConventionSignee'];
   
   verifierDonneesEtabC($connexion, $id, $nom, $adresseRue, $codePostal, $ville, 
                        $tel, $nomResponsable, $nombreChambresOffertes,$Informations_pratiques, $ConventionSignee);      
   if (nbErreurs()==0)
   {        
      creerEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, $ville,  
                         $tel, $adresseElectronique, $type, $civiliteResponsable, 
                         $nomResponsable, $prenomResponsable, $nombreChambresOffertes,$Informations_pratiques, $ConventionSignee);
   }
}


echo "
<SCRIPT language='javascript' src='bootstrap/js/ppe.js'></SCRIPT>

<form method='post' id='form' action='creationEtablissement.php?' onsubmit='return vFormulaire(this)'>
   <input type='hidden' value='validerCreEtab' name='action'>


   <table border='1' frame='void' rules= 'all' width='80%' align='center' cellspacing='0' cellpadding='0' 
   class='tabNonQuadrille'>
   
<tr class='enTeteTabNonQuad'>
      <td colspan='4' align='center'><b><h4>Ajout d'un nouvel établissement</h4></b></td>
   </tr>
      <tr class='ligneTabNonQuad'>
         <td> Id*: </td>
         <td><input type='text' value='$id' name='id' size ='10' onblur='vid(this)'
         maxlength='8'></td>
      </tr>";

      echo '
      <tr class="ligneTabNonQuad">
         <td> Nom*: </td>
         <td><input type="text" value="'.$nom.'" name="nom" size="50" 
         maxlength="45" onblur="vnom(this)"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Adresse*: </td>
         <td><input type="text" value="'.$adresseRue.'" name="adresseRue" 
         size="50" maxlength="45" onblur="vadresseRue(this)"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Code postal*: </td>


         <td><input type="text" value="'.$codePostal.'" name="codePostal" 
         size="4" maxlength="5" onblur="vcodePostal(this)" onkeypress="return isNumberKey(event)"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Ville*: </td>
         <td><input type="text" value="'.$ville.'" name="ville" size="40" 
         maxlength="35" onblur="vville(this)"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Téléphone*: </td>
         <td><input type="text" value="'.$tel.'" name="tel" size ="20" 
         maxlength="10" onblur="vtel(this)" onkeypress="return isNumberKey(event)"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> E-mail: </td>
         <td><input type="text" value="'.$adresseElectronique.'" name=
         "adresseElectronique" size ="75" maxlength="70"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Type*: </td>
         <td>';
            if ($type==1)
            {
               echo " 
               <input type='radio' name='type' value='1' checked>  
               Etablissement Scolaire
               <input type='radio' name='type' value='0'>  Autre";
             }
             else
             {
                echo " 
                <input type='radio' name='type' value='1'> 
                Etablissement Scolaire
                <input type='radio' name='type' value='0' checked> Autre";
              }
           echo "
           </td>
         </tr>
         <tr class='ligneTabNonQuad'>
            <td colspan='2' ><strong>Responsable:</strong></td>
         </tr>
         <tr class='ligneTabNonQuad'>
            <td> Civilité*: </td>
            <td> <select name='civiliteResponsable'>";
               for ($i=0; $i<3; $i=$i+1)
                  if ($tabCivilite[$i]==$civiliteResponsable) 
                  {
                     echo "<option selected>$tabCivilite[$i]</option>";
                  }
                  else
                  {
                     echo "<option>$tabCivilite[$i]</option>";
                  }
               echo '
               </select> Nom*: 
               <input type="text" value="'.$nomResponsable.'" name=
               "nomResponsable" size="26" maxlength="25" onblur="vnomResponsable(this)">
               Prénom: 
               <input type="text"  value="'.$prenomResponsable.'" name=
               "prenomResponsable" size="26" maxlength="25">
            </td>
         </tr>
          <tr class="ligneTabNonQuad">
            <td> Nombre chambres offertes*: </td>
            <td><input type="text" value="'.$nombreChambresOffertes.'" name=
            "nombreChambresOffertes" size ="2" maxlength="3" onkeypress="return isNumberKey(event)" onblur="vnombreChambresOffertes(this)"></td>
         </tr>
		 <tr class="ligneTabNonQuad">
            <td> Information Pratiques: </td>
            <td><input type="text" value="'.$Informations_pratiques.'" name=
            "Informations_pratiques" size ="100" maxlength="254"></td>
         </tr>
         <tr class="ligneTabNonQuad">
         <td> Convention signée*: </td>
         <td> <INPUT type="checkbox" name="ConventionSignee" value="1"class="checkbox_type_value" onclick="vcheckbox(this)"> Cliquez pour signer la convention
         <td> *champs obligatoires </td>';
/*
            if ($ConventionSignee==1)
            {
               echo " 
               <input type='radio' name='ConventionSignee' value='1' checked>  
               La convention est signée
               <input type='radio' name='ConventionSignee' value='0'>  La convention n'est pas signée";
             }
             else
             {
                echo " 
                <input type='radio' name='ConventionSignee' value='1'> 
                La convention est signée
                <input type='radio' name='ConventionSignee' value='0' checked> La convention n'est pas signée";
              }
              */
           echo "
           </td>
         </tr>
   </table>";
   
   
   echo "
<br>

      <tr>
         <td align='center'><input type='submit' class='btn2 btn-inverse2' value='Valider' name='valider' onclick='ValidateForm()'>
         
      </tr>

      <tr>
         <a class='btn btn-inverse' href='listeEtablissements.php' >Retour</a>
         </td>
      </tr>
    
</form><br><br><br>";

// En cas de validation du formulaire : affichage des erreurs ou du message de 
// confirmation
if ($action=='validerCreEtab')
{
   if (nbErreurs()!=0)
   {
      afficherErreurs();
   }
   else
   {
      echo "
      <h5><center>La création de l'établissement a été effectuée</center></h5>";
   }
}

?>

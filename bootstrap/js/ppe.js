function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

function color(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#FF6A6A";
   else
      champ.style.backgroundColor = "#5EFF50";
}

function vnom(champ)
{
   if(champ.value.length < 2 || champ.value.length > 50)
   {
      color(champ, true);
      return false;
   }
   else
   {
      color(champ, false);
      return true;
   }
}



function vadresseRue(champ)
{
   if(champ.value.length < 5 || champ.value.length > 50)
   {
      color(champ, true);
      return false;
   }
   else
   {
      color(champ, false);
      return true;
   }
}

function vcodePostal(champ)
{
   if(champ.value.length < 5 || champ.value.length > 5)
   {
      color(champ, true);
      return false;
   }
   else
   {
      color(champ, false);
      return true;
   }
}

function vville(champ)
{
   if(champ.value.length < 2 || champ.value.length > 40)
   {
      color(champ, true);
      return false;
   }
   else
   {
      color(champ, false);
      return true;
   }
}

function vtel(champ)
{
   if(champ.value.length < 10 || champ.value.length > 20)
   {
      color(champ, true);
      return false;
   }
   else
   {
      color(champ, false);
      return true;
   }
}

function vnomResponsable(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      color(champ, true);
      return false;
   }
   else
   {
      color(champ, false);
      return true;
   }
}

function vnombreChambresOffertes(champ)
{
   if(champ.value.length < 1 || champ.value.length > 3)
   {
      color(champ, true);
      return false;
   }
   else
   {
      color(champ, false);
      return true;
   }
}

function vid(champ)
{
   if(champ.value.length < 8 || champ.value.length > 8)
   {
      color(champ, true);
      return false;
   }
   else
   {
      color(champ, false);
      return true;
   }
}


function vFormulaire(f)
{
   var idOk = vid(f.id);
   var nomOk = vnom(f.nom);
   var adresseRueOk = vadresseRue(f.adresseRue);
   var codePostalOk = vcodePostal(f.codePostal);
   var villeOk = vville(f.ville);
   var telOk = vtel(f.tel);
   var nomResponsableOk = vnomResponsable(f.nomResponsable);
   var nombreChambresOffertesOk = vnombreChambresOffertes(f.nombreChambresOffertes); 


   if(idOk && nomOk && adresseRueOk && codePostalOk && villeOk && telOk && nomResponsableOk && nombreChambresOffertesOk)
   {
      alert("La création de l'établissement a été éffectué");
      return true;
   }  
   else
   {
      alert("Veuillez correctement remplir le formulaire (les champs en rouge)");
      return false;
   }
}

function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

$(document).ready(function() {
    
});
//Fonction quand on appuie sur le boutton envoyer
function ValidateForm(){    
        //Si la checkbox est checked :
        if($('#checkbox_type_value').is(':checked')==true){
            //On envoie une requête submit :
            $('#form').submit();
            alert("Lol");
            return true;
        }else{
            //Sinon on affiche une alerte :
            alert("Veuillez respecter les conditions de validation du formulaire.");

            return false;
        }
        return false;
    };

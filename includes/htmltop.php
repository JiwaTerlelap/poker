<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title><?php print $titlepage; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The styles -->
    <link id="bs-css" href="../css/bootstrap-slate.min.css" rel="stylesheet">

    <link href="../css/charisma-app.css" rel="stylesheet">
    

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

<script>

window.onload = function() {
    var deletebutton = document.getElementsByClassName('deletebutton');
	for(var i = 0; i < deletebutton.length; i++) {
		var anchor = deletebutton[i];
    
		anchor.onclick = function() {
      var info = this.getAttribute("info"); 
			if(!confirm('Are Sure Delete '+info+' ?')) {return false; }
		}
   }
   

    var formsubmit = document.getElementsByTagName("form");
    for(var i = 0; i < formsubmit.length; i++)
    {
       var anchor = formsubmit[i];
       anchor.onsubmit = function()
       {
           var wajibinput= this.getElementsByClassName('wajibinput');
           for(var i = 0; i < wajibinput.length; i++)
           {
              if (wajibinput[i].value == "" || wajibinput[i].value == " ")
              {
              	wajibinput[i].focus();
              	return false;
	          }
              else
              {
                 
              }
           }
        }
    }
}


</script>

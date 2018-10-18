<div class="container">
 	<p align="right" style="font-size: 12px; border-bottom: 1px solid #FF0; font-style: italic; padding-bottom: 9px;">Copyright © 2012 WinLiga.com | All right reserved.</p>
 	<img src="<?php echo $domainname; ?>images/footer-banner.png" alt="Support WinLiga" />
 	<img style="float: right;" src="<?php echo $domainname; ?>images/bank-list.png" alt="Bank List WinLiga" />
</div>

<?php 
if (file_exists($documentroot."images/slider/".$imagepopup) && $imagepopup != "")
{
?>
<div class="popup-wrapper" id="promo-popup">
  <div class="popup-content">
      <div class="promo-wrap">
        <img src="<?php echo $domainname; ?>images/slider/<?php echo $imagepopup; ?>" />
      </div>
    </div>
</div>
<?php
}

?>
<script type="text/javascript">

   var mouse_is_inside = false;
    
    $('.popup-content').hover(function(){ 
        mouse_is_inside=true; 
    }, function(){ 
        mouse_is_inside=false; 
    });

    $("body").mouseup(function(){ 
        if(!mouse_is_inside) $(".popup-wrapper").slideUp(200);
    });

    $("#login-button").click(function(){ 
        $("#login-popup").slideDown(200);
    });
$("#promo-popup").show(200);
  </script>

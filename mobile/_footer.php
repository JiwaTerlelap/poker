<div class="footer">
	<div class="footer-games"><img src="<?php echo $domainname; ?>mobile/images/footer-games.png" alt="Our Games List BandarBola855" /></div>
	<div class="footer-bank"><img class="bank-list" src="<?php echo $domainname; ?>mobile/images/footer-bank.png" alt="Bank List BandarBola855" /></div>
	<?php
	if (isset($home))
	{
	?>
	<div class="deskripsi">
	  <?php 
	    $qr0 = mysqli_query(fOpenConn(), "SELECT cnt_isi FROM mscontent WHERE cnt_id = 'About Us' LIMIT 1");
	    $rs0 = mysqli_fetch_object($qr0);
	    echo $rs0->cnt_isi;
	  ?>
	</div>
	<?php
	}
	?>
	<img style="display: block; margin: auto;" class="footer-banner" src="<?php echo $domainname; ?>mobile/images/footer-banner.png" alt="BandarBola855" />
 	<p align="center" style="font-size: 10px;0font-style: italic; padding: 4px 0px; margin: 0px;">Copyright © 2012 BandarBola855.com | All right reserved.</p>
</div>

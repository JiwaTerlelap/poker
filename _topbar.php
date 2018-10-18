<!--Header-->
<div id="header">
  <div class="header-top">
    <div class="container">
      <div class="runningtext_content"><marquee behavior="scroll"><?php echo strtoupper($runningtext); ?></marquee></div>
    </div>
  </div>
  <div class="header-contact">
    <div class="container">
      <table class="table-contact-left">
        <tr>
          <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-line.png" width="35" height="35" alt="Line Agen Sbobet" /></td>
          <td class="contact-jenis">LINE</td>
          <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-phone.png" width="35" height="35" alt="Telepon Agen Sbobet" /></td>
          <td class="contact-jenis">Phone</td>
          <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-livechat.png" width="70" height="35" alt="Livechat Agen Sbobet" /></td>
        </tr>
        <tr>
          <td class="contact-value"><?php echo $line; ?></td>
          <td class="contact-value"><?php echo $yahoo; ?></td>
        </tr>
      </table>

      <table class="table-contact-left" style="float: right; margin-right: 30px;">
        <tr>
          <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-bbm.png" width="35" height="35" alt="BBM Agen Sbobet" /></td>
          <td class="contact-jenis">BBM</td>
          <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-wa.png" width="35" height="35" alt="WhatsApp Agen Sbobet" /></td>
          <td class="contact-jenis">WhatsApp</td>
        </tr>
        <tr>
          <td class="contact-value"><?php echo $bbm; ?></td>
          <td class="contact-value"><?php echo $whatsapp; ?></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="menu-wrap">
    <ul class="nav">
        <li><a href="<?php echo $domainname; ?>">Home</a></li>
        <li><a href="<?php echo $domainname; ?>sportsbook">Sportsbook</a></li>
        <li><a href="<?php echo $domainname; ?>casino">Casino</a></li>
        <li><a href="#">Games</a>
          <ul>
            <?php
            $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msgames WHERE gm_active = 'a' ORDER BY gm_nama");
            while ($rs0 = mysqli_fetch_object($qr0))
            {
                echo "<li><a href='".$domainname."games/$rs0->gm_nama'>$rs0->gm_nama</a></li>";
            }
            ?>
          </ul>
        </li>
        <li  class="logo"><a href="<?php echo $domainname; ?>"><img src="<?php echo $domainname; ?>images/logo.png" alt="Bandar Bola,Agen Sbobet" /></a></li>
        <li><a href="<?php echo $domainname; ?>promo">Promo</a></li>
        <li><a href="<?php echo $domainname; ?>info-bola">Berita</a></li>
        <li><a href="<?php echo $domainname; ?>livescore">Livescore</a></li>
        <li><a href="<?php echo $domainname; ?>daftar"><img style="margin-top: -15px;" src="<?php echo $domainname; ?>images/daftar.png" alt="Daftar Agen Sbobet" /></a></li>
      </ul>
  </div>
</div>
<!--Header-->
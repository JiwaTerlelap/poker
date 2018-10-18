<?php
require_once '_htmltop.php';
?>
</head>

<body>
<!-- topbar starts -->
<?php
require_once '_topbar.php';
?>
<!--Konten-->
<div class="content">
  <h2>Kontak Kami</h2>
	<table class="table-contact-left">
    <tr>
      <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-line.png" alt="Line BandarBola855" /></td>
      <td class="contact-jenis">LINE</td>
    </tr>
    <tr>
      <td class="contact-value"><?php echo $line; ?></td>
    </tr>
    <tr>
      <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-phone.png" alt="Phone BandarBola855" /></td>
      <td class="contact-jenis">Phone</td>
    </tr>
    <tr>
      <td class="contact-value"><?php echo $yahoo; ?></td>
    </tr>
    <tr>
          <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-bbm.png" alt="BBM BandarBola855" /></td>
          <td class="contact-jenis">BBM</td>
        </tr>
        <tr>
          <td class="contact-value"><?php echo $bbm; ?></td>
        </tr>
        <tr>
          <td rowspan="2"><img src="<?php echo $domainname; ?>images/icon-wa.png" alt="WhatsApp BandarBola855" /></td>
          <td class="contact-jenis">WhatsApp</td>
        </tr>
        <tr>
          <td class="contact-value"><?php echo $whatsapp; ?></td>
        </tr>
  </table>
</div>
<?php
require_once '_footer.php';
?>
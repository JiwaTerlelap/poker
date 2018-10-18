<?php
$qr1 = mysqli_query(fOpenConn(), "SELECT * FROM mssetting");
$rs1 = mysqli_fetch_object($qr1);
$namaweb = $rs1->set_namaweb;
$sitetitle = $rs1->set_sitetitle;
$sitedeskripsi = $rs1->set_deskripsi;
$sitekeyword = $rs1->set_keyword;
$runningtext = $rs1->set_runningtext;
$livechat = $rs1->set_livechat;
$bbm = $rs1->set_bbm;
$yahoo = $rs1->set_yahoo;
$line = $rs1->set_line;
$whatsapp = $rs1->set_whatsapp;
$instagram = $rs1->set_instagram;
$facebook = $rs1->set_facebook;

$titlepage = $namaweb." | ".$sitetitle;
if (isset($title))
  $titlepage = $title." | ".$titlepage;

if (isset($deskripsi))
  $sitedeskripsi = $deskripsi;

if (isset($keywords))
  $sitekeyword = $keywords;

$domainname = "HTTP://".$_SERVER["SERVER_NAME"]."/";

$documentroot = $_SERVER['DOCUMENT_ROOT']."/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php print $titlepage; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="<?php echo $sitekeyword; ?>" />
  <meta name="description" content="<?php echo $sitedeskripsi; ?>" />
  <meta name="format-detection" content="telephone=no">
  <link href="<?php echo $domainname; ?>images/favicon.png" type="image/x-icon" rel="shortcut icon">
  <link rel="stylesheet" href="<?php echo $domainname; ?>mobile/css/style.css">
  <script type="text/javascript" src="<?php echo $domainname; ?>mobile/js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="<?php echo $domainname; ?>mobile/js/nav-function.js"></script>
  <?php echo $livechat; ?>

  <script>

  window.onload = function() {
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


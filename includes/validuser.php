<?php 
require_once '../includes/headpage.php';
session_start();
if (!isset($_SESSION['primaryiduser_bandar855']) || !isset($_SESSION['useriduser_bandar855']) || !isset($_SESSION['passworduser_bandar855']) || !isset($_SESSION['namauser_bandar855']))
{
	header("location:login.php");
}
else
{
	$fix_primaryid = $_SESSION['primaryiduser_bandar855'];
	$fix_user = $_SESSION['useriduser_bandar855'];
	$fix_userpw = $_SESSION['passworduser_bandar855'];
	$fix_username = $_SESSION['namauser_bandar855'];
}

$fix_userjabatan = "Operator";
$qr0 = mysqli_query(fOpenConn(), "SELECT userjabatan FROM msuser WHERE userid = '$fix_primaryid' AND usernama = '$fix_user' AND userpassword = '$fix_userpw' AND usernickname = '$fix_username' AND useractive = 'a'");
if (mysqli_num_rows($qr0) > 0) {
	$rs0 = mysqli_fetch_object($qr0);
	$fix_userjabatan = $rs0->userjabatan;
}

$pengecekan_ulang_user = mysqli_query(fOpenConn(), "SELECT usernama FROM msuser WHERE userid = '$fix_primaryid' AND usernama = '$fix_user' AND userpassword = '$fix_userpw' AND usernickname = '$fix_username' AND useractive = 'a'");

if (mysqli_num_rows($pengecekan_ulang_user) == 0) {
	header("location:login.php");
	exit();	
}

if (isset($modulid) && $modulid != "home")
{
	$qr0 = mysqli_query(fOpenConn(), "SELECT hak_modul from mshak WHERE hak_modul = '$modulid' AND hak_user = '$fix_primaryid' AND hak_akses = '1'");
	if (mysqli_num_rows($qr0) == 0) {
		header("location:index.php");
		exit();	
	}
}
<?php
require_once '../includes/headpage.php';
$url   = $_SERVER["REQUEST_URI"];
$pecah = explode('/',$url);
$page  = $pecah[2];
switch($page) {
	case 'promo':
		include 'm_promo.php';
		break;

	case 'kontak-kami':
		include 'm_kontakkami.php';
		break;
		
	case 'livescore':
		include 'm_livescore.php';
		break;

	case 'daftar':
		include 'm_daftar.php';
		break;

	case 'sportsbook':
		include 'm_sportsbook.php';
		break;

	case 'casino':
		include 'm_casino.php';
		break;

	case 'peraturan':
		include 'm_peraturan.php';
		break;

	case 'games':
		$gamesid = "";
		if (isset($pecah[3]))
		{
			$gamesid = urldecode(antiinjectionmain($pecah[3]));
			$qr0 = mysqli_query(fOpenConn(), "SELECT gm_id FROM msgames WHERE gm_nama = '$gamesid' AND gm_active = 'a' LIMIT 1");
		    if (mysqli_num_rows($qr0) > 0)
			    include 'm_games.php';
			else
				include 'm_games.php';
		}
		else
			include 'm_games.php';
		break;
	

	default:
		require_once "m_home.php";
		break;
}
?>

<?php
if (!isset($modulid)) $modulid = "";
?>
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main Menu</li>
                        <li <?php if ($modulid == "home") echo 'class="active"'; ?>><a class="ajax-link" href="index.php"><i class="glyphicon glyphicon-home"></i><span> &nbsp;Home</span></a></li>
                        <?php
                        $qr0 = mysqli_query(fOpenConn(), "SELECT * FROM msmodul, mshak WHERE hak_modul = mdl_id AND hak_user = '$fix_primaryid' AND hak_akses = '1' ORDER BY mdl_urut");
                        while ($rs0 = mysqli_fetch_object($qr0))
                        {
                            if ($modulid == $rs0->mdl_id) echo '<li class="active">'; else echo '<li>';
                            echo '<a class="ajax-link" href="'.$rs0->mdl_file.'"><i class="glyphicon glyphicon-'.$rs0->mdl_icon.'"></i><span> &nbsp;'.$rs0->mdl_name.'</span></a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have JavaScriptenabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">BandarBola855</a>
        </li>
        <?php
        $breadcrumb = explode(" | ", $titlepage);
        for ($x = 0 ; $x < sizeof($breadcrumb) ; $x++)
            echo "<li><a href='#'>$breadcrumb[$x]</a>";
        ?>
        </li>
    </ul>
</div>
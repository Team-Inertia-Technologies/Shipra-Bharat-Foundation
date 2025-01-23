<?php
$q = "SELECT vName, dFtom FROM camp";
$r = sql_query($q);
$o = sql_fetch_object($r);
$name = db_output($o->vName);
$date = db_output($o->dFtom);
$formatted_date = date('jS F Y', strtotime($date));
?>


<div class="appHeader bg-primary text-light wide-block">
    <div class="">
        <div class="text1"><?php echo $name; ?></div>
        <div class="text2"><?php echo $formatted_date; ?></div>
    </div>
    <div class="">
        <a href="index.php"><img src="assets/img/logout.png" alt="" class=""></a>
        <a href="report.php"><img src="assets/img/report.png" alt="" class=""></a>
    </div>
</div>
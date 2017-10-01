<?php include('./skeleton/top.php'); ?>

<div class="PreLoader">
    <div class="hidden"><img src="media/bg.jpg"><img src="media/exit.png"><img src="media/exit_red.png"></div>
</div>
<?php include('./admin/login.php'); ?>
<div class="Header">
    <div class="Title">
        <img src="media/logo.png">
        <?php
        if (isset($_SESSION['status'])) {
            if ($_SESSION['status'] == 'active') {
                $visitor_type = 'Administration';
            }
        } else {
            $visitor_type = 'Selection';
        }
        echo "<h1>".date("Y", strtotime('+1 year'))." Options $visitor_type</h1>";
        ?>
    </div>

    <div class="LoginButtonContainer">
        <?php if (!isset($_SESSION['user'])) { ?>
        <a class="LoginButton" href="#login-modal" data-modal-open>STAFF LOGIN</a>
        <?php } else { ?>
        <a class="LogoutButton">Hello, <?php echo $_SESSION['user']; ?></a><a class="LogoutLink" href="./scripts/logout.php">&nbsp;</a>
        <?php } ?>
    </div>
</div>
<?php include('./skeleton/navigation.php');
if (isset($_SESSION['user']) && isset($_SESSION['status'])) {
    if ($_SESSION['status'] == 'active' && isset($_REQUEST['admin'])) {
        include('./canvas_admin.php');
    } else {
        include('./canvas.php');
    }
} else {
    include('./canvas.php');
}
?>
<?php include('./skeleton/bottom.php'); ?>
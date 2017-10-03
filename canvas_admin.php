<?php include('./admin/login.php'); ?>
<div class="header">
    <div class="logo"><a href="index.php?page=welcome"><img src="media/logo.png" /></a></div>

	<?php echo "<h1 class=\"title\">".date("Y", strtotime('+1 year'))." Options Administration</h1>"; ?>

    <div class="LoginButtonContainer">
    	<div class="accounts-button-wrapper">
			<a class="LogoutButton">Hello, <?php echo $_SESSION['user']; ?></a><a class="LogoutLink" href="./scripts/logout.php">&nbsp;</a>
		</div>
    </div>
</div>

<?php include('./skeleton/navigation_admin.php');?>

<div class="Canvas">
    <?php
    if (!isset($_SESSION['user']) || !isset($_SESSION['status'])) {
        header("LOCATION: index.php");
    }
    if (!isset($_REQUEST['admin'])) {
        include('./admin/welcome.php');
    } else {
        $page = preg_replace('/[0-9a-zA-Z]-/','',$_REQUEST['admin']);
        include('./admin/'.$page.'.php');
    }
    ?>
</div>

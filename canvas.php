<?php include('./admin/login.php'); ?>
<div class="header">
    <div class="logo"><a href="index.php?page=welcome"><img src="media/logo.png" /></a></div>

	<?php echo "<h1 class=\"title\">".date("Y", strtotime('+1 year'))." Options Selection</h1>"; ?>

    <div class="LoginButtonContainer">
        <?php if (!isset($_SESSION['user'])) { ?>
		<div class="accounts-button-wrapper">
        	<a class="LoginButton" href="#login-modal" data-modal-open>LOG IN&nbsp;</a>
		</div>
        <?php } else { ?>
		<div class="accounts-button-wrapper">
        	<a class="LogoutButton">Hello, <?php echo $_SESSION['user']; ?></a><a class="LogoutLink" href="./scripts/logout.php">&nbsp;</a>
		</div>
        <?php } ?>
    </div>
</div>
<?php include('./skeleton/navigation.php');?>

<div class="Canvas">
    <?php
	if (isset($_REQUEST['admin'])) {
		echo '<script>window.location.href = "./index.php"</script>';
		echo '<meta http-equiv="refresh" content="index.php">';
	}
    if (!isset($_REQUEST['page'])) {
        include('./easel/welcome.php');
    } else {
        $page = preg_replace('/[0-9a-zA-Z]-/','',$_REQUEST['page']);
        include('./easel/'.$page.'.php');
    }
    ?>
</div>

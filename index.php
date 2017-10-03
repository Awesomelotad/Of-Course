<?php include('./skeleton/top.php'); ?>

<div class="preloader">
    <div class="hidden" /><img src="media/bg.jpg" /><img src="media/exit.png" /><img src="media/exit_red.png" /></div>
</div>

<?php
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

<div class="Canvas">
    <?php
    if (!isset($_SESSION['user']) && !isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'active') {
            echo "<script>window.history.back();</script>";
        }
    }
    if (!isset($_REQUEST['admin'])) {
        include('./admin/welcome.php');
    } else {
        $page = preg_replace('/[0-9a-zA-Z]-/','',$_REQUEST['admin']);
        include('./admin/'.$page.'.php');
    }
    ?>
</div>
<div class="Canvas">
    <?php
    if (!isset($_REQUEST['page'])) {
        include('./easel/welcome.php');
    } else {
        $page = preg_replace('/[0-9a-zA-Z]-/','',$_REQUEST['page']);
        include('./easel/'.$page.'.php');
    }
    ?>
</div>
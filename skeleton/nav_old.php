<div class="navigation">
    <?php if (!isset($_REQUEST['admin']) || !isset($_SESSION['status'])) { ?>
    <a href="index.php?page=welcome">WELCOME</a>
    <div class="DropContainer">
        <button class='DropButton'>USEFUL INFO</button>
        <div class="DropDown">
            <a href="index.php?page=calendar">IMPORTANT DATES</a>
            <a href="index.php?page=careers">CAREERS INFO</a>
            <a href="index.php?page=entrance">UNIVERSITY ENTRANCE</a>
            <a href="./media/ncea.pdf" target="_blank">NCEA INFO</a>
            <a href="index.php?page=types">COURSE TYPES</a>
        </div>
    </div>
    <div class="DropContainer">
        <button class="DropButton">JUNIORS</button>
        <div class="DropDown">
            <a href="index.php?page=courses&year=9">YEAR 9</a>
            <a href="index.php?page=courses&year=10">YEAR 10</a>
        </div>
    </div>
    <div class="DropContainer">
        <button class="DropButton">SENIORS</button>
        <div class="DropDown">
            <a href="index.php?page=courses&year=11">LEVEL 1</a>
            <a href="index.php?page=courses&year=12">LEVEL 2</a>
            <a href="index.php?page=courses&year=13">LEVEL 3</a>
        </div>
    </div>
    <a href="index.php?page=selection">SELECTION PROCESS</a>
    <a href="index.php?page=contact">CONTACT</a>
    <?php } else { ?>
    <div id="account-delete-modal" style="display: none;">
        <?php if($_REQUEST['admin'] != 'accounts/edit_account' && $_REQUEST['admin'] != 'accounts/add_account') ?>
        <h2 style="margin:30px;text-align:center;color:black;display:block!important;">Enter <?php if ($_SESSION['elevation'] != 3) {$admin_delete=false;echo 'your';} else {$admin_delete=true;echo 'teachers';} ?> password to confirm:<br/><br/>(Note: This <b>CAN NOT</b> be undone)</h2>
        <form class="ModalForm" method="post" enctype="multipart/form-data">
            <ul>
                <li class="FormField">
                    <label for="password_confirm">Password</label>
                    <input id="ConfirmPassword" type="password" maxlength="255" name="password_confirm" placeholder="Type password here">
                </li>
                <li class="FormSubmit Red">
                    <button id="RemoveConfirm" onclick="RemoveTeacher(<?php echo $_SESSION['userid']; ?>, <?php echo json_encode($admin_delete); ?>, event);">Remove account</button>
                </li>
                <h4 id="acc_delete_form" class="FormError"></h4>
            </ul>
        </form>
    </div>
	<?php if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == 'active') {
    if ($_SESSION['elevation'] == 2) {
        $priv_upper = 1;
        $priv_middle = 0;
        $priv_lower = 0;
    } elseif ($_SESSION['elevation'] == 3) {
        $priv_upper = 2;
        $priv_middle = 1;
        $priv_lower = 0;
    } else {
        $priv_upper = 0;
        $priv_middle = 0;
        $priv_lower = 0;
    }
    $requests_sql = "SELECT COUNT(10) FROM teachers WHERE status=0 AND (elevation=$priv_lower OR elevation=$priv_middle OR elevation=$priv_upper)";
    $requests_query = mysqli_query($dbconnect, $requests_sql);
    $requests_result = mysqli_fetch_array($requests_query)[0];
    ?>
    <a href="index.php?admin=home">HOME</a>
    <?php if($_SESSION['elevation'] >=2) { ?>
    <a href="index.php?admin=requests">USER REQUESTS<?php if ($_SERVER["REQUEST_URI"] != '/OfCourse(Alpha_0)/index.php?admin=requests') {echo '<span>'.$requests_result.'</span>';} ?></a>
    <?php } ?>
    <?php if ($_SESSION['elevation'] >= 0) { ?>
    <a href="index.php?admin=calendar">CALENDAR</a>
    <?php } ?>
    <?php if($_SESSION['elevation'] >= 0) { ?>
    <div class="DropContainer">
        <button class="DropButton">ACCOUNTS</button>
        <div class="DropDown">
            <?php if ($_SESSION['elevation'] == 3) { ?>
            <a href="index.php?admin=accounts/add_account">ADD ACCOUNT</a>
            <?php } ?>
            <a href="index.php?admin=accounts/edit_account">EDIT ACCOUNT</a>
            <a <?php if ($_SESSION['elevation'] == 3) {echo "href='index.php?admin=accounts/remove_account'";} else {echo "onclick=\"modal.open('#account-delete-modal');\"";} ?>>REMOVE ACCOUNT</a>
        </div>
    </div>
    <?php } ?>
	<?php }}} if (isset($_SESSION['user']) && isset($_SESSION['status']) && !isset($_REQUEST['admin'])) { ?>
    <a href="index.php?admin=home">ADMIN</a>
    <?php } ?>
</div>
<div class="navigation-compressed">
	<a href="#/" class="summon-navigation">Open Menu &#9776;</a>
</div>

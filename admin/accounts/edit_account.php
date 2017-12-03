<div id="department-modal" style="display: none;">
    <h2 id="department-modal-header" style="text-align:center;color:black;"></h2>
    <form class="modal-form">
        <ul>
            <li class="form-submit">
                <button id="DepartmentSubmit">Add department</button>
            </li>
        </ul>
    </form>
</div>

<div id="account-delete-modal" style="display: none;">
	<?php if($_REQUEST['admin'] != 'accounts/edit_account' && $_REQUEST['admin'] != 'accounts/add_account') ?>
	<h2 style="margin:30px;text-align:center;color:black;display:block!important;">Enter <?php if ($_SESSION['elevation'] != 3) {$admin_delete=false;echo 'your';} else {$admin_delete=true;echo 'teachers';} ?> password to confirm:<br/><br/>(Note: This <b>CAN NOT</b> be undone)</h2>
	<form class="modal-form" method="post" enctype="multipart/form-data">
		<ul>
			<li class="form-field">
				<label for="password_confirm">Password</label>
				<input id="ConfirmPassword" type="password" maxlength="255" name="password_confirm" placeholder="Type password here">
			</li>
			<li class="form-submit Blue">
				<button id="RemoveConfirm" onclick="RemoveTeacher(<?php echo $_SESSION['userid']; ?>, event);">Remove account</button>
			</li>
			<h4 id="acc_delete_form" class="form-error"></h4>
		</ul>
	</form>
</div>

<div class="Accounts Container">
    <h1 class="Important">- Edit an account -</h1>
    <?php
    if ($_SESSION['elevation'] != 3) {
        $category_header = 'Edit my account.';
    } else {
        $category_header = 'Complete control over account registration.';
    }
    ?>
    <div class="Important"><?php echo $category_header; ?></div>
    <div class="Content">
        <h2 style="text-align:center;">All fields except 'Password' &amp; 'Confirm password' are <u><i>required</i></u>.</h2>
        <form id="TeacherForm" class="static-form" enctype="multipart/form-data" autocomplete="off" onkeypress="return event.keyCode != 13;">
            <ul class="FormContainer">
                <li class="form-field Split" style="<?php if ($_SESSION['elevation'] != 3) {echo 'display: none;';} ?>">
                    <label for="teacher">Teacher to edit</label>
                    <input type="text" id="TeacherIdentity" name="teacher" maxlength="4" placeholder="Type teachers code">
                </li>
                <?php if ($_SESSION['elevation'] == 3) { ?>
                <li class="form-field Blue Split">
                    <button id="TeacherLoad">Load teacher data</button>
                </li>
                <?php } ?>
                <li class="form-field Split form-fade">
                    <label for="teacher_code">Teacher code</label>
                    <input id="TeacherCode" type="text" name="teacher_code" maxlength="4" placeholder="Type teacher code">
                </li>
                <li class="form-field Split form-fade">
                    <label for="name">Name</label>
                    <input id="TeacherName" type="text" name="name" maxlength="255" placeholder="Type new name">
                </li>
                <li class="form-field Split form-fade">
                    <label for="password">Password</label>
                    <input id="TeacherPassword" type="password" name="password" maxlength="255" placeholder="Type new password">
                </li>
                <li class="form-field Split form-fade">
                    <label for="password_confirm">Confirm password</label>
                    <input id="TeacherPConfirm" type="password" name="password_confirm" maxlength="255" placeholder="Confirm password">
                </li>
                <li class="form-field Split form-fade">
                    <label for="email">Email address</label>
                    <input id="TeacherEmail" type="email" name="email" maxlength="255" placeholder="Type new email">
                </li>
                <li class="form-field Split form-fade">
                    <label for="department">Department</label>
                    <input id="TeacherDepartment" type="text" name="department" maxlength="255" placeholder="Type new department">
                </li>
                <li class="form-field Split form-fade">
                    <label>Subject</label>
                    <input id="TeacherSubject" type="text" name="subject_id" maxlength="255" placeholder="Type teachers subject">
                </li>
                <li class="form-field Red Split form-fade">
                    <button id="TeacherRemove">Delete account</button>
                </li>
                <?php if ($_SESSION['elevation'] == 3) { ?>
                <li class="form-field Full form-fade">
                    <label for="elevation">Elevation</label>
                    <div class="radio">
                        <input id="teacher" class="TeacherElevation" name="elevation" type="radio" value=0>
                        <label for="teacher" class="radio-label">Teacher</label>
                    </div>
                    <div class="radio">
                        <input id="tic" class="TeacherElevation" name="elevation" type="radio" value=1>
                        <label for="tic" class="radio-label">Teacher in charge</label>
                    </div>
                    <div class="radio">
                        <input id="hol" class="TeacherElevation" name="elevation" type="radio" value=2>
                        <label for="hol" class="radio-label">Head of learning</label>
                    </div>
                    <div class="radio">
                        <input id="sysadmin" class="TeacherElevation" name="elevation" type="radio" value=3>
                        <label for="sysadmin" class="radio-label">Systems admin</label>
                    </div>
                </li>
                <?php } ?>
                <li class="form-submit form-fade">
                    <button id="TeacherUpdate">Apply changes</button>
                </li>
            </ul>
        </form>
    </div>
</div>
<script src="./js/accounts.js"></script>
<?php if ($_SESSION['elevation'] == 3) { ?>
<script>GetTeacher('all');</script>
<?php } else { ?>
<script>GetTeacher(<?php echo $_SESSION['userid']; ?>);</script>
<?php } ?>

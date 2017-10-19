<div id="account-delete-modal" style="display: none;">
	<?php if($_REQUEST['admin'] != 'accounts/edit_account' && $_REQUEST['admin'] != 'accounts/add_account') ?>
	<h2 style="margin:30px;text-align:center;color:black;display:block!important;">Enter <?php if ($_SESSION['elevation'] != 3) {$admin_delete=false;echo 'your';} else {$admin_delete=true;echo 'teachers';} ?> password to confirm:<br/><br/>(Note: This <b>CAN NOT</b> be undone)</h2>
	<form class="ModalForm" method="post" enctype="multipart/form-data">
		<ul>
			<li class="form-field">
				<label for="password_confirm">Password</label>
				<input id="ConfirmPassword" type="password" maxlength="255" name="password_confirm" placeholder="Type password here">
			</li>
			<li class="form-submit Blue">
				<button id="RemoveConfirm" onclick="RemoveTeacher(<?php echo $_SESSION['userid']; ?>, <?php echo json_encode($admin_delete); ?>, event);">Remove account</button>
			</li>
			<h4 id="acc_delete_form" class="form-error"></h4>
		</ul>
	</form>
</div>

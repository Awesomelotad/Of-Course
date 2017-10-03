<?php
if (isset($_SESSION['status'])) {
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
		<nav class="navigation">
			<?php
			if (isset($_SESSION['status'])) {
				if ($_SESSION['status'] == 'active') {
					$visitor_type = 'Administration';
				}
			} else {
				$visitor_type = 'Selection';
			}
			echo "<h1 class=\"title\">".date("Y", strtotime('+1 year'))." Options $visitor_type</h1>";
			?>
			<div class="nav-mobile">
				<a id="nav-toggle" href="#!"><span></span></a>
			</div>
			<ul class="nav-list">
				<li><a href="index.php?admin=home">CONTENTS</a></li>
				<?php if($_SESSION['elevation'] >=2) { ?>
				<li><a href="index.php?admin=requests">USER REQUESTS<?php if ($_SERVER["REQUEST_URI"] != '/OfCourse(Alpha_0)/index.php?admin=requests') {echo '<span class="request-count">'.$requests_result.'</span>';} ?></a></li>
				<?php }
				if ($_SESSION['elevation'] >= 0) { ?>
				<li><a href="index.php?admin=calendar">CALENDAR</a></li>
				<?php }
				if($_SESSION['elevation'] >= 0) { ?>
					<li><a href="#!">ACCOUNTS<div class="drop-arrow"></div></a>
					<ul class="nav-dropdown">
						<?php if ($_SESSION['elevation'] == 3) { ?>
						<li><a href="index.php?admin=accounts/add_account">- ADD ACCOUNT</a></li>
						<?php } ?>
						<li><a href="index.php?admin=accounts/edit_account">- EDIT ACCOUNT</a></li>
						<li><a <?php if ($_SESSION['elevation'] == 3) {echo "href='index.php?admin=accounts/remove_account'";} else {echo "onclick=\"modal.open('#account-delete-modal');\"";} ?>>- REMOVE ACCOUNT</a></li>
					</ul>
					</li>
				<li><a href="index.php?page=welcome">HOMEPAGE</a></li><?php
				} ?>
			</ul>
		</nav><?php
	}
}

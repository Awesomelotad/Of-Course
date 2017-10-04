<nav class="navigation">
	<?php echo "<h1 class=\"title\">".date("Y", strtotime('+1 year'))." Options Selection</h1>"; ?>
	
	<div class="nav-mobile">
		<a id="nav-toggle" href="#!"><span></span></a>
	</div>
	<ul class="nav-list">
		<li><a href="index.php?page=welcome">HOME</a></li>
		<li><a href="#!">USEFUL INFO <div class="drop-arrow"></div></a>
		<ul class="nav-dropdown">
            <li><a href="index.php?page=calendar">- IMPORTANT DATES</a></li>
            <li><a href="index.php?page=careers">- CAREERS INFO</a></li>
            <li><a href="index.php?page=entrance">- UNIVERSITY ENTRANCE</a></li>
            <li><a href="./media/ncea.pdf" target="_blank">- NCEA INFO</a></li>
            <li><a href="index.php?page=types">- COURSE TYPES</a></li>
		</ul>
		</li>
		<li><a href="#!">JUNIORS <div class="drop-arrow"></div></a>
		<ul class="nav-dropdown">
            <li><a href="index.php?page=courses&year=9">- YEAR 9</a></li>
            <li><a href="index.php?page=courses&year=10">- YEAR 10</a></li>
		</ul>
		</li>
		<li><a href="#!">SENIORS <div class="drop-arrow"></div></a>
		<ul class="nav-dropdown">
            <li><a href="index.php?page=courses&year=11">- LEVEL 1</a></li>
            <li><a href="index.php?page=courses&year=12">- LEVEL 2</a></li>
            <li><a href="index.php?page=courses&year=13">- LEVEL 3</a></li>
		</ul>
		</li>
		<li><a href="index.php?page=selection">SUBJECT SELECTION</a></li>
		<li><a href="index.php?page=contact">CONTACT</a></li>
		<?php
		if (isset($_SESSION['user']) && isset($_SESSION['status']) && !isset($_REQUEST['admin'])) { ?>
		   <li><a href="index.php?admin=home">ADMIN</a></li><?php
	   	} ?>
	</ul>
</nav>

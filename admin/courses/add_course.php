<div id="department-modal" style="display: none;">
    <h2 id="department-modal-header" style="text-align:center;color:black;"></h2>
    <form class="modal-form">
        <ul>
            <li class="form-submit">
                <button id="department-submit">Add department</button>
            </li>
        </ul>
    </form>
</div>

<div class="Accounts Container">
    <h1 class="Important">- Add a course -</h1>
    <div class="Content">
        <form id="course-form" class="static-form" enctype="multipart/form-data" autocomplete="off" onkeypress="return event.keyCode != 13;">
            <ul class="FormContainer">
				<li class="form-field Split">
					<label for="course-code">Course code</label>
                    <input id="course-code" type="text" name="course-code" maxlength="10" placeholder="Type course code" autofocus required>
				</li>
				<li class="form-field Split">
					<label for="course-name">Course name</label>
                    <input id="course-name" type="text" name="course-name" maxlength="100" placeholder="Type course name" required>
				</li>
				<li class="form-field Split">
					<label for="course-year">Year level</label>
                    <select id="course-year" name="course-year" required>
						<option value="" disabled selected>Select a year...</option>
						<?php
						$sql = "SELECT * FROM year ORDER BY year_id ASC";
						$query = mysqli_query($dbconnect, $sql);
						while ($row = mysqli_fetch_assoc($query)) {
		                	echo "<option value=".$row['year_id'].">".$row['year_level']."</option>";
		   				}
						?>
					</select>
				</li>
				<li class="form-field Split" <?php if ($_SESSION['elevation'] == 3) {echo "style='display:none;'";} ?>>
					<label for="course-department">Course department</label>
                    <select id="course-department" name="course-department" <?php if ($_SESSION['elevation'] != 3) {echo "required";} ?>>
						<option value="" disabled selected>Select a department...</option>
						<?php
						$sql = "SELECT * FROM department ORDER BY department_name ASC";
						$query = mysqli_query($dbconnect, $sql);
						while ($row = mysqli_fetch_assoc($query)) {
		                	echo "<option value=".$row['department_id'].">".$row['department_name']."</option>";
		   				}
						?>
					</select>
				</li>
				<li class="form-field Split" <?php if ($_SESSION['elevation'] != 3) {echo "style='display:none;'";} ?>>
					<label for="course-department-name">Course department</label>
                    <input id="course-department-name" type="text" name="course-department-name" maxlength="100" placeholder="Type course department name" <?php if ($_SESSION['elevation'] == 3) {echo 'required';} ?>>
				</li>
				<li class="form-field Split">
					<label for="course-optional">Is this course optional?</label>
                    <div class="radio">
                        <input id="course-optional-true" name="course-optional" type="radio" value=1 checked>
                        <label for="course-optional-true" class="radio-label" >Yes</label>
                    </div>
                    <div class="radio">
                        <input id="course-optional-false" name="course-optional" type="radio" value=0>
                        <label for="course-optional-false" class="radio-label" >No</label>
                    </div>
				</li>
				<li class="form-field Split">
					<label for="course-prereqs">Does this course have prerequisites?</label>
                    <div class="radio">
                        <input id="course-prereqs-true" name="course-prereqs" type="radio" value=1 checked>
                        <label for="course-prereqs-true" class="radio-label" >Yes</label>
                    </div>
                    <div class="radio">
                        <input id="course-prereqs-false" name="course-prereqs" type="radio" value=0>
                        <label for="course-prereqs-false" class="radio-label" >No</label>
                    </div>
				</li>
				<li class="form-field Split">
					<label for="course-teacher">Teacher-in-charge</label>
                    <input id="course-teacher" type="text" name="course-teacher" maxlength="4" placeholder="Type teacher-in-charge code" required>
				</li>
				<li class="form-field Split">
					<label for="course-standard">Standard type</label>
                    <select id="course-standard" name="course-standard" required>
						<option value="" disabled selected >Select a standard...</option>
						<option value=0 >Achievement standard (AS)</option>
						<option value=1 >Unit standard (US)</option>
						<option value=2 >Junior standard (JR)</option>
					</select>
				</li>
				<li class="form-field Split">
					<label for="course-credits">Course credits</label>
                    <input id="course-credits" type="number" name="course-credits" min=1 max=99 placeholder="Type number of credits" required>
				</li>
				<li class="form-field Split">
					<label for="course-outline">Course outline pdf</label>
					<input type="hidden" name="MAX_FILE_SIZE" value="102400" />
					<input id="course-outline" type="file" name="course-outline" accept="application/pdf" required>
				</li>
                <li class="form-submit">
                    <button type="submit" id="course-submit" onclick="validateFile('#course-outline', 102400, 5120)">Add course</button>
                </li>
            </ul>
        </form>
    </div>
</div>
<script src="./js/courses.js"></script>
<script src="./js/validation.js" charset="utf-8"></script>
<script>GetCourse('all');</script>
<?php if ($_SESSION['elevation'] == 3) { ?>
<script type="text/javascript">GetTeacher('all');</script>
<?php } else { ?>
<script type="text/javascript">GetTeacher(<?php echo "'".$_SESSION['userid']."'"; ?>);</script>
<?php } ?>

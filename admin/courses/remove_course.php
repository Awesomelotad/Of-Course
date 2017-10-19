<div class="Courses Container">
	<h1 class="Important"> - Remove a course - </h1>
	<div class="Important">Be <i><b>VERY</b></i> careful what you do here...</div>
	<div class="Content">
		<form id="CourseDeleteForm" class="StaticForm" enctype="multipart/form-data" autocomplete="off" onkeypress="return event.keyCode != 13;">
			<ul class="FormContainer">
				<li class="form-field Split">
					<label for="course">Course to remove</label>
					<input type="text" id="CourseName" name="course" maxlength="255" placeholder="Type course name">
				</li>
				<li class="form-field Split Red">
					<button id="CourseRemove">Delete course</button>
				</li>
			</ul>
		</form>
	</div>
</div>
<script src="./js/courses.js"></script>
<script type="text/javascript">GetCourse('all');</script>

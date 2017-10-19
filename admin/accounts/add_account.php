<div id="department-modal" style="display: none;">
    <h2 id="department-modal-header" style="text-align:center;color:black;"></h2>
    <form class="ModalForm">
        <ul>
            <li class="form-submit">
                <button id="DepartmentSubmit">Add department</button>
            </li>
        </ul>
    </form>
</div>

<div class="Accounts Container">
    <h1 class="Important">- Add an account -</h1>
    <div class="Important">Complete control of account registration</div>
    <div class="Content">
        <form id="TeacherForm" class="StaticForm" enctype="multipart/form-data" autocomplete="off" onkeypress="return event.keyCode != 13;">
            <ul class="FormContainer">
                <li class="form-field Split">
                    <label for="teacher_code">Teacher code</label>
                    <input id="TeacherCode" type="text" name="teacher_code" maxlength="4" placeholder="Type teachers code" autofocus>
                </li>
                <li class="form-field Split">
                    <label for="name">Teacher name</label>
                    <input id="TeacherName" type="text" name="name" maxlength="255" placeholder="Type teachers name">
                </li>
                <li class="form-field Split">
                    <label for="email">Teacher email</label>
                    <input id="TeacherEmail" type="email" name="email" maxlength="255" placeholder="Type teachers email">
                </li>
                <li class="form-field Split">
                    <label for="password">Teacher password</label>
                    <input id="TeacherPassword" type="password" name="password" maxlength="255" placeholder="Type teachers password">
                </li>
                <li class="form-field Split">
                    <label for="department_id">Teacher department</label>
                    <input id="TeacherDepartment" type="text" name="department_id" maxlength="255" placeholder="Type teachers department">
                </li>
                <li class="form-field Split">
                    <label>Teacher subject</label>
                    <input id="TeacherSubject" type="text" name="subject_id" maxlength="255" placeholder="Type teachers subject">
                </li>
                <li class="form-field Full">
                    <label for="elevation">Teacher elevation</label>
                    <div class="radio">
                        <input id="teacher" class="TeacherElevation" name="elevation" type="radio" value=0 checked>
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
                <li class="form-submit">
                    <button id="TeacherSubmit">Register teacher</button>
                </li>
            </ul>
        </form>
    </div>
</div>
<script src="./js/accounts.js"></script>
<script>GetDepartment('all');</script>

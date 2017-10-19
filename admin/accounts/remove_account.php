<div class="Accounts Container">
    <h1 class="Important">- Remove an account -</h1>
    <div class="Important">Be <i><b>VERY</b></i> careful what you touch here...</div>
    <div class="Content">
        <form id="TeacherDeleteForm" class="StaticForm" enctype="multipart/form-data" method="post" autocomplete="off" onkeypress="return event.keyCode != 13;">
            <ul class="FormContainer">
                <li class="form-field Split">
                    <label for="teacher">Teacher to remove</label>
                    <input type="text" id="TeacherIdentity" name="teacher" maxlength="4" placeholder="Type teachers code">
                </li>
                <li class="form-field Red Split">
                    <button id="TeacherRemove">Delete teacher</button>
                </li>
            </ul>
        </form>
    </div>
</div>
<script src="./js/accounts.js"></script>
<script type="text/javascript">GetTeacher('all');</script>

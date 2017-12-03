<?php
if ($_REQUEST['year'] == 9) {
    $result_sql = ("SELECT course_name, course_code, year_id, optional, course.department_id, department.department_id, department.department_name FROM (course INNER JOIN department ON course.department_id=department.department_id) WHERE year_id=9");
} elseif ($_REQUEST['year'] == 10) {
    $result_sql = ("SELECT course_name, course_code, year_id, optional, course.department_id, department.department_id, department.department_name FROM (course INNER JOIN department ON course.department_id=department.department_id) WHERE year_id=10");
}
?>

<thead>
    <tr>
        <th>Code</th>
        <th>Class name</th>
    </tr>
</thead>

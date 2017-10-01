<?php
if ($_REQUEST['year'] == (12 || 13)) {
    $result_sql = ("SELECT course_name, class_code, course.standard_id, standard.standard_id, standard.standard_name, num_credits, year_id, optional, course.department_id, department.department_id, department.department_name, group_name, num_credits FROM ((course INNER JOIN department ON course.department_id=department.department_id) INNER JOIN standard ON course.standard_id=standard.standard_id) WHERE year_id=".$_REQUEST['year']);
} else {
    $result_sql = ("SELECT course_name, class_code, num_credits, year_id, optional, course.department_id, department.department_id, department.department_name, group_name, num_credits FROM (course INNER JOIN department ON course.department_id=department.department_id) WHERE year_id=".$_REQUEST['year']);
}
?>

<thead>
    <tr>
        <th>Code</th>
        <th>Class name</th>
        <th>Optional</th>
        <th>Department name</th>
        <?php if ($_REQUEST['year'] == (12 || 13)) { ?>
        <th>Standard</th>
        <?php } ?>
        <th>Number of credits</th>
    </tr>
</thead>
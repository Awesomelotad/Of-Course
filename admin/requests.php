<?php
$requests_sql = "SELECT teachers.*, department.department_id, department.department_name FROM (teachers INNER JOIN department ON teachers.department_id=department.department_id) WHERE status=0 AND (elevation=$priv_lower OR elevation=$priv_middle OR elevation=$priv_upper)";
$requests_query = mysqli_query($dbconnect, $requests_sql);
?>
<script src="./datatables/js/jquery.datatables.js"></script>
<script src="./datatables/js/responsive.datatables.js"></script>
<script src="./datatables/js/datatables.min.js"></script>
<div class="Requests Container">
    <h1 class="Important">
        <?php
        if ($_SESSION['elevation'] == 2) {
            echo "Teacher account requests";
        } elseif ($_SESSION['elevation'] == 3) {
            echo "T-I-C / H-O-L account requests";
        }
        ?>
    </h1>
    <div class="Help Important">Click the '+' to see more info</div>
    <div class="Content">
        <table id="RequestsTable" class="display nowrap cell-border" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>State:</th>
                    <th>Code:</th>
                    <th>Name:</th>
                    <th>Subject:</th>
                    <th>Department:</th>
                    <th>Email:</th>
                    <th>Role:</th>
                    <th>Action:</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $return_arr = array();
                mysqli_data_seek($requests_query, 0);
                while ($row = mysqli_fetch_assoc($requests_query)) {
                    if ($row['elevation'] == 0) {
                        $row['role'] = 'Teacher';
                    } else if ($row['elevation'] == 1) {
                        $row['role'] = 'Teacher in charge';
                    } else if ($row['elevation'] == 2) {
                        $row['role'] = 'Head of learning';
                    } else {
                        $row['role'] = 'Unknown?';
                    }
                    $row['action'] = null;
                    $row['status'] = 'Pending...';
                    $return_arr[] = $row;
                }
                ?>
                <script>
                    var $requests_table_data = <?php echo json_encode($return_arr); ?>;
                </script>
            </tbody>
        </table>
        <script src="./js/tables/requests_table_functions.js"></script>
        <script src="./js/tables/requests_table.js"></script>
    </div>
</div>
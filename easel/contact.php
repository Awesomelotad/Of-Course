<script src="./datatables/js/jquery.datatables.js"></script>
<script src="./datatables/js/responsive.datatables.js"></script>
<script src="./datatables/js/datatables.min.js"></script>
<div class="Table Container">
    <h1 class="Important">- Contact Info -</h1>
    <br/>
    <div class="Content">
        <?php
        $result_sql = "SELECT teacher_code, teachers.department_id, department.department_name, name, subject, email FROM (teachers INNER JOIN department ON teachers.department_id=department.department_id) WHERE status=1";
        $result_query = mysqli_query($dbconnect,$result_sql);
        $result_rs = mysqli_fetch_assoc($result_query);
        ?>
        <table id="ContactTable" class="display cell-border" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Email address</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $result_query=mysqli_query($dbconnect, $result_sql); 
                $return_arr = array(mysqli_fetch_assoc($result_query));
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $return_arr[] = $row;
                }
                ?>
                <script>
                    var $contact_table_data = <?php echo json_encode($return_arr); ?>;
                </script>
            </tbody>
        </table>
        <script src="./js/tables/contact_table.js"></script>
    </div>
</div>
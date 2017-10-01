<script src="./datatables/js/jquery.datatables.js"></script>
<script src="./datatables/js/responsive.datatables.js"></script>
<script src="./datatables/js/datatables.min.js"></script>
<div class="Table Container">
    <h1 class="Important">- Important Dates -</h1>
    <br/>
    <div class="Content">
        <?php
        $result_sql = "SELECT * FROM dates";
        $result_query = mysqli_query($dbconnect,$result_sql);
        $result_rs = mysqli_fetch_assoc($result_query);
        ?>
        <table id="DatesTable" class="display cell-border" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Date</th>
                    <th class="no-sort">Event description</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $result_query=mysqli_query($dbconnect, $result_sql); 
                $return_arr = array(mysqli_fetch_assoc($result_query));
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $row['date'] = date("d/m/Y", strtotime($row['date']));
                    $return_arr[] = $row;
                }
                ?>
                <script>
                    var $dates_table_data = <?php echo json_encode($return_arr); ?>;
                </script>
            </tbody>
        </table>
        <script src="./js/tables/calendar_table.js"></script>
    </div>
</div>
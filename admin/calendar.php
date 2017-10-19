<script src="./datatables/js/jquery.datatables.js"></script>
<script src="./datatables/js/responsive.datatables.js"></script>
<script src="./datatables/js/datatables.min.js"></script>
<script src="./datatables/js/buttons.datatables.js"></script>
<div id="dates-modal" style="display: none;">
    <form id="DateForm" class="ModalForm" enctype="multipart/form-data">
        <ul>
            <li class="form-field">
                <label for="NewDate">Date</label>
                <input id="DateInput" type="date" name="NewDate" maxlength="10" placeholder="YYYY-MM-DD" autofocus>
            </li>
            <li class="form-field">
                <label for="NewDescription">Description</label>
                <textarea id="DescriptionInput" type="text" maxlength="254" placeholder="Enter a description" name="NewDescription" onfocus="adjust_textarea(this);" onkeyup="adjust_textarea(this);"></textarea>
            </li>
            <li class="form-submit">
                <button id="DateSubmit"></button>
            </li>
            <h4 id="SubmitError" style="text-align:center;display:none;margin-bottom:0;color:black;"></h4>
        </ul>
    </form>
</div>

<div id="confirm-modal" style="display: none;">
    <h2 style="text-align:center;color:black;">Are you sure you want to delete this event?</h2>
    <form class="ModalForm">
        <ul>
            <input type="text" id="MetaRow" value="" style="display:none;"/>
            <input type="text" id="MetaData" value="" style="display:none;"/>
            <li class="form-submit">
                <button id="ConfirmDateDelete">Yes, delete it</button>
            </li>
        </ul>
    </form>
</div>

<div class="Calendar Container">
    <h1 class="Important">Events administration</h1>
    <div class="Content">
        <?php
        $dates_sql = "SELECT * FROM dates";
        $dates_query = mysqli_query($dbconnect, $dates_sql);
        $result = mysqli_fetch_assoc($dates_query);
        if ($result != null) {
            $dateOld = $result['date'];
            $dateNew = date_format(date_create($dateOld), "d/m/Y");
            $result['date'] = $dateNew;
        }
        $return_arr = array($result);
        if ($return_arr[0] != null) {
            while ($row = mysqli_fetch_assoc($dates_query)) {
                $row['date'] = date_format(date_create($row['date']), "d/m/Y");
                $return_arr[] = $row;
            }
        } else {
            $return_arr = array();
        }
        ?>
        <script>
            var $dates_table_data = <?php echo json_encode($return_arr); ?>;
        </script>
        <table id="DatesTable" class="display cell-border" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Event description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <script src="./js/tables/calendar_table_functions.js"></script>
        <script src="./js/tables/calendar_table_admin.js"></script>
    </div>
</div>
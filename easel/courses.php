<script src="./datatables/js/jquery.datatables.js"></script>
<script src="./datatables/js/responsive.datatables.js"></script>
<script src="./datatables/js/datatables.min.js"></script>
<div class="Courses Container">
    <h1 class="Important">- Year <?php echo $_REQUEST['year']; ?> Courses -</h1>
    <div class="Content">
        <?php
        echo "<p><b>At Year ".$_REQUEST['year']." ...</b></p>";
        if ($_REQUEST['year'] == 9 || $_REQUEST['year'] == 10) {
            echo "<h2>From the yellow (compulsary) :</h2>
                <p>You must choose <b>English</b>, <b>Mathematics</b>, <b>Science</b>, <b>Social Studies</b>, <b>Health</b> and
                <b>Physical Education</b> when you select your options.  The course that you are enrolled in will be decided by the HoL based
                on your results in the subject in Year ".($_REQUEST['year'] - 1).".<br/>
                </p><h2>From the green (optional) :</h2><p>
                In addition to the compulsory courses, you must choose <b>FOUR</b> options ";
            if ($_REQUEST['year'] == 9) {
                echo "from the green rows below (one from each; Arts, Language, and Technology) and one";
            } echo " from any green row. The outlines below are provided for your information only.</p>";
        } elseif ($_REQUEST['year'] == 11) {
            echo "<p>You must choose <b>English</b>, <b>Mathematics</b> and <b>Science</b> when you select your options. The course that you are enrolled in will
                be decided by the HoL based on your results in the subject this year. The outlines below are provided for your information
                only.</p>";
        } elseif ($_REQUEST['year'] == 12) {
            echo "<p>You must choose either <b>English</b> or <b>Literacy</b> as one of your subjects in Year 12.<br/><br/>The course that you are
                enrolled in will be decided by the HoL based on your <b>English</b> results this year. The outlines below are provided for your
                information only.</p>";
        } elseif ($_REQUEST['year'] == 13) {
            echo "<p><ul><li>You MUST choose FIVE full courses: 4 periods each per week</li><li>You will have
                one option of study (4 periods per cycle)</li><li>Make sure you see the <a href=\"index.php?page=entrance\">university entrance
                information</a> at the preceding link</li></ul><p>There are no limitations on your subject choices but make sure you choose
                carefully. For your subject choices consider the entry requirements to university and to particular tertiary courses you have
                an interest in studying. Consider your subject interests and abilities and your career and life plans. </p><ul><li>Where a
                learner wishes to enter a course but does not meet the entry requirements (the prerequisites), the HOD or HOL of that subject
                must be approached by the learner for entry approval.</li> <li>Final approval of all courses remains at the discretion of the
                College Principal.</li></ul></p>";
        }
        ?>
        <table id="YearTable" class="display cell-border" cellspacing="0" width="100%">
            <tbody>
                <?php
                if ($_REQUEST['year'] == 9 or $_REQUEST['year'] == 10) {
                    include('./easel/tables/junior.php');
                    $LoadPage = true;
					$senior = False;
                } elseif ($_REQUEST['year'] <= 13 and $_REQUEST['year'] > 10) {
                    include('./easel/tables/senior.php');
                    $LoadPage = true;
					$senior = True;
                } else {
                    echo "<h1 class=\"Important\" style=\"margin: auto 0;\">- Error 404: Page not found. -</h1>";
                    $LoadPage = false;
                }
                if ($LoadPage) {
                    $result_query = mysqli_query($dbconnect, $result_sql);
                    $return_arr = array();
                    mysqli_data_seek($result_query, 0);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        if ($row['optional'] == 0 && $senior == False) {
                            $row['department_name'] = 'Compulsory';
                        }
                        $return_arr[] = $row;
                    }
                ?>
                <script>
                    var $year_table_data = <?php echo json_encode($return_arr); ?>;
                    var $ReqYear = <?php echo $_REQUEST['year']; ?>;
                </script>
                <?php }  if ($_REQUEST['year'] == 9 || $_REQUEST['year'] == 10) { ?>
                <script src="./js/tables/course_table_jr.js"></script>
                <?php } else { ?>
                <script src="./js/tables/course_table_sr.js"></script>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

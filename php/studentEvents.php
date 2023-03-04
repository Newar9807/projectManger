<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
// require_once($root . "5thproject/php/tmpFunction/stdEvents.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>
    <link rel="stylesheet" href="../assets/css/events.css">
    <title>Teacher</title>

</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
        <?php include($root . "/5thproject/php/assets/stdSidebar.php"); ?>
        <!-- Sidebar Ends -->

        <!-- mid div starts -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/5thproject/php/assets/tecNav.php"); ?>
            <!-- Navigation Ends -->
            <div id="container">
                <br>
                <h1 id="hed">Enter Year and Month</h1><br>
                <hr><br>
                <h1 id="pst" hidden="hidden">CALENDAR</h1>
                <form action="" method="post" autocomplete="off" id="frm">
                    Enter Year : <input type="number" name="year" class="inp" min="1000" max="2022" value="2022" placeholder="1999" />
                    <pre>   ||   </pre>
                    Enter Month : <input type="number" name="month" class="inp" min="1" max="12" value="2" placeholder="12" /><br><br>
                    <button name="btn" class="btn">SHOW CALENDER</button>
                </form>
                <br>
                <hr><br>
                <!-- <a href="calendar.php"></a> -->
                <?php
                if (isset($_POST['btn'])) {
                    if (empty($_POST['year']) || empty($_POST['month'])) {
                        echo "<center>Please Fill Up All Boxes ..</center>";
                        return;
                    }
                    $year = $_POST['year'];
                    $month = $_POST['month'];
                    $tempDate = mktime(0, 0, 0, $month, 1, $year);
                    $mnth = date('F', $tempDate);
                    $yr = date('Y', $tempDate);
                    $day = date('t', $tempDate); //retuns total number of days
                    $tempDay = 1;
                ?><span id="prev" class="noColor">&#129184 &nbsp;</span><?php
                                                                        echo '' . ucfirst($mnth) . ', ' . $yr . '';
                                                                        ?><span id="nxt" class="noColor">&nbsp; &#129185</span><?php
                                                                                                                                ?>
                    <script>
                        document.getElementById('frm').style.visibility = 'hidden';
                        // document.getElementById('hed').setAttribute("disabled");
                        document.getElementById('pst').removeAttribute("hidden");
                    </script>
                    <table border="1px" style="align-items: center; margin: auto; border-collapse: collapse;">

                        <tr style="background-color: #BDC581;">
                            <th>SUNDAY</th>
                            <th>MONDAY</th>
                            <th>TUESDAY</th>
                            <th>WEDNESDAY</th>
                            <th>THURSDAY</th>
                            <th>FRIDAY</th>
                            <th class="holiday">SATURDAY</th>
                        </tr>
                        <?php
                        ret:
                        ?>
                        <tr style="background-color: #58B19F;">
                            <?php
                            $count = 0;
                            while ($tempDay <= $day) {
                                $tempFilterDay = mktime(0, 0, 0, $month, $tempDay, $year);
                                $filterDay = date('w', $tempFilterDay);
                                if ($tempDay == 1) {
                                    for ($emptyDays = 1; $emptyDays <= $filterDay; $emptyDays++) {
                            ?>
                                        <td>-</td>
                                    <?php
                                        $count++;
                                    }
                                }

                                if ($count == 6) {
                                    ?>
                                    <td class="holiday">
                                    <?php
                                } else {
                                    ?>
                                    <td>
                                    <?php
                                }
                                echo $tempDay;
                                $count++;
                                    ?>
                                    </td>
                                    <?php
                                    $tempDay++;
                                    if ($count >= 7) {
                                        goto ret;
                                    } else if ($count < 7 && $tempDay > $day) {
                                        do {
                                    ?>
                                            <td>-</td>
                                <?php
                                            $count++;
                                        } while ($count != 7);
                                    }
                                }
                                ?>
                        </tr>
                    </table>
                    <br>
                    <button class="btn manul" id="manul" onclick="manul()">Input Manually</button>
                <?php
                };
                ?>
            </div>
            <!-- mid div ends -->
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/teacherDashbaord.js"></script>


</body>

</html>
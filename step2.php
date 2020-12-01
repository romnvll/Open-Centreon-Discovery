<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
snmp_set_quick_print(1);
error_reporting(E_ALL);



require_once 'Centreon.class.php';
require_once 'Scan.class.php';



@$scan = new scan($_GET['hostNetwork'],$_GET['version']);

@$tab = $scan->scan($_GET['community'],$_GET['version']);


$centreon = new Centreon();




?>

<input type="checkbox" id="cocher" onclick="setCheckBoxes('hosts', 'host[]');">
<form action="result.php" method="get" name="hosts">
<table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">Template Host</th>
                <th scope="col">Template APPS1</th>
                <th scope="col">Template APPS2</th>
            </tr>
        </thead>
</table>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Serveur</th>
                <th scope="col">OS</th>
                <th scope="col">Template Host</th>
                <th scope="col">Template APPS1</th>
                <th scope="col">Template APPS2</th>
            </tr>
        </thead>
        <tbody>
            


            <?php

            $diff = array_diff($tab, $centreon->getIpHost());


            foreach ($diff as $ip) {
                echo "<tr>";
                echo  "<td><input type='checkbox' id=" . $ip . " name='host[]' value=" . $ip . "></td>";
                echo  "<td><label for='$ip'>" . $ip . " (" . $scan->getName($ip, $_GET['community']) . ") </label></td>";
                echo "<td>" . $scan->getOs($ip, $_GET['community']) . "</td>";


                echo "<td><select name=\"template$ip\" class=\"custom-select\" id=\"inputGroupSelect01\">\n";
                echo "<option ></option> ";
                foreach ($centreon->getTemplateName() as $key => $tplName) {


                    echo "<option value=" . $tplName . ">" . $tplName . "</option> ";
                }
                echo    "</select></td>";


                echo "<td><select name=\"templateapps1$ip\" class=\"custom-select\" id=\"inputGroupSelect02\">";
                echo "<option value=\"\"></option> ";
                foreach ($centreon->getTemplateName() as $key => $tplName) {

                    echo "<option value=" . $tplName . ">" . $tplName . "</option> ";
                }
                echo    "</select></td>";

                echo "<td><select name=\"templateapps2$ip\" class=\"custom-select\" id=\"inputGroupSelect03\">";
                echo "<option value=\"\"></option> ";
                foreach ($centreon->getTemplateName() as $key => $tplName) {

                    echo "<option value=" . $tplName . ">" . $tplName . "</option> ";
                }
                echo    "</select></td>";

                echo "</tr>";
            }


            ?>
        </tbody>
    </table>
    <script>
        function setCheckBoxes(frm, fname) {

            var frm = document.forms[frm];
            if (frm == 'undefined') {

                return;
            }

            var chkBoxs = frm.elements[fname];
            if (chkBoxs == 'undefined') {
                return;
            }

            for ($k in chkBoxs) {


                chkBoxs[$k].checked = true;

                if (document.getElementById("cocher").checked == false) {
                    chkBoxs[$k].checked = false
                }

            }

        }
    </script>
    
    <input type="hidden" value="<?php    echo $_GET['community']; ?>" name="community" id="community2">
    <select name="version">
        <option value="2c">2c</option>
        <option value="1">1</option>
    </select>
    <input type="submit">
</form>

<?php

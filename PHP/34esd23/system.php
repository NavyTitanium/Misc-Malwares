<?php
$zip = new ZipArchive;
if ($zip->open($_GET['ar']) === TRUE) {
    $zip->extractTo(dirname(__FILE__));
    $zip->close();
    echo '<span style="color: green; font-size: 20px;">DONE!</span> <br/>
            <span style="color: grey; font-size: 20px;">Dirname:
            '.dirname(__FILE__).'</span> <br/> <span style="color: red; font-size: 20px;">Filename: '. $_GET['ar'].'</span>'  ;
} else {
    echo 'Error';
        }
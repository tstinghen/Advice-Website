<!DOCTYPE html>

<?php 
session_start();
?>
<html> 
<head> 
<?php 
//ini_set('display_errors', 'On'); 
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'stinghet-db';
$dbuser = 'stinghet-db';
$dbpass = 'XB6i0GgEjGn6lKU8';

$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)
   or die("Error selecting database: $dbname");
   


if ( isset($_POST['username']) ){

$test_user= $_POST['username'];
$test_pass = $_POST['pword'];


$count_query = mysql_query("SELECT username, password FROM `users` WHERE username = '$test_user'"); 
 

WHILE ($rows = mysql_fetch_array($count_query)) : 
	
	$uname = $rows['username'];
	$pword = $rows['password']; 
	
	if($pword == $test_pass)
	{
	
	$_SESSION['username'] = $test_user;
	
	}

endwhile; 

if (isset($_SESSION['username'])){
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://web.engr.oregonstate.edu/~stinghet/advice/main.php\">";
}


else{
echo '<script type="text/javascript">alert("Username or Password are Incorrect.");</script>'; 
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://web.engr.oregonstate.edu/~stinghet/advice/login.php\">";
}

}

else if ((!( isset($_POST['username']) )) && (!(isset($_SESSION['username'])))){

echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://web.engr.oregonstate.edu/~stinghet/advice/login.php\">";
}


?>

<title>Session</title> 

</head> 
<body> 

</body> 
</html> 


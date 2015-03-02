<!DOCTYPE html>
<?php
session_start(); 
?>
<html> 
<head>
<title>Ask and Answer</title> 
<meta charset="utf-8"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<link rel="stylesheet" type="text/css" href="/~stinghet/advice/advicetheme.css">

<body>


<div id="header"> 
Asked and Answered.
</div> 
<br/>
<div id="nav_bar"> 
<table><tr>
<td><div class="button"><a href='http://web.engr.oregonstate.edu/~stinghet/advice/main.php'>Answered Questions</a></div> </td>
<td><div class="button"><a href='http://web.engr.oregonstate.edu/~stinghet/advice/ask.php'>Ask a Question</a></div> </td>
<td><div class="button"><a href='http://web.engr.oregonstate.edu/~stinghet/advice/answer.php'>Answer a Question</a></div> </td>
<td><div class="button"><a href='http://web.engr.oregonstate.edu/~stinghet/advice/yours.php'>Your Questions</a></div></td>
<td><div class="button2"><a href='http://web.engr.oregonstate.edu/~stinghet/advice/brainstorm.php'>Think for Yourself</a></div></td>
</tr>
</table>
</div>





<?php
echo "<div id='main_page'>";
//echo "You have visited this page " .$_SESSION['numhits']." times this session.";

if (isset($_SESSION['username']))
{
$username = $_SESSION['username']; 

echo "<div class='login'> Welcome, " .$username. "! <br/>You are logged in.<br/><a href='http://web.engr.oregonstate.edu/~stinghet/advice/logout.php'>Log Out<br/><br/></a></div>"; 
}


else if (!(isset($_SESSION['username'])))
{
echo "<div class='login'> Welcome Guest<br/><a href='http://web.engr.oregonstate.edu/~stinghet/advice/login.php'>Log In or Sign Up<br/><br/></a></div>";
}


//ini_set('display_errors', 'On'); 
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'stinghet-db';
$dbuser = 'stinghet-db';
$dbpass = 'XB6i0GgEjGn6lKU8';

$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass, $dbname)
    or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)
    or die("Error selecting database: $dbname");
 

$ques_query = mysql_query("SELECT q_title, q_pesudo, q_body, q_id FROM `questions` 
WHERE answer_num > 0 ORDER BY q_id DESC"); 

echo "<div class='q_and_a'>";

WHILE ($rows = mysql_fetch_array($ques_query)) : 
	$ques_title = $rows['q_title'] ;
	$ques_name = $rows['q_pesudo'];
	$ques_body = $rows['q_body'];
	$ques_id = $rows['q_id']; 
	
	echo "<br/><br/><div class = 'question'><h2>$ques_title</h2><br>$ques_body<br/><br/>Asked By- $ques_name<br/><br>"; 

	$ans_query = mysql_query("SELECT a_body, a_pseudo FROM `answers` 
	WHERE q_id = '$ques_id'"); 
	
	WHILE ($rows2 = mysql_fetch_array($ans_query)) :
	$ans_body = $rows2['a_body']; 
	$ans_pseudo = $rows2['a_pseudo']; 

	echo "<br/><div class= 'answer'><br/>$ans_body<br/><br/>Answered By- $ans_pseudo<br/><br/></div></div>"; 
	
	endwhile; 
endwhile; 

echo "</div></div>";


mysqli_close($mysql_handle);




?> 
</body> 


</html> 

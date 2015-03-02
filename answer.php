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
<script type="text/javascript">
	$(document).ready(function(){
		$("#answer_me").validate();
	}); 
</script>
</head>
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
<div class='q_and_a'>

<?php

if (!(isset($_SESSION['username'])))
{
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://web.engr.oregonstate.edu/~stinghet/advice/login.php\">";
}

if(isset($_SESSION['username'])){

$username = $_SESSION['username']; 
echo "<div class = 'login2'>Hey, $username.<br/><a href='http://web.engr.oregonstate.edu/~stinghet/advice/logout.php'>Not you? Log Out</a></div>"; 
}

?>

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
 

$ques_query = mysql_query("SELECT q_title, q_pesudo, q_body, q_id FROM `questions` 
WHERE answer_num <= 0"); 



if ($rows = mysql_fetch_array($ques_query))
{
	$ques_title = $rows['q_title'] ;
	$ques_name = $rows['q_pesudo'];
	$ques_body = $rows['q_body'];
	$ques_id = $rows['q_id']; 
	
	echo "<br/><br/><div class = 'question'><h2>$ques_title</h2><br>$ques_body<br/><br/>Asked By- $ques_name<br/><br></div>"; 
}

else {
echo "There are no more questions at this time. Why don't you go ask one?"; 
}
	



?> 
</div>

<br/><br/>

<fieldset>
<legend><div class = "head_two">
<span title = "This question was chosen because it is the oldest question without an answer. Once you, or someone else answers it, a new question will become available.">
Answer this question [?]</span></div>
</legend> 
<form method="post" id = "answer_me" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label>Answer: <br/> <textarea class = "required" cols = "50" rows = "10" id="q_body" name="a_body">Enter your answer here...</textarea> </label> <br/><br/>
<label><span title="It is not recommended that you use your username or real name as your pseudonym. Choose something descriptive and unique."
>Your Pseudonym [?]:</span>  <input class = "required"  type="text" id="pseudo" name="pseudo"> </label> <br><br>
<input type="submit" value ="Answer!"> <br/>

</form> 

</fieldset>


<?php 

$pseudo = test_input($_POST["pseudo"]);
$a_body = test_input($_POST["a_body"]);

function test_input($data) {
	$data = trim($data); 
	$data = stripslashes($data); 
	$data = htmlspecialchars($data); 
	$data = str_ireplace("'","", $data);
	return $data; 
}



if ($_POST)
{
$strSQL = "INSERT INTO answers(a_pseudo, a_body, q_id, user_id) 
VALUES('$pseudo','$a_body', '$ques_id', (SELECT user_id FROM users WHERE username = '$username'))"; 

mysql_query($strSQL) or die("There was an error and your entry was not submitted. Try omitting quotes or apostrophes.");

$adjSQL = "UPDATE questions 
SET answer_num = '1' 
WHERE q_id = '$ques_id'";

echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://web.engr.oregonstate.edu/~stinghet/advice/answer.php\">";

mysql_query($adjSQL) or die(mysql_error());
}



mysqli_close($mysql_handle);

?> 


<div id="main_page">

</body> 


</html> 
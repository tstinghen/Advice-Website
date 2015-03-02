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
<script src="http://malsup.github.com/jquery.form.js"></script>
<link rel="stylesheet" type="text/css" href="/~stinghet/advice/advicetheme.css">
<script type="text/javascript">
	$(document).ready(function(){
		$("#ask_away").validate();
		
		$('#ask_away').ajaxForm(function() { 
                alert("Thanks for asking! Go ahead and ask another."); 
				$('#ask_away').resetForm();
            }); 
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

<?php 
if (!(isset($_SESSION['username'])))
{
echo "<meta http-equiv=\"refresh\" content=\"0;URL=http://web.engr.oregonstate.edu/~stinghet/advice/login.php\">";
}

if(isset($_SESSION['username'])){

$username = $_SESSION['username']; 
echo "<div class = 'login'>Hey, $username.<br/><a href='http://web.engr.oregonstate.edu/~stinghet/advice/logout.php'>Not you? Log Out</a></div>"; 
}

?>
<br/></br>

<fieldset>
<legend><div class="head_two"><span title = "You can ask whatever kind of question you like. You can ask for advice, or opinions. You can ask about other people's lives, or for answers to trivia. Each question will get just one answer, and questions will be answered in the order that they are asked. If you feel like your question is taking a long time to be answered, go answer some other people's questions while you wait! ">Ask a Question[?]</span></div></legend>
<form method="post" id = "ask_away" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<label>Question Title:  <input class = "required"  type="text" id="q_title" name="q_title"> </label> <br><br>
<label><span title="It is not recommended that you use your username or real name as your pseudonym. Choose something descriptive and unique."
>Your Pseudonym [?]:</span>  <input class = "required"  type="text" id="pseudo" name="pseudo"> </label> <br><br>
<label>Question: <br/> <textarea class = "required" cols = "50" rows = "8" id="q_body" name="q_body">Enter your question here...</textarea> </label> <br/><br/>
<input type="submit" value ="Ask!"> <br/>

</form> 

</fieldset>

<div id="main_page">
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


$q_title = test_input($_POST["q_title"]);
$pseudo = test_input($_POST["pseudo"]);
$q_body = test_input($_POST["q_body"]);

function test_input($data) {
	$data = trim($data); 
	$data = stripslashes($data); 
	$data = htmlspecialchars($data); 
	$data = str_ireplace("'","", $data);
	return $data; 
}



if ($_POST)
{
$strSQL = "INSERT INTO questions(q_pesudo, q_title, q_body, user_id, answer_num) 
VALUES('$pseudo','$q_title','$q_body', (SELECT user_id FROM users WHERE username = '$username'), '0')"; 


mysql_query($strSQL) or die("There was an error and your entry was not submitted. Try omitting and quotes or apostrophes.");
}



mysqli_close($mysql_handle);

?> 
</body> 


</html> 
<!DOCTYPE html>
<html> 
<head> 
<title>Ask and Answer</title>
<meta charset="utf-8"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<link rel="stylesheet" type="text/css" href="/~stinghet/advice/advicetheme.css">
<?php 
session_start();
?>
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

<br/><br/><br/>
<fieldset>
<legend><div class = "head_two">Log In</div></legend>
<br/><br/>
<form id = "sign_in" action="session.php" method="post">
<label>Username:  <input class = "required" type="text"  id="username" name="username"> </label> <br/><br/>
<label>Password:  <input class = "required" type="password"  id="pword" name="pword"></label> <br/><br/>
<input type="submit" value = "Log In"> 
</form>
<div class="signup"><br/><a href='http://web.engr.oregonstate.edu/~stinghet/advice/signup.php'>New? Create an Account</a></div>
</fieldset>

</body> 


</html> 

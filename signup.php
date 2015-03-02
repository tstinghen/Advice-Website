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
		$("#sign_up").validate({
rules: {
pass: "required",
pass2: {
equalTo: "#pass"
}
}
});
$('#sign_up').ajaxForm(function() { 
             
				$('#sign_up').resetForm();
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

if(isset($_SESSION['username'])){

$username = $_SESSION['username']; 
echo "<br/><br/>You are logged in as $username.<div><a href='http://web.engr.oregonstate.edu/~stinghet/advice/logout.php'>Log Out?</a></div>"; 
}

?>
<br/><br/>
<fieldset>
<legend><div class = "head_two">Create an Account</div></legend>
<form id = "sign_up" action="#">
<label><span title="Usernames must be at least 3 characters long."
>Username [?]:</span><input class = "required"  type="text" id="user" name="user"> </label> <br><br>
<label><span title="Passwords must be at least 6 characters long."
>Password [?]:</span>  <input class = "required"  minlength= "6" type="password" id="pass" name="pass"> </label> <br><br>
<label>Password:  <input class = "required"  type="password" id="pass2" name="pass2"> </label> <br><br>

<input type="submit" value ="Sign Up"> <br/><br/>
<a href='http://web.engr.oregonstate.edu/~stinghet/advice/login.php'>Or Log In</a>

</form> 

</fieldset>
<script> 

$( function(){
    $( '#sign_up' ).submit( function(e){
		e.preventDefault(); 
        console.log( 'hello' );
		
		var formData = $( this ).serialize();
		$.ajax({
     type: 'POST',
     url: 'signup_val',
     data: formData,
     success: function( resp ){
         console.log( resp );
		 alert(resp); 
		 
     }
});
    })
});





</script>


</body> 


</html> 
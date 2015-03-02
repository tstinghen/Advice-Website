<!DOCTYPE html>
<html> 
<head> 
<title>Ask and Answer</title>
<meta charset="utf-8"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script src="http://fb.me/react-0.8.0.js"></script> 
<script src="http://fb.me/JSXTransformer-0.8.0.js"></script> 
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

<br/>
<div id="thinkpad">
<br/>
<script type="text/jsx">
	/*** @jsx React.DOM */ 
	
	var List = React.createClass({ 
	
		getInitialState:function(){
			return {info:[], item:'', due:''}
		}, 
		
		changeItem:function(e){
			this.setState({item:e.target.value})
		},
		
		changeDue:function(e){
			this.setState({due:e.target.value})
		},
		
		submitForm:function(e){
			e.preventDefault(); 
			this.state.info.push({item:this.state.item, due:this.state.due}); 
			this.setState({first:'', last:''})
		}, 


		render:function(){
			return (<div> 
			<div id = "stormform">
			
					<h2>Brainstorming ThinkPad</h2>
				
				Say whatever you want.<br/> 
				Maybe you can answer your own questions.<br/>
				Your thoughts will never be saved or shared.<br/><br/>
				
					<form onSubmit={this.submitForm}>
						<label>My thoughts...<br/> 
							<textarea cols = "30" rows = "6" value={this.state.item} onChange={this.changeItem} />
						</label><br/><br/>
					<button>Think</button>
					</form>
					</div>
					<div id = "stormlist">
					<createEntry info={this.state.info} />
					</div>
				
					</div>)
		}
	}); 
	
	var Entry = React.createClass({
		render:function(){
		return (
			<div> 
			<ul>
				<li> {this.props.item} {this.props.due} </li> 
			</ul> 
			</div>
		)
		
		}
	}); 
	
	
	var createEntry = React.createClass({
		render:function(){ 
			var newEntry = this.props.info.map(function(entry){
				return <Entry item={entry.item} due={entry.due} /> 
		}); 
		return ( 
			<div> 
			{newEntry}
			</div>
			)
		}
	}); 
			

	
	
	
	React.renderComponent(<List />, document.getElementById('toDoList'))
</script>
<div id="toDoList"></div> 
</div>

</body> 


</html> 

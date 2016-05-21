<?php

include_once "connection.php";


$sql2="SELECT * FROM `joriz_users` ";
$result2 = mysql_query($sql2);
$counter  =  mysql_num_rows($result2);
mysql_close($con);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>Jaui21 jQuery Raffle</title>
	<style type="text/css">
	
		form {
			margin-bottom: 30px ;
			}
	
		ol#raffle {
			list-style-type: none ;
			float: left ;
			font-size: 30px ;
			margin: 0px 0px 0px 0px ;
			padding: 0px 0px 0px 0px ;
			}
			
		ol#raffle li {
			background-color: #FAFAFA ;
			border: 2px solid #454545 ;
			float: left ;
			height: 60px ;
			line-height: 60px ;
			margin: 0px 10px 10px 0px ;
			overflow: hidden ;
			padding: 0px 0px 0px 0px ;
			text-align: center ;
			width: 60px ;
			}
			
		ol#raffle li.on {
			background-color: gold ;
			font-size: 45px ;
			font-weight: bold ;
			}
	
	</style>
	
	<script type="text/javascript" src="raffle_files/jquery-1.js"></script>
	<script type="text/javascript">
	
		// When document loads, initialize the interface.
		$(
			function(){
				var jForm = $( "form:first" );
				var jSelect = jForm.find( ":input[ name = 'count' ]" );
				
				var cnt = <?php echo  $counter;?>;
				
				// Populate the select box.
				for (intI = 1 ; intI <= cnt ; intI++){
					if (intI = cnt) {
					// Add select option.
					jSelect.append( "<option value=\"" + intI + "\">" + intI + "</option>" );
					}
				}
				
				
				// Hook up raffle button.
				jForm.submit(
					function( objEvent ){
						// Run raffle.
						RunRaffle( jSelect.val() );
					
						// Prevent default.
						return( false );
					}	
					);
			}
			);
			
			
		// Initializes and runs the raffle.
		function RunRaffle( intCount ){
			var jRaffle = $( "#raffle" );
			
			// Clear the raffle list.
			jRaffle.empty();
			
			// Create a new list item for each lot.
			for (var intI = 1 ; intI <= intCount ; intI++){
				
				// Create the lot item.
				jRaffle.append( "<li><div>" + intI + "</div></li>" );
				
			}
			
			// Find the "on" element.
			var jCurrentLI = jRaffle.find( "li:first" ).addClass( "on" );
					
			// Get base pause time.
			var intPause = 40;
			
			// Get the time to wait before chaning the pause time.
			var intDelay = (4500 + (Math.random() * 2000));
						
						
			// Define the ticker.
			var Ticker = function(){
				
				var jNextLI = jCurrentLI.next( "li" );
				
				// Check to see if there is a next LI.
				if (!jNextLI.length){
				
					// Since there is no LI left in the list, our next LI will be the 
					// first one in the list.
					jNextLI = jRaffle.find( "li:first" );
				
				}
				
				// Turn off the current list.
				jCurrentLI.removeClass( "on" );
				
				// Turn on next list.
				jNextLI.addClass( "on" );
				
				// Store the new LI in the current LI (for next iteration).
				jCurrentLI = jNextLI;
				
				
				// Check to see if we should start changing the pause duration.
				if (intDelay > 0){
					
					// Substract from the delay.
					intDelay -= intPause;
					
				} else {
					
					// Change the pause.
					intPause *= (1 + (Math.random() * .1));
				
				}
				
				
				var numb = 783;
				
				// Check to see how long the pause it. Once it gets over a certain wait
				// time, we are done playing and picking the winner.
				if (intPause >= 800){
				
				nume = parseInt(jCurrentLI.text(),10); 
				
				numet = parseInt(nume) + parseInt(numb);
				numc =  nume + numb;
				
				showUser(numet);
				
					// We found a winner!
					alert( "Winner: " + numet );
				
				} else {
								
					// Not done yet, call again shortly.
					setTimeout( Ticker, intPause );
					
				}				
			}
			
			
			// Start ticker.
			Ticker();		
		}
	
	
	</script>

<script type="text/javascript">

function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","query.php?q="+str,true);
xmlhttp.send();
}

</script>

<!-- ONLOAD Function-->
<script>

function begin()
{

var inputs = <?php echo  $counter;?> ;
//alert(inputs);

}

</script>
	
</head>
<body onload="begin()">

	<h1>
		Raffle Game
	</h1>
	
	<form>
	
		<?php echo "Number of Guests "; ?><select name="count" ></select>
		<button type="submit">Run Raffle</button>
		<input type="button" value="Reset" onClick="window.location.reload()">
	</form>
	
	<div id="txtHint"><b>Person will be listed here is the winner.</b></div>
	<br/>
	<ol id="raffle"></ol>
	
	<br clear="all">
	<br>



</body></html>
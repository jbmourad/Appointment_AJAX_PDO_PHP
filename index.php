<?php 
session_start();
include "config/config.php";

// displaying messages 
if(!empty($_SESSION['message'])) {
 
	$message = $_SESSION['message'];
  

	  echo '<div class="alert alert-success" role="alert">';
	  echo $message;
	  echo '</div>';
	  session_destroy();

  }



?>
<!DOCTYPE html>
<html>
<head>
	<title>Appointment with AJAX PDO and PHP</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="public/js/script.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  
</head>
<body>
<form method="post" action="app/save_rdv.php" enctype="multipart/form-data">
<h2 for="rdv">Get Appointment:</h2>
	<table>
			<tr>
			<td>Enter username</td>
			<td>
				<input id='username' name ='username' type='text' required> </input>

				</td>
			</tr>

			<tr>

		    <td>Select date</td>
		    <td>
		    	<!-- date dropdown -->
		        <input id='sel_date' name ='sel_date' type="text" autocomplete="off" placeholder="Select date" required>
		          	
		        	</input>
		      	</td>
		    </tr>

		    <tr>
		      	<td>Select hour</td>
		      	<td>
					<!-- hour available  dropdown -->
			        <select id='sel_hour' name ='sel_hour' required>
			          	<option value='' >Select hour</option>
			          	
			        </select>
		      	</td>
		    </tr>


	</table>
	<input type="submit">
</form>

	<!-- Script -->
	<script type="text/javascript">


	$(document).ready(function(){

		// Date
		$('#sel_date').change(function(){

			var dateselct = $(this).val();
			//var dateselct=dateselct2.substr(-4)+"-"+dateselct2.substr(0,2)+"-"+dateselct2.substr(3,2);
			//console.log(dateselct);
			// Empty hour dropdown
			$('#sel_hour').find('option').not(':first').remove();


			// AJAX request
			$.ajax({
				url: 'app/ajaxfile.php',
				type: 'post',
				data: {request: 1, dateselct: dateselct},
				dataType: 'json',
				success: function(response){

					

					var len = response.length;
					console.log(response);
					console.log(len);

		            for( var i = 0; i<len; i++){
		                //var date = response[i]['date'];
		                var hour = response[i]['hour'];       

		                $("#sel_hour").append("<option value='"+hour+"'>"+hour+"</option>");

		            }
					if (len==0){
						$("#sel_hour").append("<option value='' disabled>---- select another date ----</option>");
					}
				}
			});

			
		});



	});
	</script>
</body>
</html>










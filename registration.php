<!DOCTYPE html>
<html>
<head>
	<title>REGISTRATION  FORM</title>
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head> 
<style>
*{
     padding: 0;
     margin: 0;
     box-sizing: border-box;
 }
 
 body{
     background-image: url('coffee.jpg');
 }
 
 .fixed-header, .fixed-footer{
     width: 100%;
     position: fixed;
     background: rgb(224, 117, 117);
     padding: 10px 0;
     color: rgb(228, 106, 106);
     text-align: center;
 }
 .fixed-header{
    top: 0;
 }
 .fixed-footer{
    bottom: 0;
 }
 
 nav a{
     color: #fff;
     text-decoration: none;
     padding:7px 25px;
     display: inline-block;
 }
 
 form{
     position: relative;
     top: 80px;
     left: 400px;
     width: 40%;
     padding: 10px;
     border-radius: 5px;
     text-align: center;
     background-image: url('lightbrown.jpg');
 }
 
 form label{
     display: block;
 }
 
 form input{
     display: inline-block;
     width: 50%;
     padding: 5px;
     border-radius: 5px;
 }
 
 form input[type=submit]{
     width: 15%;
     padding: 4px;
 }
 
 form p{
     margin-top: 20px;
 }
 h1 {
 	font-family: sans-serif;

 }
</style>
 	<?php
	//include 'header.html';
	require('mysqli_connect.php'); 
	if (isset($_POST['btnsubmit']))
	{
    if (!empty($_POST['firstname']))
        {
            $firstname = mysqli_real_escape_string($dbc,trim($_POST['firstname']));
        }
        else
        {
            $firstname = null;
            echo "<b> You forgot to enter your First Name! </b><br>";
        }
	if (!empty($_POST['lastname']))
	{
		$lastname = mysqli_real_escape_string($dbc,trim($_POST['lastname']));
	}
	else
	{
		$lastname = null;
		echo "<b> You forgot to enter your Last Name! </b><br>";
	}
	if (!empty($_POST['email']))
	{
		$email = $_POST['email'];
	}
	else 
	{
		$email = null;
		echo "<b> You forgot to enter your Email Address! </b><br>";
	}
	if (!empty($_POST['phonenumber']))
	{
		$phonenumber = $_POST['phonenumber'];
	}
	else
	{
		$phonenumber = null;
		echo "<b> You forgot to enter your Phone Number!</b> </br>";
	}	
	if(!empty($_POST['password1']))
	{
		if($_POST['password1']!=$_POST['password2'])
		    {     $password1 = null;
		          echo "<b> Your password did not match! </b><br>";	
        	}
	    else
	        {	
            	$password1 = mysqli_real_escape_string($dbc,trim($_POST['password1']));	
            }
    }
    else {
        $password1 = null;
        echo "<b> You forgot your password. </b>";
     }
    
	if ($firstname&&$lastname&&$email&&$phonenumber&&$password1)
	{
		$sql = "INSERT INTO registration (firstname,lastname,email,phonenumber,password1)
		VALUES ('$firstname','$lastname','$email','$phonenumber','$password1')";

		if(mysqli_query($dbc,$sql))
		{
			echo "NEW RECORD CREATED SUCCESSFULLY";
		}
		else
		{
			echo "Error: " .mysqli_error($dbc);
		}
		mysqli_close($dbc);
	}
	else 
	{
		echo "<b> Please fill out the form again. Thank you!! </b><br>";
	}
    }
	?>	
 <body>
	<div>
		<form action="registration.php" method="POST">
			
				<div class="row">
					<div class="col-sm-12">
						<center><h1> REGISTRATION </h1>
						<p> Please fill up the form! </p>
						<hr class="mb-3">
						<label for="firstname"><b>First Name</b></label>
						<input class="form-control" type="text" name="firstname" required>

						<label for="lastname"><b>Last Name</b></label>
						<input class="form-control" type="text" name="lastname" required>

						<label for="emailaddress"><b>Email Address</b></label>
						<input class="form-control" type="email" name="email" required>

						<label for="phonenumber"><b>Phone Number</b></label>
						<input class="form-control" type="text" name="phonenumber" required>

						<label for="password1"><b>Password</b></label>
						<input class="form-control" type="password" name="password1" required>

						<label for="password2"><b>Re-enter Password</b></label>
						<input class= "form-control" type="password" name="password2" required>

						<hr class="mb-3">

						<input class="btn btn-primary" type="submit" name="btnsubmit" value="Sign Up!"> 
	                    </center>

						<p>
							Already a member? <a href="log in.php"> Log in </a>
					</div>	</p>
				</div>
		</form>	
	</div>	
	
<script type="text/javascript">    

        $(function(){
        $('#registraion').click(function(e){

            var valid = this.form.checkValidity();

            if(valid){


            var firstname   = $('#firstname').val();
            var lastname    = $('#lastname').val();
            var email       = $('#email').val();
            var phonenumber = $('#phonenumber').val();
            var password    = $('#password').val();
            
                e.preventDefault(); 

                $.ajax({
                    type: 'POST',
                    url: 'process.php',
                    data: {firstname: firstname,lastname: lastname,email: email,phonenumber: phonenumber,password: password},
                    success: function(data){
                    Swal.fire({
                                'title': 'Successful',
                                'text': data,
                                'type': 'success'
                                })
                            
                    },
                    error: function(data){
                        Swal.fire({
                                'title': 'Errors',
                                'text': 'There were errors while saving the data.',
                                'type': 'error'
                                })
                    }
                });

                
            }else{
                
            }

        });     
    });
</script>


</body>	
</html>



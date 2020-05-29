<?php
include('rm.php');
?>

<?php
//Form validations
//Fetch values from the form
$error = array("name"=>"","dob"=>"","mobile"=>"","mobile2"=>"","mobile3"=>"","email"=>"","email2"=>"","email3"=>"");
$name=$dob=$mobile=$email="";
$mobile2=$mobile3=$email2=$email3="--";
if(isset($_POST["submit"]))
{
	$conn=mysqli_connect("localhost","root","","rm");
    $name = $_POST['name'];
	$dob = $_POST['dob'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	
    if(empty($name)){
		$error['name'] = "Name can't be blank!!<br>";
      }
      else if(!preg_match('/^[A-Za-z ]+$/',$name)) {
          $error['name'] = "Name should contain alphabets and spaces only!";
		}else if(empty($dob)){
			$error['dob'] = "DOB is required!!";
		}
		else if(empty($mobile)){
			$error['mobile'] = "Mobile can't be blank!!";
		  }
		  else if(!preg_match("/^[0-9]{10}$/",$mobile)) {
			  $error['mobile'] = "Mobile number should be 10 digit number!";
			}else if(empty($email)){
        		$error['email'] = "Email can't be blank!!";
      	}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
          $error['email'] = "Email has to be a valid email address!";
        }else {
			//Insert data to the database
	  $rs=mysqli_query($conn,"SELECT * from contacts where mobile='$mobile' OR mobile2='$mobile' OR mobile3='$mobile'");
	  if (mysqli_num_rows($rs)>0)
      {
        $error['mobile'] = "This mobile number is already exists!";
      }else {
		$q = "INSERT into contacts(name,dob,mobile,mobile2,mobile3,email,email2,email3) values('$name','$dob','$mobile','$mobile2','$mobile3','$email','$email2','$email3')";
		$res = $conn->query($q);
		if($res)
		{
			header("Location:index.php");
		}
	  }
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<title>RENTOMOJO</title>
	<script>
$(document).ready(function() {
	var max_fields = 2; //maximum input boxes allowed
	var wrapper = $(".input_fields_wrap"); //Fields wrapper
	var add_button = $("#ar1"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		var mobile = $('.a2').val();
		if(mobile=='')
		{
			alert("Please enter mobile number!");
		}else {
		if(x <= max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div><input type="text" class="a2" placeholder="+91 xxxxxxxxx" name="mobile"/><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a></div><div class="text_color"><?php echo $error['mobile2'] ?></div><br>'); //add input box
		}else{
			alert("You can't enter more than 3 mobile numbers!");
		}
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

$(document).ready(function() {
	var max_fields_email = 2; //maximum input boxes allowed
	var wrapper_email = $(".input_fields_email"); //Fields wrapper
	var add_button_email = $("#email"); //Add button ID
	
	var s= 1; //initlal text box count
	$(add_button_email).click(function(e){ //on add input button click
		e.preventDefault();
		var email = $('.add_email').val();
		if(email=='')
		{
			alert("Please enter your Email!");
		}else {
		if(s <= max_fields_email){ //max input box allowed
			s++; //text box increment
			$(wrapper_email).append('<div><input type="email" name="email" placeholder="abc@gmail.com" class="add_email"/><a href="#" class="remove_field_email"><i class="fa fa-times" aria-hidden="true"></i></a></div><div class="text_color"><?php echo $error['email'] ?></div><br>'); //add input box
		}else{
			alert("You can't enter more than 3 Email addresses!");
		}
		}
	});
	
	$(wrapper_email).on("click",".remove_field_email", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); s--;
	})
});
</script>

	<style type="text/css">
		
		body{
			background-color: #dfe4ea;
			margin:0;
		}
		#add{
			margin-top:60px;
		}
		#add1{
			height:380px;
			width:350px;
			border:1px solid black;
			margin-left: 400px;
			padding:8px;
			background-color: white;
		}
		#ar{
			font-size: 20px;
			color:black;
		}
		.a1{
			height:30px;
			width:340px;
			border:1px solid black;
		}
		.a2,.add_email{
			height:30px;
			width:300px;
			border:1px solid black;
		}
		input::-webkit-input-placeholder {
    		font-size: 25px;
    		line-height: 4;
    		color:lightgrey;
		}
		#a3{
			background-color: green;
			border-radius: 6px;
			float:right;
			height:40px;
			width:80px;
			border:1px solid black;
			color:white;
		}
		#ar1{
			margin-left: 10px;
			font-size: 20px;
		}
		#email{
			margin-left: 10px;
			font-size: 20px;
			cursor:pointer;
		}
		.remove_field,.remove_field_email {
   			 margin-left: 10px;
    		font-size: 28px;
				}
		
	</style>
</head>
<body>
<form action="rm-db.php" method="POST">
	<div id="add">
	<div id="add1">
		<a href="index.php"><i class="fa fa-arrow-left" id="ar"></i></a><?php echo " Add new contact"?><br><br>
		<?php echo "Name"?><br>
		<input type="text" name="name" placeholder="Name" class="a1" value="<?php echo $name ?>">
		<div class="text_color"><?php echo $error['name'] ?></div><br>
		
		<?php echo"DOB"?><br>
		<input type="text" name="dob" placeholder="dd/mm/yyyy" onfocus="(this.type='date')" class="a1" value="<?php echo $dob ?>">
		<div class="text_color"><?php echo $error['dob'] ?></div><br>
		
		<?php echo "Mobile Number" ?> <br>
		<div class="input_fields_wrap">
			<input type="number" min="10" name="mobile" placeholder="+91 xxxxxxxxx" class="a2" value="<?php echo $mobile ?>">
			<i class="fa fa-plus-circle" id="ar1"></i>
			<div class="text_color"><?php echo $error['mobile'] ?></div><br>
		</div>
		<?php echo "Email"?><br>
		<div class="input_fields_email">
			<input type="email" name="email" placeholder="abc@gmail.com" class="add_email" value="<?php echo $email ?>">
			<i class="fa fa-plus-circle" id="email"></i>
			<div class="text_color"><?php echo $error['email'] ?></div><br>
		</div>
		<input type="submit" name="submit" value="Save" id="a3">
	</div>
	</div>
</form>
</body>
</html>
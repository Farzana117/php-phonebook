<?php
include('rm.php');
?>
<!DOCTYPE html> 
<html> 
<head> 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(function(){
		$(".hide").hide();
		$(".show").on("click", function(){
			$(".hide").toggle();
			});
		});
	</script>
	<style>
	#dd{
		margin-top: 50px;
		width:500px;
		height:400px;
		border:1px solid black;
		margin-left: 400px;
		padding:5px;
	}
		input{
			 width: 450px;
    		padding: 5px;
    		margin: 15px;
    		height: 25px;
  			outline:none;
		}
		.search{
			position: relative; 
 			margin: 0 auto ;
  			text-align: center;
		}
		.search .fa-search { 
  			position: absolute;
  			top: 28px;
  			left: 90%;
  			font-size: 15px;
		}
		#ad{
			font-size:35px;
			
			cursor:pointer;
			color:black;
			position: absolute;
			bottom:90px;
			left:68%;
		}
		a{
			text-decoration: none;
		}
		.show {
    width: 460px;
    margin-left: 20px;
    padding: 2px;
    border: 1px solid black;
}
.show:hover {
    cursor: pointer;
}
#arrow {
    float:right;
}
.button {
    margin-left: 300px;
    padding: 10px;
}
.edit {
    color: white;
    height: 80px;
    background: blue;
    width:400px;
    border-radius: 3px;
    padding:5px;
    padding-left:10px;
    padding-right:15px;
    text-decoration: none;
}
.remove {
    text-decoration: none;
    color: white;
    width: 100%;
    border-radius: 3px; 
    padding: 5px;
    background-color: red;
}
.mbl_email {
	overflow: hidden;
    background: white;
    width: 400px;
    margin-left: 10px;
    border: 1px solid black;
    padding: 15px;
    margin-bottom: 5px;
}
.mbl_email i {
    margin-left: 13px;
}
#car{
	float:right;
	font-size: 30px;
	padding-right:10px;
}
		
	</style> 

	<script>
	function fun()
	{
		var i;
		var input=document.getElementById("srch").value;
		input=input.toLowerCase();
		var x=document.getElementsByClassName("show");
		for(i=0;i<x.length;i++)
		{
			if(x[i].innerHTML.toLowerCase().includes(input))
			{
				x[i].style.display="block";
			}
			else
			{
				x[i].style.display="none";
			}
		}
	}



	</script>
</head> 
<body>  
<div id="dd"> 
		<div class="search">
			<input name="search" id="srch" val="" onkeyup="fun()" class="input-field" type="text" placeholder="Search"><i class="fa fa-search"></i> 
		</div>
		<div>
			<?php
				$conn=mysqli_connect("localhost","root","","rm");
				$q = "SELECT * from contacts";
				$res = $conn->query($q);
				while($row = $res->fetch_assoc()){
			?>
			<div class="show">
				<p><?php echo $row['name']?><span><i class="fa fa-caret-down" id="car"></i></span></p>
				<div class="hide">
					<?php echo $row['dob'] ?>
					<div class="button">
					<a href="editcontact.php?edit=<?php echo $row['id'] ?>" class="edit">Edit</a>
					<a href="removecontact.php?delete=<?php echo $row['id'] ?>" class="remove">Remove</a>
					</div>
					<div class="mbl_email">
						<i class="fa fa-phone-square" aria-hidden="true"></i><?php echo "+91 ".$row['mobile'] ?>
						<i class="fa fa-envelope" aria-hidden="true"></i><?php echo " ".$row['email'] ?>
					</div>
				</div>
			</div>

			<?php }?>
		</div>
		<div >
			<a href="addcontact.php"><i class="fa fa-plus-circle" id="ad"></i></a>
		</div>
	</div>		
</body> 

</html> 
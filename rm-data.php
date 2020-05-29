<?php
if(isset($_POST['submit']))
{
$servername="localhost";
$username="root";
$password="";
$dbname="rm";
$name=$_POST['name'];
$dob=$_POST['dob'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
//create connection
$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn)
{
	die("Connection Failed : ".mysqli_error());
}
$tab="CREATE TABLE contacts(id INT(100) primary key auto_increment,name VARCHAR(30) NOT NULL,dob DATE NOT NULL,mobile BIGINT(10),email VARCHAR(40) NOT NULL,mobile2 BIGINT(10),mobile3 BIGINT(10),email2 VARCHAR(40),email3 VARCHAR(40))";
//if(!mysqli_query($conn,$tab))
 //echo "error"."<br>";
if(!empty($name) && !empty($dob) && !empty($mobile) && !empty($email && preg_match("/^[0-9]{10}$/",$mobile)))
$sql="INSERT INTO contacts(name,dob,mobile,email) VALUES('$name','$dob','$mobile','$email')";
if(mysqli_query($conn,$sql))
{
 ?>
 <script>
 	alert('query added!!!');
 	window.location="index.php";
</script>
<?php
}
else
{
	echo "<script>alert('fill all the fields'); window.location='addcontact.php'</script>";
}
mysqli_close($conn);
}
?>
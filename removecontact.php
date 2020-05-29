<?php
  $conn=mysqli_connect("localhost","root","","rm");
  if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $q = "DELETE from contacts where id=$id";
    if($conn->query($q)) {
        header("Location:index.php");
    }else {
        echo "Error in deleting";
    }
  }  
?>
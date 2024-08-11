<?php
$conn=mysqli_connect('localhost' ,'root','','test');
 if($conn==false){
	 die ("connection failed : ".mysqli_connect_error());
	 
	  }
	  else
	  { 
       echo "connected";
	  }
?>
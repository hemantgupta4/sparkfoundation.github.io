<?php
$dbhost='localhost';
$username='root';
$password='';
$db = 'forest management';
$link=mysqli_connect("$dbhost","$username","$password");
if(!$link)
{  echo "not connected to the server";
}

session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['plot'])) {
$error = "plot id is invalid";
}
else
{
$plot=$_POST["plot"];

$username = stripslashes($username);
$password = stripslashes($password);


$db = mysqli_select_db( $link,'forest management');
$sql = "select * from plot where P_ID='$plot'";
$query1=mysqli_query($link,$sql);
$rows = mysqli_num_rows($query1);
if ($rows) {
$_SESSION['login_user']=$plot; // Initializing Session
$conn = new mysqli("$dbhost","$username","$password","forest management");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql1 = "SELECT LOCATION,S_TYPE,NUTRIENT CONTENTS,NAME FROM plot p,soil s,staff st where pid=$plot and p.SOIL_ID=s.soil_ID and p.STAFF_ID=st.STAFF_ID" ;
$result = $conn->query($sql1);

 

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <link href="css/bootstrap-4.0.0.css" rel="stylesheet">
<style>
.active, .dot:hover {
  background-color: #717171;

table {
    width:100%;
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
    text-align: left;
}
#t01 tr:nth-child(even) {
    background-color: #eee;
}
#t01 tr:nth-child(odd) {
   background-color: #fff;
}
#t01 th {
    background-color: black;
    color: white;
}

</style>
  </head>
  <body bgcolor="lightgreen" >
<div id="example2">
<br>

<br>
<br>
<br>

            <div class="row text-center">
              <div class="text-center col-12">
                <h2>PLOT DETAILS</h2>
             </div>
               </div>

<table id="t01" border="1" align="center" style="line-height:25px;">
     <tr>
       <th>PLOT LOCATION</th>
        <th>SOIL TYPE</th>
        <th>NUTRIENT CONTENTS</th> 
        <th>STAFF NAME</th> 
        
  </tr>
   <?php
  
	    while($row =$result->fetch_assoc()){
	   ?>
	   <tr>
            <td><?php echo $row['LOCATION']; ?></td>
            <td><?php echo $row['S_TYPE']; ?></td>
            <td><?php echo $row['NUTRIENT CONTENTS']; ?></td>
            <td><?php echo $row['NAME']; ?></td>
         
            </tr>
     <?php
    }



   
   
$conn->close();
?> 
</table>
</div>
</body>
</html>
<?php
}
}
}
?>
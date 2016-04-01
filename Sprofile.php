 <?php
     session_start();
     if(!isset($_SESSION['login_user']))
{
  echo "login first";
}
     else
        {
            require_once 'include/DB_Functions.php';
     include_once("Student.html");
     $db = new DB_Functions();

                    $user = $_SESSION['login_user'];
                    $query = "SELECT  * FROM Institute_member_DB WHERE username = '$user'";
                    $result = mysql_query($query) or die("query error");
                    $query_data = mysql_fetch_array($result);
 
 ?>




<html>
   <head>
   		<title>
   			Store & Purchase
   		</title>
   	</head>	
   	<body>
   		<div class="container" >
   			 <br><br><br><br>
   			 <table class = "table">
   			 	 <tr>
                <td>
                    <b>Name : </b>
                </td>
                <td>
                    <?php
                        echo $query_data['username'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Type : </b>
                </td>
                <td>
                    <?php
                    // $query = "SELECT  * FROM Ins WHERE username = '$user'";
                    // $result = mysql_query($query) or die('queryerror');
                    // $query_data = mysql_fetch_array($result);
                    echo $query_data['type'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Programme : </b>
                </td>
                <td>
                    <?php
                    echo $query_data['branch'];
                    ?>
                </td>
            </tr>
            <tr>
              <td>
                    <b>RoomNo. : </b>
                </td>
                <td>
                    <?php
                    echo $query_data['roomNumber'];
                    ?>
                </td>
            </tr>
              </table>
    </body>
<html>    
<?php
}
?>

 <?php
     session_start();
     require_once 'include/DB_Functions.php';
     include_once("Faculty.html");
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
            <?php
              if($query_data['type']=='Faculty' || $query_data['type']== 'ClassA')
           {  ?>
            <tr>
                <td>
                    <b>Grant : </b>
                </td>
                <td>
                    <?php
                    echo $query_data['grant1'];
                    ?>
                </td>
            </tr>
         <?php }
         ?>

              </table>

    </body>
<html>    
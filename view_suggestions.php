<?php
session_start();
if(!isset($_SESSION['login_user']))
{
  echo "login first";
}
else
{
  include_once("Admin.html");
  require_once 'include/approve_deny.php';
  $notify = new approve_deny();
  ?>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Store and Purchase</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/datepicker.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery-1.9.1.min.js"></script>  
      <style type="text/css">
      </style>
    </head>
<body>
                          <br><br><br><br>
                        <div style="margin-bottom:10px" class="row"></div>
                    <?php
                    $Viewer = $_SESSION['login_user'];  
                      if(isset($_POST['clear']))
                        {
                          $ID = $_POST['ID'];
                          //$User = $_POST['User'];
                          //$Viewer = $_POST['Viewer'];
                          $username = $_POST['username'];
                          $suggestions = $_POST['suggestions'];
                          //$price= $_POST['price'];
                          //$url = $_POST['url'];
                          //$itemDetails = $_POST['itemDetails'];

                            $status="clear";
                                
                          $notify_sug=$notify->remove_suggestions($ID);
                          if($notify_sug!=true){
                            $message = "Could not remove the suggestions";
                            echo "<script type='text/javascript'>alert('$message');</script>";
                          }
                        }

                        $Ndetails=$notify->fetch_suggestions();

                        if(count($Ndetails)==0){
                          $message = "No suggestions";
                          echo "<script type='text/javascript'>alert('$message');</script>";
                        }
                    ?>
                    <div class="col-md-offset-1 col-md-10">
                        <table class="table">
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            suggestions 
                                        </th>
                                        <th>
                                            username
                                        </th>
                                    </tr>
                    <?php
                        for($i=0;$i<count($Ndetails);$i++)
                        { 
                    ?>
                        
                        
                          <table>
                          <form action="" method="post" role="form">
                          
                          
                          <tr>
                          <td width=2%><input class="form-control" name="ID" type="text" value="<?php echo $Ndetails[$i]["ID"]; ?>" size="20" readonly/></td>
                       
                          <td width=18%><input class="form-control" name="suggestions" type="text" value="<?php echo $Ndetails[$i]["suggestions"]; ?>" size="50" readonly/>
                          </td>
                             <td width=6%><input class="form-control" name="username" type="text" value="<?php echo $Ndetails[$i]["username"]; ?>" size="50" readonly/></td>  
                          <td width=10%> <button style="width:45%" type="submit" name="clear" class="btn btn-success">clear</button> </td>
                          </tr>
                         
                          </form>
                          </table>
                          <br>
                    <?php
                      }
                    ?>
                  </table>
                      </div>
</body>
</html>
<?php
}
?>
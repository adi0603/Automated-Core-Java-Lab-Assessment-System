<?php
session_start();
if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
{
require 'connect.php';
$userid=$_SESSION['userid'];
$result = mysqli_query($con,'select * from faculty where faculty_id='.$userid.'');
$fetch=mysqli_fetch_array($result);
$error=-1;
  if(isset($_POST['submit']))
  {
    $password1=$_POST['password1'];
    $password2= $_POST['password2'];
    if ($password1==$password2) {
      $result = mysqli_query($con,'update faculty set password="'.$password1.'" where faculty_id="'.$userid.'"');
      $error=1;
    }
    else
    {
      $error=0;
    }
  }
  if(isset($_POST['logout']))
  {
    session_destroy();
    header('Location: index.php');
  }
}
else
{
  header('Location: index.php'); 
}
?>
<html>
  <head>
    <title>Automated Lab Assessment System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/java.ico"/>
  <link rel="stylesheet" type="text/css" href="css/info.css">
  <script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  </head>
  <body>
    <?php
    if ($error==1)
    {?>
      <script type="text/javascript">
            swal("Congrats!", "You Password is sucessfully Updated!", "success");
          </script>
      <?php
    }
    elseif($error==0)
    {?>
      <script type="text/javascript">
          swal("Sorry!", "Password mismatched!", "error");
        </script>
      <?php
      $error=-1;
    }
    ?>
    <div class="wrapper">
      <header class="page-header">
        <nav>
          <h2 class="logo">ACJLAS</h2>
          <ul>
            <li>
              <a href="faculty.php">Home</a>
            </li>
            <li>
              <a href="compilerf.php">Compiler</a>
            </li>
            <li>
              <a href="uploadassignment.php">Assignment</a>
            </li>
            <li>
              <a href="studentsmarks.php">Marks</a>
            </li>
            <li>
              <a href="fnotes.php">Notes</a>
            </li>
            <li>
              <a href="facultyteam.php">About</a>
            </li>
          </ul>
          <button class="cta-contact" onclick="location.href='facultyinfo.php'"><i class="fas fa-cog"></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      
      <main class="page-main">
        <div class="container">
          <table>
            <caption>Info</caption>
            <tbody>
              <tr>
                <td>Name</td>
                <td><?php echo $fetch['name'];?></td>
              </tr>
              <tr>
                <td>Email</td>
                <td><?php echo $fetch['email'];?></td>
              </tr>
              <tr>
                <td>Subject</td>
                <td><?php echo $fetch['subject'];?></td>
              </tr>
              <tr>
                <td>Lab</td>
                <td><?php echo $fetch['lab'];?></td>
              </tr>
              <tr>
                <td>Change Password</td>
                <td>
                  <form method="POST" action="">
                    <div class="textbox">
                      <input type="password" name="password1" placeholder="New Password" class="nice" required>&nbsp;
                      <input type="password" name="password2" placeholder="Confirm Password" class="nice" required><br>
                      <div class="logout">
                        <input type="submit" name="submit" value="Submit">
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="logout">
                    <form  method="POST">
                      <input type="submit" name="logout" value="Logout">
                    </form>                    
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>

<?php
session_start();
if($_SESSION['userid'] == "")
{
  header('Location: index.php');
}
require 'connect.php';
$userid=$_SESSION['userid'];
$result = mysqli_query($con,'select * from admin where admin_id='.$userid.'');
$fetch=mysqli_fetch_array($result);
$error=-1;
if(isset($_POST['submit']))
{
    $id= $_POST['id'];
    $name= $_POST['name'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $subject=$_POST['subject'];
    $lab=$_POST['lab'];
    $result1 = mysqli_query($con,'select * from faculty where faculty_id="'.$id.'"');
    if(mysqli_num_rows($result1)==0)
    {
        $result = mysqli_query($con,"INSERT into faculty (faculty_id,name,email,password,subject,lab) values ('$id','$name','$email','$password','$subject','$lab')");
        $error=1;
    }
    else
    {
        $error=0;
    }
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
            swal("Congrats!", "Faculty added successfully!", "success");
          </script>
      <?php
    }
    elseif($error==0)
    {?>
      <script type="text/javascript">
          swal("Sorry!", "Faculty already exists!", "error");
        </script>
      <?php
      $error=-1;
    }
    ?>
    <style type="text/css">
      .labs select {
  border: 0 !important;  
  background-color : blue;
  border-radius: 20px;
  width: 150px; 
  text-decoration: none;
  color: #fff;
  font-weight: bold;
  letter-spacing: 0.1px; 

  color: white;
  
  padding: 8px;
  border:1px solid gray !important;
}
.labs select:focus {
  outline: none;
}
    </style>
    <div class="wrapper">
      <header class="page-header">
        <nav>
          <h2 class="logo">ACJLAS</h2>
          <ul>
            <li>
              <a href="admin.php">Home</a>
            </li>
            <li>
              <a href="facultylist.php">Faculty</a>
            </li>
            <li>
              <a href="question.php">Question</a>
            </li>
            <li>
              <a href="adminteam.php">About</a>
            </li>
          </ul>
          <button class="cta-contact" onclick="location.href='admininfo.php'"><i class="fas fa-cog"></i></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      
      <main class="page-main">
        <div class="container">
          <a href="facultylist.php" style="color: black;"><i class="fas fa-chevron-left"></i>&nbsp;Back</a>
          <table>
            <caption>Add Faculty</caption>
            <tbody>
              <form method="POST">
                <tr>
                  <td>Faculty Id</td>
                  <td>
                    <div class="textbox">
                      <input type="number" name="id" placeholder="Enter Faculty Id" class="nice" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Name</td>
                  <td>
                    <div class="textbox">
                      <input type="text" name="name" placeholder="Enter Name" class="nice" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>
                    <div class="textbox">
                      <input type="email" name="email" placeholder="Enter Email" class="nice" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Password</td>
                  <td>
                    <div class="textbox">
                      <input type="password" name="password" placeholder="Enter Password" class="nice" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Subject</td>
                  <td>
                    <div class="textbox">
                      <input type="text" name="subject" placeholder="Enter subject" class="nice" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Lab</td>
                  <td>
                    <div class="labs">
                      <select name="lab">
                        <option value="Lab 1">Lab 1</option>
                        <option value="Lab 2">Lab 2</option>
                        <option value="Lab 3">Lab 3</option>
                        <option value="Lab 4">Lab 4</option>
                        <option value="Lab 5">Lab 5</option>
                        <option value="Lab 6">Lab 6</option>
                      </select>
                    </div>
                  </td>
                </tr>
                <td colspan="2">
                  <div class="logout">
                    <input type="submit" name="submit" value="Submit">                    
                  </div>
                </td>
              </form>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>

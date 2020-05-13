<?php
$lablist=array("Lab 1","Lab 2","Lab 3","Lab 4","Lab 5","Lab 6");
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
$id="";
$name="";
$email="";
$subject="";
$lab="";
if(isset($_POST['selectstudent']))
{
    $id= $_POST['id'];
    $result1 = mysqli_query($con,'select * from student where student_id="'.$id.'"');
    $fetch1=mysqli_fetch_array($result1);
    $name=$fetch1['name'];
    $email=$fetch1['email'];
    $subject=$fetch1['subject'];
    $lab=$fetch1['lab'];
    $_SESSION['id']=$id;
}
if(isset($_POST['modify']))
{
    $id1=$_SESSION['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $lab=$_POST['lab'];
    $result5 = mysqli_query($con,'update student set name="'.$name.'",email="'.$email.'",subject="'.$subject.'",lab="'.$lab.'" where student_id="'.$id1.'"');
    $name="";
    $email="";
    $subject="";
    $lab="";
    $error=1;
}
if(isset($_POST['remove']))
{
  $id1=$_SESSION['id'];
  $result6 = mysqli_query($con,'delete from student where student_id="'.$id1.'"');
  $result7 = mysqli_query($con,'delete from marks where student_id="'.$id1.'"');
  $result8 = mysqli_query($con,'delete from assignment where student_id="'.$id1.'"');
  $error=2;
  $name="";
  $email="";
  $subject="";
  $lab="";
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
            swal("Congrats!", "Student data has been modified successfully!", "success");
          </script>
      <?php
      $error=-1;
    }
    elseif ($error==2) {
      ?>
      <script type="text/javascript">
            swal("Congrats!", "Student data has been deleted successfully!", "success");
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
              <a href="studentlist.php">Student</a>
            </li>
            <li>
              <a href="question.php">Question</a>
            </li>
            <li>
              <a href="adminteam.php">About</a>
            </li>
          </ul>
          <button class="cta-contact" onclick="location.href='facultyinfo.php'"><i class="fas fa-cog"></i></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      
      <main class="page-main">
        <div class="container">
          <a href="studentlist.php" style="color: black;"><i class="fas fa-chevron-left"></i>&nbsp;Back</a>
          <table>
            <caption>Modify / Remove Student Data</caption>
            
            <tbody>
              <form method="POST">
                <th>Select faculty Id</th>
                <th>
              <div class="labs">
                
              <select name="id">
                <?php
                  $result3 = mysqli_query($con,'select * from student');
                  if (mysqli_num_rows($result3) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_array($result3)) {
                      ?>
                        <option value="<?php echo $row['student_id'];?>"><?php echo $row['student_id'];?></option>
                      <?php
                    }
                }?>
              </select>
            
            </div>
            </th>
            <th>
            <div class="logout">
              
              <input type="submit" name="selectstudent" value="Select">                  
            </div>
          </th>
            </form>
              <form method="POST">
                <tr>
                  <td>Faculty Id</td>
                  <td colspan="2">
                    <div class="textbox">
                      <input type="number" name="id1"  class="nice" value="<?php echo $id;?>" disabled>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Name</td>
                  <td colspan="2">
                    <div class="textbox">
                      <input type="text" name="name" class="nice" value="<?php echo $name;?>" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td colspan="2">
                    <div class="textbox">
                      <input type="email" name="email" class="nice" value="<?php echo $email;?>" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Subject</td>
                  <td colspan="2">
                    <div class="textbox">
                      <input type="text" name="subject" class="nice" value="<?php echo $subject;?>" required>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Lab</td>
                  <td colspan="2">
                    <div class="labs">
                      <select name="lab">
                        <?php
                          for ($i=0; $i <5 ; $i++) {
                            if ($lab==$lablist[$i]) {
                              ?>
                              <option value="<?php echo $lablist[$i];?>" selected><?php echo $lablist[$i];?></option>
                              <?php
                            }
                            else
                            {
                              ?>
                              <option value="<?php echo $lablist[$i];?>"><?php echo $lablist[$i];?></option>
                              <?php
                            }
                          }
                          ?>
                      </select>
                    </div>
                  </td>
                </tr>
                <td colspan="3">
                  <div class="logout">
                    <input type="submit" name="modify" value="Modify">&nbsp;
                    <input type="submit" name="remove" value="Remove">         
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

<?php
session_start();
$found=0;
$error=-1;
$selecttopic="";
if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
{
  
  require 'connect.php';
  $userid=$_SESSION['userid'];
  $result = mysqli_query($con,'select * from faculty where faculty_id='.$userid.'');
  $fetch=mysqli_fetch_array($result);
  if (isset($_POST['selecttopic'])) {
      $found=1;
      $selecttopic=$_POST['id'];
      $_SESSION['selecttopic']=$selecttopic;
  }
  if (isset($_POST['upload'])) {
    $q1="";
    $q2="";
    $q3="";
    $questions=array();
    $checkbox1 = $_POST['chk'] ;
    $date=$_POST['date'];
    $lab=$fetch['lab'];  
    for ($i=0; $i<sizeof($checkbox1);$i++) {  
      $questions[$i]= $checkbox1[$i];
      if ($i==0) {
        $q1=$questions[$i];
      }
      elseif ($i==1) {
        $q2=$questions[$i];
      }
      elseif ($i==2) {
        $q3=$questions[$i];
      }
    }
    $result5=mysqli_query($con,"Select count(assign_id) from assignment");
    $fetch5=mysqli_fetch_array($result5);
    $assign_id= $fetch5['count(assign_id)']+1;
    //if ($q1!=""||$q2!=""||$q3!="") {
      $result4 = mysqli_query($con,"INSERT INTO assignment (assign_id,q1, q2, q3, lab, date1) VALUES ('$assign_id','$q1', '$q2', '$q3', '$lab','$date')");
      $error=1;

      $result6=mysqli_query($con,"Select student_id from student");
      if (mysqli_num_rows($result6) > 0) {
        while($row = mysqli_fetch_array($result6)) {
          $student_id=$row['student_id'];
          if ($q1!="") {
            $result7 = mysqli_query($con,"INSERT into marks (student_id,ques_id) values ('$student_id','$q1')");
          }
          if ($q2!="") {
            $result7 = mysqli_query($con,"INSERT into marks (student_id,ques_id) values ('$student_id','$q2')");
          }
          if ($q3!="") {
            $result7 = mysqli_query($con,"INSERT into marks (student_id,ques_id) values ('$student_id','$q3')");
          }
        }
      }

    // }
    // else
    // {
    //   $error=0;
    // }
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
    <link rel="stylesheet" type="text/css" href="css/question.css">
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
            swal("Congrats!", "Assignment uploaded sucessfully!", "success");
          </script>
      <?php
      $error=-1;
    }
    elseif($error==0)
    {?>
      <script type="text/javascript">
          swal("Sorry!", "Something went wrong. Try Again!", "error");
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
          <button class="cta-contact" onclick="location.href='facultyinfo.php'"><i class="fas fa-cog"></i></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      <style type="text/css">
        .upload input[type="checkbox"] {
            border: 0 !important;  
            background-color : white;
            height: 20px;
            width: 20px;
            color: #fff;
          }
      </style>
      <main class="page-main">
        <div class="container">
          <table>
            <caption>Assignment</caption>
            <tbody>
              <form method="POST">
              <tr>
                <td>
                  Select Topic
                </td>
                <td>
                  <div class="labs">
              <select name="id">
                <?php
                  $result3 = mysqli_query($con,'select topic from question Group By topic');
                  if (mysqli_num_rows($result3) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_array($result3)) {
                      ?>
                        <option value="<?php echo $row['topic'];?>"><?php echo $row['topic'];?></option>
                      <?php
                    }
                }?>
              </select>
            
            </div>
                </td>
                <td>
                  <div class="logout">
                    <input type="submit" name="selecttopic" value="Select">                  
                  </div>
                </td>
              </tr>
            </form>
              <form method="POST">
              <tr>
                <td colspan="3">
                  Questions:<br><br>
                  <div class="upload">
                  <?php
                  if($found==1){
                    $result1 = mysqli_query($con,'select ques_id,ques from question where topic ="'.$selecttopic.'"');
                  if (mysqli_num_rows($result1) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_array($result1)) {
                      ?>
                        <input type="checkbox" name="chk[]" value="<?php echo $row['ques_id'];?>">&nbsp;<?php echo $row['ques'];?><br>
                      <?php
                    }
                }}?>
                </div>
                </td>
              </tr>
              <tr>
                <td colspan="1">
                  End Date :
                </td>
                <td colspan="2">
                  <?php
                    $date=date("Y")."-".date("m")."-".date("d");
                  ?>
                  <input type="date" name="date" min='<?php echo $date ?>' title="Select end date of assignment" required>
                </td>
              </tr>
              <tr>
                <td colspan="1">
                  Lab :
                </td>
                <td colspan="2">
                  <?php echo $fetch['lab'];?>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <div class="logout">
                    <input type="submit" name="upload" value="Upload">                  
                  </div>
                </td>
              </tr>
            </form>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>

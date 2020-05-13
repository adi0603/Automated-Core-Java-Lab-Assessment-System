<?php
session_start();
if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
{
  require 'connect.php';
  $userid=$_SESSION['userid'];
  $result = mysqli_query($con,'select * from faculty where faculty_id='.$userid.'');
  $fetch=mysqli_fetch_array($result);
  $found=0;
  $selectStudent="";
  $selectQuestion="";
  if (isset($_POST['selectStudent'])) {
      $selectStudent=$_POST['id'];
      $selectQuestion=$_POST['ques'];
      if ($selectStudent!="Select Student" && $selectQuestion=="Select Question") {
        $found=1;
      }
      elseif ($selectStudent=="Select Student" && $selectQuestion!="Select Question") {
        $found=2;
      }
      //$_SESSION['selecttopic']=$selecttopic;
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
  </head>
  <body>
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
      <main class="page-main">
        <div class="container">
          <table>
            <caption>Marks List</caption>
            <tbody>
              <form method="POST">
                <tr>
                  <td>Select Student and Question</td>
                  <td>
                    <div class="labs">
                      <select name="id">
                        <option value="Select Student">Select Student</option>
                      <?php
                        $result3 = mysqli_query($con,'select student_id from marks Group By student_id');
                        if (mysqli_num_rows($result3) > 0) {
                          while($row = mysqli_fetch_array($result3)) {
                          ?>
                            <option value="<?php echo $row['student_id'];?>"><?php echo $row['student_id'];?></option>
                            <?php
                          }
                        }?>
                      </select>
                    </div>
                  </td>
                  <td colspan="2">
                    <div class="labs">
                      <select name="ques">
                        <option value="Select Question">Select Question</option>
                      <?php
                        $result3 = mysqli_query($con,'select ques_id from marks Group By ques_id');
                        if (mysqli_num_rows($result3) > 0) {
                          while($row = mysqli_fetch_array($result3)) {
                            $ques_id=$row['ques_id'];
                            $result4 = mysqli_query($con,"select ques from question ques_id where ques_id='$ques_id'");
                            $fetch4=mysqli_fetch_array($result4);
                          ?>
                            <option value="<?php echo $row['ques_id'];?>"><?php echo $fetch4['ques'];?></option>
                            <?php
                          }
                        }?>
                      </select>
                    </div>
                  </td>
                  <td>
                    <div class="logout">
                      <input type="submit" name="selectStudent" value="Select">                  
                    </div>
                  </td>
                </tr>
              </form>
                <tr>
                  <th>Roll No.</th>
                  <th>Name</th>
                  <th>Question</th>
                  <th>Marks</th>
                  <th>Status</th>
                </tr>
                <?php
                  if ($found==1) {
                    $result5 = mysqli_query($con,"select student_id,name from student where student_id='$selectStudent'");
                    if (mysqli_num_rows($result5) > 0) {
                      while($row = mysqli_fetch_array($result5)) {
                        $result6 = mysqli_query($con,"select ques,marks,status from question join marks where student_id='$selectStudent' and question.ques_id = marks.ques_id");
                        if (mysqli_num_rows($result6) > 0) {
                          while($row1 = mysqli_fetch_array($result6)) {
                        ?>
                          <tr>
                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row1['ques']; ?></td>
                            <td><?php echo $row1['marks']; ?></td>
                            <td>
                              <?php
                              if ($row1['status']==1) {
                                echo "Completed";
                              }
                              else
                              {
                                echo "Pending";
                              }
                              ?>
                            </td>
                          </tr>
                        <?php
                      }
                    }
                      }
                    }
                  }
                  elseif ($found==2) {
                    $result7 = mysqli_query($con,"select student_id from marks where ques_id='$selectQuestion'");
                    if (mysqli_num_rows($result7) > 0) {
                      while($row = mysqli_fetch_array($result7)) {
                        $student_id=$row['student_id'];
                        $result8 = mysqli_query($con,"SELECT * FROM marks join student join assignment join question where student.student_id='$student_id' and question.ques_id='$selectQuestion' and marks.ques_id='$selectQuestion' and marks.student_id='$student_id' and (assignment.q1='$selectQuestion' or assignment.q2='$selectQuestion' or assignment.q3='$selectQuestion')");
                        if (mysqli_num_rows($result8) > 0) {
                          while($row1 = mysqli_fetch_array($result8)) {
                        ?>
                          <tr>
                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row1['name']; ?></td>
                            <td><?php echo $row1['ques']; ?></td>
                            <td><?php echo $row1['marks']; ?></td>
                            <td>
                              <?php
                              $date=date("Y")."-".date("m")."-".date("d");
                              if ($row1['status']==1) {
                                echo "Completed";
                              }
                              elseif ($row1['date1']<=$date) {
                                echo "Expired";
                              }
                              else
                              {
                                echo "Pending";
                              }
                              ?>
                            </td>
                          </tr>
                        <?php
                      }
                    }
                      }
                    }
                  }
                ?>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>

<?php
session_start();
if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
{
  if(isset($_SESSION['userid']))
  {
    unset($_SESSION['ques_id']);
  }
  require 'connect.php';
  $userid=$_SESSION['userid'];
  $result = mysqli_query($con,'select * from student where student_id='.$userid.'');
  $fetch=mysqli_fetch_array($result);
  $date=date("Y")."-".date("m")."-".date("d");
  $result3=mysqli_query($con,"select ques_id from assignment join question where (q1=ques_id or q2=ques_id or q3=ques_id) and  date1>='$date'");
  $queslist=array();
  $i=0;
  if (mysqli_num_rows($result3) > 0) {
    while($row = mysqli_fetch_array($result3)) {
      $queslist[$i]=$row['ques_id'];
      $i++;
    }
  }
  for ($j=0; $j < $i; $j++) {
    if(isset($_POST[$queslist[$j]]))
    {
      $_SESSION['ques_id']=$queslist[$j];
      header('Location: solveassignment.php');
    }
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
    <link rel="stylesheet" type="text/css" href="css/assignment.css">
    <script src="https://kit.fontawesome.com/ab99e84824.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  </head>
  <body>
    <div class="wrapper">
      <header class="page-header">
        <nav>
          <h2 class="logo">ACJLAS</h2>
          <ul>
            <li>
              <a href="student.php">Home</a>
            </li>
            <li>
              <a href="compiler.php">Compiler</a>
            </li>
            <li>
              <a href="assignment.php">Assignment</a>
            </li>
            <li>
              <a href="notes.php">Notes</a>
            </li>
            <li>
              <a href="studentteam.php">About</a>
            </li>
          </ul>
          <button class="cta-contact" onclick="location.href='studentinfo.php'"><i class="fas fa-cog"></i></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      <main class="page-main">
        <div class="container">
          <table>
            <caption>Assignments</caption>
            <tbody>
              <th colspan="3">Question</th>
              <th>Input</th>
              <th>Output</th>
              <th>Last Date</th>
              <th>Marks Obtained</th>
              <th>Status</th>
              <form method="POST">
                <?php
                  $result2 = mysqli_query($con,"select * from assignment join question where q1=ques_id or q2=ques_id or q3=ques_id");
                  if (mysqli_num_rows($result2) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_array($result2)) {
                      $value="";
                      $disabled="";
                      if($date>$row['date1'])
                      {
                        $value= 'Expired';
                        $disabled='disabled';
                      }
                      else
                      {
                        $value= 'Pending';
                      }
                      ?>
                        <tr>
                          <td colspan="3"><?php echo $row['ques'];?></td>
                          <td><pre><?php echo $row["input"];?></pre></td>
                          <td><pre><?php echo $row["output"];?></pre></td>
                          <td><?php echo $row['date1'];?></td>
                          <td>
                            <?php
                              $ques_id=$row['ques_id'];
                              $result5 = mysqli_query($con,"select * from marks where student_id='$userid' and ques_id='$ques_id'");
                              if (mysqli_num_rows($result5) > 0) {
                                $fetch5=mysqli_fetch_array($result5);
                                if($fetch5['status']==1 && $fetch5['marks']>0){
                                  echo $fetch5['marks'];
                                  $value="Solved";
                                  $disabled="disabled";
                                }
                                else
                                {
                                  echo "---";
                                }
                              }
                              else
                              {
                                echo "---";
                              }
                            ?>
                          </td>
                          <td>
                            <div class="logout">
                              <input type="submit" name="<?php echo $row['ques_id'];?>" value="<?php echo $value; ?>" <?php echo $disabled; ?>>             
                            </div>
                          </td>
                        </tr>
                      <?php
                    }
                }?>
              </form>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>

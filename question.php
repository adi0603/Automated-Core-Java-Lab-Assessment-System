<?php
session_start();
if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
{
  
  require 'connect.php';
  $userid=$_SESSION['userid'];
  $result = mysqli_query($con,'select * from admin where admin_id='.$userid.'');
  $fetch=mysqli_fetch_array($result);
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
  <script type="text/javascript" src="js/printlist.js"></script>
  </head>
  <body>
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
          <button class="cta-contact" onclick="location.href='admininfo.php'"><i class="fas fa-cog"></i></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      
      <main class="page-main">
        <div class="container">
          <table>
            <caption>Questions</caption>
            <tbody>
              <th colspan="3">Question</th>
              <th>Input Value</th>
              <th>Output Value</th>
              <th>Topic</th>
              <?php
                $result1 = mysqli_query($con,'select * from question');
                if (mysqli_num_rows($result1) > 0) {
                  // output data of each row
                  while($row = mysqli_fetch_array($result1)) {
                    ?>
                    <tr>
                      <td colspan="3"><?php echo $row["ques"];?></td>
                      <td><pre><?php echo $row["input"];?></pre></td>
                      <td><pre><?php echo $row["output"];?></pre></td>
                      <td><?php echo $row["topic"];?></td>
                    </tr>
                    <?php
                  }
                } 
              ?>
            </tbody>
          </table><br>
          <center>
            <div class="logout">
              <input type="submit" name="logout" onclick="location.href='addquestion.php'" value="Add Question">                  
            </div><br>
            <a href="javascript:void(0);" onclick="printPage();" style="color: black;" title="Print this table"><i class="fas fa-print"></i></a>
          </center>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>

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
?>
<html>
  <head>
    <title>Automated Lab Assessment System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/java.ico"/>
    <link rel="stylesheet" type="text/css" href="css/info.css">
    <script src="https://kit.fontawesome.com/ab99e84824.js"></script>
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
          <button class="cta-contact" onclick="location.href='admininfo.php'"><i class="fas fa-cog"></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      
      <main class="page-main">
        <div class="container">
          <table>
            <caption>Faculty List</caption>
            <tbody>
              <th>Id</th>
              <th>Name</th>
              <th>Email Id</th>
              <th>Subject</th>
              <th>Lab</th>
              <?php
                $result1 = mysqli_query($con,'select * from faculty');
                if (mysqli_num_rows($result1) > 0) {
                  // output data of each row
                  while($row = mysqli_fetch_array($result1)) {
                    ?>
                    <tr>
                      <td><?php echo $row["faculty_id"];?></td>
                      <td><?php echo $row["name"];?></td>
                      <td><?php echo $row["email"];?></td>
                      <td><?php echo $row["subject"];?></td>
                      <td><?php echo $row["lab"];?></td>
                    </tr>
                    <?php
                  }
                } 
              ?>
            </tbody>
          </table>
          <br>
          <center>
            <div class="logout">
              <input type="submit" name="logout" onclick="location.href='addfaculty.php'"  value="Add">&nbsp;
              <input type="submit"  onclick="location.href='modifyfaculty.php'" value="Modify / Remove">                  
            </div><br>
            <a href="javascript:void(0);" onclick="printPage();" style="color: black;" title="Print this table"><i class="fas fa-print"></i></a>
          </center>
        </div>
      </main>
    </div>
  </body>
</html>

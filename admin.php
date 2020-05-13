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
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <script src="https://kit.fontawesome.com/ab99e84824.js"></script>
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
            <caption>Welcome To Automated Core Java Lab Assessment System</caption>
            <tbody>
              <tr>
                <td><img src="images/welcome.png" alt="Welcome Image" width="95%" height="95%" class="center">
                <img src="images/gla2.jpg" alt="Welcome Image" width="95%" height="88%" class="center">
              <img src="images/system.jpg" alt="Welcome Image" width="95%" height="95%" class="center"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("center");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) { myIndex = 1 }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 3000); 
        }
    </script>
  </body>
</html>

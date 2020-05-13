<?php
session_start();
if($_SESSION['userid'] == "")
{
  header('Location: index.php');
}
require 'connect.php';
$userid=$_SESSION['userid'];
$result = mysqli_query($con,'select * from faculty where faculty_id='.$userid.'');
$fetch=mysqli_fetch_array($result);
?>
<html>
  <head>
    <title>Automated Lab Assessment System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/java.ico"/>
    <link rel="stylesheet" type="text/css" href="css/about.css">
    <script src="https://kit.fontawesome.com/ab99e84824.js"></script>
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
          <button class="cta-contact" onclick="location.href='facultyinfo.php'"><i class="fas fa-cog"></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      
      <main class="page-main">
        <div class="container">
          <table>
            <caption>About Us</caption>
            <tbody>
              <tr>
                <td title="Mentor">
                  <img src="images/team/sachinsir.jpg" alt="Mr. Sachin Sharma" style="border-radius: 50%;width: 75%;display: block;margin-left: auto;margin-right: auto;"><i class="fas fa-user-tie"></i>&nbsp;Mr. Sachin Sharma<br><i class="fas fa-at"></i>&nbsp;sachin.sharma@gla.ac.in<br><i class="fas fa-mobile-alt"></i>&nbsp;9837274741
                </td>
                <td>
                  <img src="images/team/adityapa.jpg" alt="Aditya Pandey" class="center"><i class="fas fa-user-tie"></i>&nbsp;Aditya Pandey<br><i class="fas fa-at"></i>&nbsp;aditya.pandey_bca17@gla.ac.in<br><i class="fas fa-mobile-alt"></i>&nbsp;8052537672
                </td>
                <td>
                  <img src="images/team/akarsh.jpg" alt="Akarsh Singh Bhadoriya" class="center">
                  <i class="fas fa-user-tie"></i>&nbsp;Akarsh Singh Bhadoriya<br><i class="fas fa-at"></i>&nbsp;akarsh.bhadoriya_bca17@gla.ac.in<br><i class="fas fa-mobile-alt"></i>&nbsp;7390873632
                </td>
              </tr>
              <tr>
                <td>
                  <img src="images/team/adityatri.jpg" alt="Aditya Trivedi" class="center">
                  <i class="fas fa-user-tie"></i>&nbsp;Aditya Trivedi<br><i class="fas fa-at"></i>&nbsp;aditya.trivedi_bca17@gla.ac.in<br><i class="fas fa-mobile-alt"></i>&nbsp;8864809020
                </td>
                <td>
                  <img src="images/team/aparna.jpg" alt="Aparna Singh" class="center">
                  <i class="fas fa-user-tie"></i>&nbsp;Aparna Singh<br><i class="fas fa-at"></i>&nbsp;aparna.singh_bca17@gla.ac.in<br><i class="fas fa-mobile-alt"></i>&nbsp;9097198176
                </td>
                <td>
                  <img src="images/team/adarsh.jpg" alt="Adarsh Saraswat" class="center">
                  <i class="fas fa-user-tie"></i>&nbsp;Adarsh Saraswat<br><i class="fas fa-at"></i>&nbsp;adarsh.saraswat_bca17@gla.ac.in<br><i class="fas fa-mobile-alt"></i>&nbsp;859110620
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </body>
</html>

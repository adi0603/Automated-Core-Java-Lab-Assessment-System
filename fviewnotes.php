<?php
session_start();
if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
{
  $error=-1;
  require 'connect.php';
  $userid=$_SESSION['userid'];
  $result = mysqli_query($con,'select * from faculty where faculty_id='.$userid.'');
  $fetch=mysqli_fetch_array($result);
  $topic=$_SESSION['topic'];
  $result1 = mysqli_query($con,"select * from studentnotes where student_id='$userid' and topic='$topic'");
  $fetch1=mysqli_fetch_array($result1);

  if (isset($_POST['update'])){
    $notes=$_POST['notes'];
    $result2=mysqli_query($con,"update studentnotes set notes='$notes' where $topic='$topic' and student_id='$userid'");
    $error=1;
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
            swal("Congrats!", "Notes uploaded sucessfully!", "success");
          </script>
      <?php
      $error=-1;
    }?>
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
          <a href="fnotes.php" style="color: black;"><i class="fas fa-chevron-left"></i>&nbsp;Back</a>
          <table>
            <caption>Notes</caption>
            <tbody>
              <form method="POST">
                <tr>
                  <td colspan="3">
                    Topic<br><br>
                    <div class="textbox">
                      <textarea name="topic" class="nice" rows="1" cols="110" style="resize: none;" data-role="none" disabled><?php echo $fetch1['topic']; ?></textarea>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Your Notes<br><br>
                    <div class="textbox">
                      <textarea name="notes" class="nice" rows="30" cols="110" style="resize: none;" data-role="none" placeholder="Write your notes"><?php echo $fetch1['notes']; ?></textarea>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <div class="logout">
                      <input type="submit" name="update" value="Update">                
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

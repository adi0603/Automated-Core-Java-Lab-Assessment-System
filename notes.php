<?php
session_start();
if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
{
  $error=-1;
  require 'connect.php';
  $userid=$_SESSION['userid'];
  $result = mysqli_query($con,'select * from student where student_id='.$userid.'');
  $fetch=mysqli_fetch_array($result);
  if (isset($_POST['upload'])) {
    $topic=$_POST['topic'];
    $notes=$_POST['notes'];
    $result = mysqli_query($con,"INSERT into studentnotes (topic,notes,student_id) values ('$topic','$notes','$userid')");
    $error=1;
  }
  if (isset($_POST['selecttopic'])) {
    $topic=$_POST['id2'];
    $_SESSION['topic']=$topic;
    header('Location: viewnotes.php'); 
  }
  if (isset($_POST['stopic'])) {
    $topic=$_POST['id1'];
    $result3 = mysqli_query($con,"select * from notes where topic='$topic'");
    $fetch3=mysqli_fetch_array($result3);
    $notes=$fetch3['note'];
    ?>
    <script type="text/javascript">
      window.open('<?php echo $notes;?>', '_blank', 'fullscreen=yes');
    </script>
    <?php
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
            swal("Congrats!", "Notes added sucessfully!", "success");
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
            <caption>Notes</caption>
            <tbody>
              <form method="POST">
                <tr>
                  <td>Select Topic</td>
                  <td>
                    <div class="labs">
                      <select name="id1">
                      <?php
                        $result1 = mysqli_query($con,'select topic from notes');
                        if (mysqli_num_rows($result1) > 0) {
                          while($row = mysqli_fetch_array($result1)) {
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
                      <input type="submit" name="stopic" value="Select">                  
                    </div>
                  </td>
                </tr>
              </form>
              <form method="POST">
                <tr>
                  <td>Select Topic of your own notes</td>
                  <td>
                    <div class="labs">
                      <select name="id2">
                      <?php
                        $result2 = mysqli_query($con,"select topic from studentnotes where student_id='$userid'");
                        if (mysqli_num_rows($result2) > 0) {
                          while($row = mysqli_fetch_array($result2)){
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
                    Add New Topic<br><br>
                    <div class="textbox">
                      <textarea name="topic" class="nice" rows="1" cols="110" style="resize: none;" data-role="none" placeholder="Write topic of your note"></textarea>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    Add New Notes<br><br>
                    <div class="textbox">
                      <textarea name="notes" class="nice" rows="30" cols="110" style="resize: none;" data-role="none" placeholder="Write your notes"></textarea>
                    </div>
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

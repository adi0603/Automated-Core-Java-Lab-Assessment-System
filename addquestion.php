<?php
session_start();
if(isset($_SESSION['userid']) && $_SESSION['userid'] != "")
{
  
  require 'connect.php';
  $userid=$_SESSION['userid'];
  $result = mysqli_query($con,'select * from admin where admin_id='.$userid.'');
  $fetch=mysqli_fetch_array($result);
  $error=-1;
  if(isset($_POST['upload']))
  {
    $id=$_POST['id'];
    $ques= $_POST['ques'];
    $input=$_POST['input'];
    $output= $_POST['output'];
    $topic=$_POST['topic'];
    $result1 = mysqli_query($con,'select * from question where ques_id="'.$id.'"');
    if(mysqli_num_rows($result1)==0)
    {
      $result = mysqli_query($con,"INSERT into question (ques_id,ques,input,output,topic) values ('$id','$ques','$input','$output','$topic')");
      $error=1;
    }
    else
    {
      $error=0;
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
            swal("Congrats!", "Question added sucessfully!", "success");
          </script>
      <?php
      $error=-1;
    }
    elseif ($error==0)
    {?>
      <script type="text/javascript">
            swal("Oops!", "Question id already exists!", "error");
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
              <a href="admin.php">Home</a>
            </li>
            <li>
              <a href="facultylist.php">Faculty</a>
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
            <caption>Add Question</caption>
            <tbody>
              <form method="POST">
              <tr>
                <td colspan="1">Question Id</td>
                <td colspan="2">
                  <div class="textbox">
                    <textarea name="id" class="nice" rows="1" cols="60" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" style="resize: none;" data-role="none" placeholder="Enter question id in number"></textarea>
                </div>
                </td>
              </tr>
              <tr>
                <td colspan="1">Question</td>
                <td colspan="2">
                  <div class="textbox">
                    <textarea name="ques" class="nice" rows="1" cols="60" style="resize: none;" data-role="none" placeholder="Enter question"></textarea>
                </div>
                </td>
              </tr>
              <tr>
                <td colspan="1">Input</td>
                <td colspan="2">
                  <div class="textbox">
                    <textarea name="input" class="nice" rows="8" cols="60" style="resize: none;" data-role="none" placeholder="Enter input value"></textarea>
                </div>
                </td>
              </tr>
              <tr>
                <td colspan="1">Output</td>
                <td colspan="2">
                  <div class="textbox">
                    <textarea name="output" class="nice" rows="8" cols="60" style="resize: none;" data-role="none" placeholder="Enter output value"></textarea>
                </div>
                </td>
              </tr>
              <tr>
                <td colspan="1">Topic</td>
                <td colspan="2">
                  <div class="textbox">
                    <textarea name="topic" class="nice" rows="1" cols="60" style="resize: none;" data-role="none" placeholder="Enter topic of question"></textarea>
                </div>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <div class="logout">
                    <form method="POST">
                      <input type="submit" name="upload" value="Upload">
                    </form>                    
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

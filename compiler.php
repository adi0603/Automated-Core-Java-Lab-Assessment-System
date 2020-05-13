<?php
session_start();
if($_SESSION['userid'] == "")
{
  header('Location: index.php');
}
require 'connect.php';
$userid=$_SESSION['userid'];
$result = mysqli_query($con,'select * from student where student_id='.$userid.'');
$fetch=mysqli_fetch_array($result);
?><html>
  <head>
    <title>Automated Lab Assessment System</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="images/icons/java.ico"/>
    <link rel="stylesheet" type="text/css" href="css/question.css">
    <script src="https://kit.fontawesome.com/ab99e84824.js"></script>
    <script src="js0/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js0/vendor/jquery-1.12.0.min.js"></script>

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
          <button class="cta-contact" onclick="location.href='studentinfo.php'"><i class="fas fa-cog"></i>&nbsp;&nbsp;<?php echo $fetch['name'];?></button>
        </nav>
      </header>
      
      <main class="page-main">
        <div class="container">
          <table>
            <caption>Java Compiler</caption>
            <form action="compilers/java.php" id="form" name="f2" method="POST" >
              <tbody>
                <tr>
                  <td colspan="2">
                    <p>Enter Your Code</p>
                    <div class="textbox">
                    <textarea class="nice" name="code" rows="25" cols="113" style="resize: none;" data-role="none" onpaste="return false;">
class Main{
  public static void main(String [] abc){
    System.out.println("hello java");
  }
}</textarea>
</div>
                  </td>
                </tr>
                <tr>
                  <td colspan="1">
                    <p>Enter Input Value</p>
                    <div class="textbox">
                    <textarea name="input" class="nice" rows="10" cols="50" style="resize: none;" data-role="none"></textarea>
                  </div>
                  </td>
                  <td colspan="1">
                    <p>Output</p>
                    <div class="textbox">
                    <textarea id='div' name="output" class="nice" rows="10" cols="50" style="resize: none;" data-role="none" disabled></textarea></div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="logout">
                      <input type="submit" id="st" value="Run Code">
                    </div>
                  </td>
                </tr>
              </tbody>
            </form>
          </table>
          <script type="text/javascript">
            $(document).ready(function()
            {
              $("#st").click(function()
              {
                $("#div").html("Loading ......");
              });
            });
          </script>
          <script>
            //wait for page load to initialize script
            $(document).ready(function()
            {
              //listen for form submission
              $('form').on('submit', function(e)
              {
                //prevent form from submitting and leaving page
                e.preventDefault();

                // AJAX
                $.ajax({
                type: "POST", //type of submit
                cache: false, //important or else you might get wrong data returned to you
                // url: "compile.php", //destination
                url: "compilers/java.php",
                datatype: "html", //expected data format from process.php
                data: $('form').serialize(), //target your form's data and serialize for a POST
                success: function(result) { // data is the var which holds the output of your process.php

                // locate the div with #result and fill it with returned data from process.php
                $('#div').html(result);
                //alert(result);//found here.......
                }

              });
              });

            });
          </script>
        </div>
      </main>
    </div>
  </body>
</html>

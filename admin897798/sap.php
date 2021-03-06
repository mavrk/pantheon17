<?php
  session_start();
  if((!isset($_SESSION['adminKey'])) || $_SESSION['adminKey']!="8abd5b6492cdad380d53dd2f5b9112b4"){
    header('location: index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SAP | Pantheon 17</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://www.pantheon17.in/css/register.css">
  <link rel="stylesheet" href="https://www.pantheon17.in/css/animate.css">
  <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">

</head>
<body>
  
<div class="container-fluid text-center"> 
    <div class="row">
        <div class="col-md-4" style="text-align:right;vertical-align: middle;"></div>
        <div class="col-md-4" style="text-align:center;"><a href="https://www.pantheon17.in/"><img src="https://www.pantheon17.in/assets/images/logo-final.png" width="150px" height="auto" alt="Pantheon 17 BIT Mesra" style="float:center;"></a></div>
        <div class="col-md-4" style="text-align:center;vertical-align: middle;"> </div>
    </div> 
  <div class="row content" id="SAP">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-10" id="box">
        
    </div>
    <div class="col-sm-1">
    </div>
  </div>
</div>
<script>
$.get("https://www.pantheon17.in/api/saps/getAllSAPS").done(function(data){
  text = "";
  for(var i=0;i<data.length;i++){
    text += "<div class=\"box\" style=\"color: #FFF; text-align: left; padding-left: 10%;\"><br><font color='#ffff93'>SAP ID:</font> "+data[i].sapId.toUpperCase()+"<br><font color='#ffff93'>Name:</font> "+toTitleCase(data[i].name)+"<br><font color='#ffff93'>Email:</font> "+data[i].email.toLowerCase()+"<br><font color='#ffff93'>Phno:</font> "+data[i].phoneNumber+"<br><font color='#ffff93'>College Name:</font> "+toTitleCase(data[i].collegeName)+"<br><br><font color='#ffff93'>Why do you wish to become the Student Ambassador of your college?</font><br> Ans. "+data[i].answer1+"<br><br><font color='#ffff93'>How long have you been enrolled in your college?</font><br>Ans. "+data[i].answer2+"<br><br><font color='#ffff93'>Do you have any other commitments in the month of October 2017?</font><br>Ans. "+data[i].answer3+"<br><br><font color='#ffff93'>Do you have any club related experience in your college?</font><br>Ans. "+data[i].answer4+"<br><br><font color='#ffff93'>How many participants can we expect if you are made the Student Ambassador?</font><br>Ans. "+data[i].answer5+"<br><br></div>";
    $("#box").html(text);
  }
});
function toTitleCase(str){
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

</script>
</body>
</html>


<?php
  session_start();
  if((!isset($_SESSION['adminKey'])) || $_SESSION['adminKey']!="8abd5b6492cdad380d53dd2f5b9112b4"){
    header('location: index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Applicants | Pantheon 17</title>
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
  <div class="row content" id="adminApplicantsForm">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
      <div class="box">
          <div id="numRecords"></div>
           <form method="post">
            <div class="group"></div>
             <div class="group">
              <input class="inputMaterial" type="text" id="id" data-toggle="tooltip" title="Enter Pantheon ID to view records" data-placement="bottom" required>
              <span class="highlight"></span>
              <label>Pantheon ID</label>
            </div>
            <div class="btn btn-primary" style="font-size: 14px;margin-top:10px;padding:3%;color:#FFF;" id="showRecords" onclick="showRecords()">View Records &nbsp;<span class="glyphicon glyphicon-arrow-right"></span></div>
            <br><br>
          </form>
          <div id="recordBoxDiv" style="color: #FFF; font-size:16px;">

          </div>
        </div>

    </div>
    <div class="col-sm-4">
    </div>
  </div>
</div>
<script>
$.get("https://www.pantheon17.in/api/applicants/getApplicantCount").done(function(data){
  $("#numRecords").html("<br><font color='#fff'>There are "+data.count+" total registrations including some fake ones.<br>Records are from &nbsp; PA17/10000 &nbsp; to &nbsp; PA17/"+(10000+data.count-1)+".</font><br>");
});
var id = getUrlVars()["id"];
if(id!=undefined){
  document.getElementById('id').value = id;
  showRecords();
}
function toTitleCase(str){
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
function showRecords(){
  $("#showRecords").html("<span class=\"glyphicon glyphicon-refresh glyphicon-refresh-animate\"></span> Fetching..");
  $("#showRecords").attr("disabled","disabled");
  var id = $('#id').val();
  var iddata = {
    'id': id
  }
  $.post("https://www.pantheon17.in/api/applicants/getApplicantById",iddata).done(function(data){
      $("#showRecords").html("Show Records");
      $("#showRecords").removeAttr("disabled");
      if(data.success){
        text = "<br><br><font color='#fff789'>**Basic Info**</font><br><br>";
        text += "<font color='#fff789'>Name:</font> "+toTitleCase(data.data.name)+"<br><font color='#fff789'>Email:</font> "+data.data.email.toLowerCase()+"<br><font color='#fff789'>Phno:</font> +91-"+data.data.phoneNumber;
        if(data.data.otpVerified==true){
          text += "<br><font color='#fff789'>Verification Status:</font> <font color=lightgreen>Phone Number is correct</font>";
          if(data.data.registered==true){
            text += "<br><font color='#fff789'>Registration Status:</font> <font color=lightgreen>Registration successful</font>";
          }
          else{
            text += "<br><font color='#fff789'>Registration Status:</font> Pending Registration";
          }
          text += "<br><br><font color='#fff789'>**Additional Information**</font><br><br>";
          text += "<font color='#fff789'>Gender:</font> "+data.data.gender+"<br><font color='#fff789'>City:</font> "+toTitleCase(data.data.city)+"<br><font color='#fff789'>State:</font> "+data.data.state+"<br><font color='#fff789'>School/College Rollno:</font> "+data.data.rollNumber.toUpperCase()+"<br><font color='#fff789'>Year:</font> "+data.data.year+"<br><font color='#fff789'>School/College Name:</font> <br>"+data.data.collegeName.toUpperCase();
          text += "<br><br><font color='#fff789'>**Participation details**</font><br><br>";
          text += "<font color='#fff789'>Illuminati:</font> "+data.data.illuminati+"<br><font color='#fff789'>CodeBridgeton:</font> "+data.data.cyberbrigeton+"<br><font color='#fff789'>Eureka:</font> "+data.data.eureka+"<br><font color='#fff789'>CodeZilla:</font> "+data.data.codezilla+"<br><font color='#fff789'>Droid Trooper:</font> "+data.data.droidtrooper+"<br><font color='#fff789'>Formal/Informal:</font> "+data.data.formalinformal;
          text += "<br><br><font color='#fff789'>**Payment Details**</font><br><br>";
          text += "<font color='#fff789'>Day 1:</font> ";
          if(data.data.payment.day1==true){
            text += "<font color=lightgreen>OK</font>";
          }
          else{
            text += "<font color=red>Not Done</font>";
          }
          text += "<br><font color='#fff789'>Day 2:</font> ";
          if(data.data.payment.day2==true){
            text += "<font color=lightgreen>OK</font>";
          }
          else{
            text += "<font color=red>Not Done</font>";
          }
          text += "<br><font color='#fff789'>Day 3:</font> ";
          if(data.data.payment.day3==true){
            text += "<font color=lightgreen>OK</font>";
          }
          else{
            text += "<font color=red>Not Done</font>";
          }
        }
        else{
          text += "<br><font color='#fff789'>Verification Status:</font> <font color='#ff6b60'>Phone Number is not verified.</font>";
        }
        text += "<br><br>";
        console.log(data);
        $("#recordBoxDiv").html(text);
        $("#id").css({"border":""});
      }
      else{
        $("#id").css({"border":"3px solid red"});
        $("#recordBoxDiv").html("");
      }
  });
}
function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
  });
  return vars;
}
</script>
</body>
</html>

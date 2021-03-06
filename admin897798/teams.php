<?php
  session_start();
  if((!isset($_SESSION['adminKey'])) || $_SESSION['adminKey']!="8abd5b6492cdad380d53dd2f5b9112b4"){
    header('location: index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registered Teams | Pantheon 17</title>
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
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
      <div class="box">
           <form method="post">
            <div class="group"></div>
            <div class="group"  style="text-align: center;">      
              <select class="inputMaterial" style="width: 30%;" id="eventName" onchange="view()">
                <option value="">Select Event</option>
                <option value="formalinformal">Formal/Informal</option>
                <option value="illuminati">Illuminati</option>
                <option value="droidtrooper">Droid Trooper</option>
                <option value="codezilla">CodeZilla</option>
                <option value="cyberbrigeton">CyberBridgeton</option>
                 <option value="eureka">Eureka</option>
              </select>
              <span class="highlight"></span>
              <label>Select events to view teams</label>
            </div>
          </form>
          <br><br>
          <div id="recordBoxDiv" style="color: #FFF; font-size:16px;">
          
          </div>
          <br><br>
        </div>
        
    </div>
    <div class="col-sm-2">
    </div>
  </div>
</div>
<script>
var teams = {};
teams['formalinformal'] = [];
teams['codezilla'] = [];
teams['cyberbrigeton'] = [];
teams['illuminati'] = [];
teams['droidtrooper'] = [];
teams['eureka'] = [];
teams[''] = [];
$.get("https://www.pantheon17.in/api/teams/getAllTeams").done(function(data){
    for(var i=0;i<data.length;i++){
      obj = {'teamName': data[i].teamName,'points':data[i].points};
      teams[data[i].eventName].push(obj);
    }
});
function view(){
  var eventName = $("#eventName").val();
  if(eventName==""){
    $("#recordBoxDiv").html("");
    return;
  }
  else{
    text = "";
    if(teams[eventName].length==0){
      $("#recordBoxDiv").html("<font color='#ff9a72'>No records found for the given event</font>");
      return;
    }
    text += "<table class='table table-responsive'><thead><tr style='margin:0px auto;color: #fff789;'><th style='text-align: center;'>Sl. No.</th><th style='text-align: center;'>Team Name</th><th style='text-align: center;'>Score</th><th style='text-align: center;'>Details</th></tr></thead><tbody>";
    for(var i=0;i<teams[eventName].length;i++){
      text += "<tr><td>"+(i+1)+"</td><td>"+teams[eventName][i].teamName+"</td><td>"+teams[eventName][i].points+"</td><td><a href='teamdetails.php?name="+teams[eventName][i].teamName+"&event="+eventName+"' style='color: #FFF;' target='new'>View Details</a></td></tr>";
    }
    text += "</tbody></table>";
    $("#recordBoxDiv").html(text);
  }
}
</script>
</body>
</html>

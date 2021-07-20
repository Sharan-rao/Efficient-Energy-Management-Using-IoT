var pgraph=[];
var bgraph=[];
var upgraph=[];
var ubgraph=[];
var leddata=[];
var nleddata=[];
var myVar = setTimeout( led , 100);
var led1=document.getElementById("led1");
var led2=document.getElementById("led2");
var leddatai=setInterval(led, 1000);
var pgraphi=setInterval(plot_graph, 5000);
var bgraphi=setInterval(plot_graphb, 5000);
var xyz=setTimeout(function(){ plot_graph; }, 1000);
var xyz1=setTimeout(function(){ plot_graphb; }, 1000);
function displayblock(){
  var yx=document.getElementById("dpass");
  var xy=document.getElementById("pass");
  xy.style.display='block';
  yx.style.display='none';
  plot_graph();
  led();
}

function led()
{   
   var req=new XMLHttpRequest();
    req.open('GET','ledstatus.php',true);
    req.onload=function(){
        leddata=JSON.parse(req.responseText);
         
    }
    req.send();
    updateled();
    
}
function updateled1()
{
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange  = function() {
    if (this.readyState == 4 && this.status == 200) {
      leddata=JSON.parse(xhttp.responseText);
    }
  };
  xhttp.open("POST", "ledstatus.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var x="led1="+nleddata[0];
  xhttp.send(x);
  updateled();

}
function updateled2()
{
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      leddata=JSON.parse(xhttp.responseText);
    }
  };
  xhttp.open("POST", "ledstatus.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var x="led2="+nleddata[1];
  xhttp.send(x);
  updateled();

}

function updateled()
{    
    if(leddata[0]==0)
    {
       led1.style.backgroundColor = "red";
       led1.innerHTML= "off";
       nleddata[0]=1;

    }
    if(leddata[0]==1)
    { 

       led1.style.backgroundColor = "green";
       led1.innerHTML= "on";
       nleddata[0]=0;
       
    }
    if(leddata[1]==0)
    {
        led2.style.backgroundColor="red";
        led2.innerHTML="off";
        nleddata[1]=1;

    }
    if(leddata[1]==1)
    {
       led2.style.backgroundColor= "green";
       led2.innerHTML="on";
       nleddata[1]=0;

    }
}

function plot_graph()
{
    {
    var req1=new XMLHttpRequest();
    req1.open('GET','aplotofday.php',true);
    req1.onload=function(){
    pgraph=JSON.parse(req1.responseText);
    }
    req1.send();
}
    plot();

}
function plot()
{
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
  
        function drawChart() {
          var data = google.visualization.arrayToDataTable(pgraph);
  
          var options = {
            title: 'Electric Power',
            hAxis: {title: 'time',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0},
            legend: {position: 'top', maxLines: 3}         
          };
          var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
          chart.draw(data, options);
          
        }
}
function plot_graphb()
{
    {
    var req1b=new XMLHttpRequest();
    req1b.open('GET','bplotofday.php',true);
    req1b.onload=function(){
    bgraph=JSON.parse(req1b.responseText);
    }
    req1b.send();
}
    plotb();

}
function plotb()
{
  google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = google.visualization.arrayToDataTable(bgraph);

      var options = {
        title: 'TOTAL ENERGY',
        chartArea: {width: '80%'},
        hAxis: {
          title: 'Day',
          minValue: 0
        },
        vAxis: {
          title: 'ENERGY'
        },
        legend: {position: 'top', maxLines: 3}  
        
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('bchart_div'));
      chart.draw(data, options);
    }

}
function uchart()
{
  
  var x1=document.getElementById('sdate');
  var x2=document.getElementById('edate');
  var y1=x1.value;
  var y2=x2.value;
  y1=y1.replace("T"," ");
  y2=y2.replace("T"," ");
  var sdate=y1.slice(0,10);
  var edate=y2.slice(0,10)
  if (y1.length>0 && y2.length>0)
  { var xy=document.getElementById("chart_div1");
    xy.style.display='block';
    xy=document.getElementById("bchart_div1");
    xy.style.display='block';
    window.location.href="#chart_div1";
   {
      var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange  = function() {
      if (this.readyState == 4 && this.status == 200) {
       upgraph=JSON.parse(xhttp.responseText);
       {
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart1);
    
        function drawChart1() {
          var data = google.visualization.arrayToDataTable(upgraph);
     
          var options = {
            title: 'Electric Power',
            hAxis: {title: 'time',  titleTextStyle: {color: '#333'}},
            vAxis: {minValue: 0},
            legend: {position: 'top', maxLines: 3}         
          };
          var chart = new google.visualization.AreaChart(document.getElementById('chart_div1'));
          chart.draw(data, options);
          
        }
    }
    {
      var xhttp11 = new XMLHttpRequest();
      xhttp11.onreadystatechange  = function() {
        if (this.readyState == 4 && this.status == 200) {
          ubgraph=JSON.parse(xhttp11.responseText);
          {
            google.charts.load('current', {packages: ['corechart', 'bar']});
          google.charts.setOnLoadCallback(drawMultSeries1);
          
          function drawMultSeries1() {
                var data = google.visualization.arrayToDataTable(ubgraph);
          
                var options = {
                  title: 'TOTAL ENERGY',
                  chartArea: {width: '80%'},
                  hAxis: {
                    title: 'Day',
                    minValue: 0
                  },
                  vAxis: {
                    title: 'ENERGY'
                  },
                  legend: {position: 'top', maxLines: 3}  
                  
                };
          
                var chart = new google.visualization.ColumnChart(document.getElementById('bchart_div1'));
                chart.draw(data, options);
              }
          
            
        }
        }
      };
      xhttp11.open("POST", "ubplotofday.php", true);
      xhttp11.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      var x="sdate="+sdate+"&edate="+edate;
      xhttp11.send(x);
    }
      }
      
    };
    xhttp.open("POST", "uaplotofday.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var x="sdate="+y1+"&edate="+y2;
    xhttp.send(x);
  }
  

  

  }
  else
  {
    alert("ENTER THE VALID DATE AND TIME")
  }

}
function pass() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText=='1')
      {
        displayblock();
      }
    }
  };
  var y=document.getElementById("spass");
  var x ="password="+y.value;
  xhttp.open("POST", "password.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(x);
}

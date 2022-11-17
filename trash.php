
    section{
      justify-content: center;
      min-height: 100vh;
      width: 100%;
    }
<div id="chartContainer" style="height: 100%; width: 100%;"></div>
<script type="text/javascript">
  var loadingEle = $("water1");
  var loading_width = loadingEle.width(),
  loading_height = loadingEle.height();

  var loadingEle2 = $("water2");
  var loading_width2 = loadingEle2.width(),
  loading_height2 = loadingEle2.height();

  $(".water1").createWaterBall({
    csv_config: {
      width: loading_width,
      height: loading_height
    },
    wave_config: {
      waveWidth: 0.02,
      waveHeight: 5
    },
    data_range: [30, 70, 100],
    isLoading: true,
    nowRange: 70,
    targetRange: 45
  });
  $(".water2").createWaterBall({
    csv_config: {
      width: loading_width2,
      height: loading_height2
    },
    wave_config: {
      waveWidth: 0.02,
      waveHeight: 5
    },
    data_range: [30, 70, 100],
    isLoading: true,
    nowRange: 70,
    targetRange: 70
  });
  setTimeout(function() {
    $(".water1").createWaterBall("updateRange", 50);
  }, 1000);
  setTimeout(function() {
    $(".water2").createWaterBall("updateRange", 90);
  }, 1000);
</script>
<script>
  window.onload = function () {

    var dataPoints1 = [];
    var dataPoints2 = []; // dataPoints
    var chart = new CanvasJS.Chart("chartContainer", {
      zoomEnabled: true,
      title: {
        text: "Data Real Time Green House"
      },
      axisX: {
        title: "updates every 3 secs"
      },
      axisY:{
        prefix: ""
      }, 
      toolTip: {
        shared: true
      },
      legend: {
        cursor:"pointer",
        verticalAlign: "top",
        fontSize: 22,
        fontColor: "dimGrey",
        itemclick : toggleDataSeries
      },
      data: [{ 
        type: "line",
        xValueType: "dateTime",
        yValueFormatString: "####.00",
        xValueFormatString: "hh:mm:ss TT",
        showInLegend: true,
        name: "SH1",
        dataPoints: dataPoints1
      },
      {               
        type: "line",
        xValueType: "dateTime",
        yValueFormatString: "####.00",
        showInLegend: true,
        name: "HD1" ,
        dataPoints: dataPoints2
      }]
    });

    function toggleDataSeries(e) {
      if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
      }
      else {
        e.dataSeries.visible = true;
      }
      chart.render();
    }

    var yValue1 = 600; 
    var yValue2 = 605;

    var time = new Date;
// starting at 9.30 am
time.setHours(9);
time.setMinutes(30);
time.setSeconds(00);
time.setMilliseconds(00);
var updateInterval = 1000;
var dataLength = 300; // number of dataPoints visible at any point

function updateChart(count) {
  count = count || 1;
  var deltaY1, deltaY2;
  for (var i = 0; i < count; i++) {
    time.setTime(time.getTime()+ updateInterval);
    deltaY1 = .5 + Math.random() *(-.5-.5);
    deltaY2 = .5 + Math.random() *(-.5-.5);

    // adding random value and rounding it to two digits. 
    yValue1 = Math.round((yValue1 + deltaY1)*100)/100;
    yValue2 = Math.round((yValue2 + deltaY2)*100)/100;

    // pushing the new values
    dataPoints1.push({
      x: time.getTime(),
      y: yValue1
    });
    dataPoints2.push({
      x: time.getTime(),
      y: yValue2
    });
  }

    // updating legend text with  updated with y Value 
    chart.options.data[0].legendText = " SH1 " + yValue1;
    chart.options.data[1].legendText = " HD1 " + yValue2; 
    chart.render();
  }

// var updateChart = function (count) {

//     count = count || 1;

//     for (var j = 0; j < count; j++) {
//         yVal = yVal +  Math.round(5 + Math.random() *(-5-5));
//         dps.push({
//             x: xVal,
//             y: yVal
//         });
//         xVal++;
//     }

//     if (dps.length > dataLength) {
//         dps.shift();
//     }

//     chart.render();
// };

updateChart(dataLength);
setInterval(function(){updateChart()}, updateInterval);

}
</script>
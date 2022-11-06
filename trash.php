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
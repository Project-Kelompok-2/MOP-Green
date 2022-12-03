<?php 
include ('../koneksi.php');
$query = mysqli_query($koneksi, "SELECT waktu, max(temp1) as temp1max, max(temp2), max(hum1) as hum1max, max(hum2), avg(temp1) as temp1avg, avg(temp2), avg(hum1) as hum1avg, avg(hum2), min(temp1) as temp1min, min(temp2), min(hum1) as hum1min, min(hum2) FROM data_sensor WHERE weekday(waktu)=weekday(current_date)");
        //weekday(waktu)=weekday(current_date)
$row = mysqli_fetch_assoc($query);
$temp1max[''] = isset($row['temp1max']) ? $row['temp1max'] : '';
$temp1min[''] = isset($row['temp1min']) ? $row['temp1min'] : '';
$hum1max[''] = isset($row['hum1max']) ? $row['hum1max'] : '';
$hum1min[''] = isset($row['hum1min']) ? $row['hum1min'] : '';
$temp1avg[''] = isset($row['temp1avg']) ? $row['temp1avg'] : '';
?>
<div class="row">
	<div class="col-md-6 text-center sht">
		<h7>Suhu Tertinggi</h7>
		<h5><?php echo max($temp1max); ?>&deg;</h5>
	</div>
	<div class="col-md-6 text-center klt">
		<h7>Kelembapan Tertinggi</h7>
		<h5><?php echo max($hum1max); ?> <span>HR</span></h5>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-center sht">
		<h7>Suhu Terendah</h7>
		<h5><?php echo min($temp1min); ?>&deg;</h5>
	</div>
	<div class="col-md-6 text-center klt">
		<h7>Kelembapan Terendah</h7>
		<h5><?php echo min($hum1min); ?> <span>HR</span></h5>
	</div>
</div>
<div class="row">
	<div class="col-md-6 text-center sht">
		<h7>Rata - Rata Suhu</h7>
		<h5><?php echo round($row['temp1avg']); ?>&deg;</h5>
	</div>
	<div class="col-md-6 text-center klt">
		<h7>Rata - Rata Kelembapan</h7>
		<h5>
			<?php echo round($row['hum1avg']);?> <span>HR</span></h5>
		</div>
	</div>
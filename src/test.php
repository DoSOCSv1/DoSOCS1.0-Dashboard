<?php 
	include("function/headerfooter.php");
	incHeader("Chart");
?>
<div>
	<canvas id="myChart" width="400" height="400"></canvas>
</div>

<script src="js/Chart.js"></script>
<script type="text/javascript">
var pieData = [
		{
			value: 300,
			label: "Red"
		},
		{
			value: 50,
			label: "Green"
		}
	];

	window.onload = function(){
		var ctx = document.getElementById("myChart").getContext("2d");
		window.myPie = new Chart(ctx).Pie(pieData);
	};
</script>
<?php
	incfooter(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>

    <title>
      Chart
    </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="http://code.highcharts.com/highcharts.js" type="text/javascript"></script>
    <script src="http://code.highcharts.com/modules/exporting.js" type="text/javascript"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>

<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>

<?php
	include 'sqli_connect.php';
	$no = get_post_data();
echo "<h2> <u> User - ". $no."</u> </h2> <Br>";

			$totalRecords = 0;
			$callSuccessRecords = 0;
			$query = "SELECT `Mobile No`, `Cause_Code`, `Duration` FROM `table 1` WHERE `Mobile No` = '$no' " ;
			$result = $con->query($query);
			if($result) // will return true if succefull else it will return false
			{		
				if($result->num_rows>=1){
					while ($row = $result->fetch_assoc()) {
						$totalRecords++;
						if($row['Cause_Code'] == 0){
							$callSuccessRecords++;
						}
					} 

	       				
	    		}
			
						
 			}
 			$ccr = ($callSuccessRecords/$totalRecords) * 100 ;
 			echo "Successfull Calls- ".$callSuccessRecords. "<br> ";
 			echo "Total Calls- " . $totalRecords. " <br>";
 			echo "CALL Completion RATE- " . $ccr. " %<br>";
?>

 <script type="text/javascript">

$(function () {

    // Uncomment to style it like Apple Watch
   /* 
    if (!Highcharts.theme) {
        Highcharts.setOptions({
            chart: {
                backgroundColor: 'white'
            },
            colors: ['#F62366', '#9DFF02', '#0CCDD6'],
            title: {
                style: {
                    color: 'silver'
                }
            },
            tooltip: {
                style: {
                    color: 'silver'
                }
            }
        });
    }
    */
    Highcharts.chart('container', {

        chart: {
            type: 'solidgauge',
            marginTop: 50
        },

        title: {
            text: 'Call Completion Rate',
            style: {
                fontSize: '24px'
            }
        },

        tooltip: {
            borderWidth: 0,
            backgroundColor: 'none',
            shadow: false,
            style: {
                fontSize: '16px'
            },
            pointFormat: '{series.name}<br><span style="font-size:2em; color: {point.color}; font-weight: bold">{point.y}</span>',
            positioner: function (labelWidth, labelHeight) {
                return {
                    x: 200 - labelWidth / 2,
                    y: 180
                };
            }
        },

        pane: {
            startAngle: 0,
            endAngle: 360,
            background: [{ // Track for Move
                outerRadius: '112%',
                innerRadius: '88%',
                backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.3).get(),
                borderWidth: 0
            }, { // Track for Exercise
                outerRadius: '87%',
                innerRadius: '63%',
                backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[1]).setOpacity(0.3).get(),
                borderWidth: 0
            }, { // Track for Stand
                outerRadius: '62%',
                innerRadius: '38%',
                backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[2]).setOpacity(0.3).get(),
                borderWidth: 0
            }]
        },

        yAxis: {
            min: 0,
            max: 100,
            lineWidth: 0,
            tickPositions: []
        },

        plotOptions: {
            solidgauge: {
                borderWidth: '25px',
                dataLabels: {
                    enabled: false
                },
                linecap: 'round',
                stickyTracking: false
            }
        },

        series: [{
            name: 'Total Calls',
            borderColor: Highcharts.getOptions().colors[0],
            data: [{
                color: Highcharts.getOptions().colors[0],
                radius: '100%',
                innerRadius: '100%',
                y: <?php echo "$totalRecords"  ; ?>
            }]
        }, {
            name: 'Successfull Calls',
            borderColor: Highcharts.getOptions().colors[1],
            data: [{
                color: Highcharts.getOptions().colors[1],
                radius: '75%',
                innerRadius: '75%',
                y: <?php echo "$callSuccessRecords";?>
            }]
        }, {
            name: 'Call Completion Rate',
            borderColor: Highcharts.getOptions().colors[2],
            data: [{
                color: Highcharts.getOptions().colors[2],
                radius: '50%',
                innerRadius: '50%',
                y: <?php echo "$ccr";?>
            }]
        }]
    },

    /**
     * In the chart load callback, add icons on top of the circular shapes
     */
    function callback() {

        // Move icon
        this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8])
            .attr({
                'stroke': '#303030',
                'stroke-linecap': 'round',
                'stroke-linejoin': 'round',
                'stroke-width': 2,
                'zIndex': 10
            })
            .translate(190, 26)
            .add(this.series[2].group);

        // Exercise icon
        this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8, 'M', 8, -8, 'L', 16, 0, 8, 8])
            .attr({
                'stroke': '#303030',
                'stroke-linecap': 'round',
                'stroke-linejoin': 'round',
                'stroke-width': 2,
                'zIndex': 10
            })
            .translate(190, 61)
            .add(this.series[2].group);

        // Stand icon
        this.renderer.path(['M', 0, 8, 'L', 0, -8, 'M', -8, 0, 'L', 0, -8, 8, 0])
            .attr({
                'stroke': '#303030',
                'stroke-linecap': 'round',
                'stroke-linejoin': 'round',
                'stroke-width': 2,
                'zIndex': 10
            })
            .translate(190, 96)
            .add(this.series[2].group);
    });


});
    </script>
  </head>
  <body>
    <div id="container" style="min-width: 300px; height:300px; margin: 20 "></div>
  


</body>
</html>


<?php


echo "<BR>";
 			$eventDuration2G = 0;
			$totalDuration   = 0;
			$limit2G = 1000;
			$query = "SELECT `Mobile no`, `EVENT_DURATION`, `Cause Code`,  `TOTAL_VOLUME` FROM `table 2` WHERE `Mobile no` = '$no' ";
			$result = $con->query($query);
			if($result) // will return true if succefull else it will return false
			{		
				if($result->num_rows>=1){
					while ($row = $result->fetch_assoc()) {
						$avgSpeed = $row['TOTAL_VOLUME']/$row['EVENT_DURATION'];   
					//	echo "<br> avgSpeed   ".$avgSpeed;
						if($avgSpeed < $limit2G){
							$eventDuration2G += $row['EVENT_DURATION'];
						}
						$totalDuration += $row['EVENT_DURATION'];
					} 

	       				
	    		}
			
						
 			}

 			$rate =($eventDuration2G/$totalDuration) *(100);
 			echo "2G Data Usage Duration - ".$eventDuration2G. "<br> ";
 			echo "Total Usage Duration - " . $totalDuration. " <br>";
 			echo "2G Rate- " . $rate . "<br>";
?>

<html>
  <head>
    <title>
      Chart
    </title>
      
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>


 <script type="text/javascript">
$(function () {

    var gaugeOptions = {

        chart: {
            type: 'solidgauge'
        },

        title: null,

        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },

        tooltip: {
            enabled: false
        },

        // the value axis
        yAxis: {
            stops: [
                [0.1, '#55BF3B'], // green
                [0.5, '#DDDF0D'], // yellow
                [0.9, '#DF5353'] // red
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },

        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

    // The speed gauge
    $('#container-speed').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: '2G Rate'
            }
        },

        credits: {
            enabled: false
        },

        series: [{
            name: '2G Rate',
            data: [<?php echo (int)$rate;?>],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                       '<span style="font-size:12px;color:silver">%</span></div>'
            },
            tooltip: {
                valueSuffix: ' %'
            }
        }]

    }));

    // The RPM gauge
    $('#container-rpm').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: <?php echo "$totalDuration"; ?>,
            title: {
                text: 'Usage'
            }
        },

        series: [{
            name: 'Usage',
            data: [<?php echo "$eventDuration2G";?>],
            dataLabels: {
                format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                    ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y:.1f}</span><br/>' +
                       '<span style="font-size:12px;color:silver">2G</span></div>'
            },
            tooltip: {
                valueSuffix: ' 2G'
            }
        }]

    }));

    // Bring life to the dials
    setTimeout(function () {
        // Speed
        var chart = $('#container-speed').highcharts(),
            point,
            newVal,
            inc;

        if (chart) {
            point = chart.series[0].points[0];
            inc = 0;
            newVal = point.y + inc;

            if (newVal < 0 || newVal > 200) {
                newVal = point.y - inc;
            }

            point.update(newVal);
        }

        // RPM
        chart = $('#container-rpm').highcharts();
        if (chart) {
            point = chart.series[0].points[0];
            inc = 0;
            newVal = point.y + inc;

            if (newVal < 0 || newVal > 5) {
                newVal = point.y - inc;
            }

            point.update(newVal);
        }
    }, 2000);


});
    </script>
  </head>
  <body>
  
<div style="width: 600px; height: 400px; margin: 0 auto">
    <div id="container-speed" style="width: 300px; height: 200px; float: left"></div>
    <div id="container-rpm" style="width: 300px; height: 200px; float: left"></div>
</div>  

</body>
</html>














<?php

echo "<BR>";
 			$totalDataRecords = 0;
			$dataSuccessRecords = 0;
			$query = "SELECT `Mobile no`, `EVENT_DURATION`, `Cause Code`, `TOTAL_VOLUME` FROM `table 2` WHERE `Mobile no` = '$no' ";
			
			$result = $con->query($query);
			if($result) // will return true if succefull else it will return false
			{		
				if($result->num_rows>=1){
					while ($row = $result->fetch_assoc()) {
						$totalDataRecords++;
						if($row['Cause Code'] == 0){
							$dataSuccessRecords++;
						}
					} 

	       				
	    		}
			
						
 			}

 			$dsr = ($dataSuccessRecords/$totalDataRecords) *100;
 			echo "Successfull Data Usage- ".$dataSuccessRecords. "<br> ";
 			echo "Total Data Usage- " . $totalDataRecords. " <br>";
 			echo "Data Speed Ratio- " . $dsr . "%<br>";
?>
<html>
  <head>
    <title>
     
    </title>



 <script type="text/javascript">

$(function () {

    // Uncomment to style it like Apple Watch
    if (!Highcharts.theme) {
        Highcharts.setOptions({
            chart: {
                backgroundColor: 'white'
            },
            colors: ['#112366', '#4DFF02', '#0CCAD6'],
            title: {
                style: {
                    color: 'silver'
                }
            },
            tooltip: {
                style: {
                    color: 'silver'
                }
            }
        });
    }
    
    Highcharts.chart('container1', {

        chart: {
            type: 'solidgauge',
            marginTop: 50
        },

        title: {
            text: 'Data Speed Ratio',
            style: {
                fontSize: '24px'
            }
        },

        tooltip: {
            borderWidth: 0,
            backgroundColor: 'none',
            shadow: false,
            style: {
                fontSize: '16px'
            },
            pointFormat: '{series.name}<br><span style="font-size:2em; color: {point.color}; font-weight: bold">{point.y}</span>',
            positioner: function (labelWidth, labelHeight) {
                return {
                    x: 200 - labelWidth / 2,
                    y: 180
                };
            }
        },

        pane: {
            startAngle: 0,
            endAngle: 360,
            background: [{ // Track for Move
                outerRadius: '112%',
                innerRadius: '88%',
                backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0.3).get(),
                borderWidth: 0
            }, { // Track for Exercise
                outerRadius: '87%',
                innerRadius: '63%',
                backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[1]).setOpacity(0.3).get(),
                borderWidth: 0
            }, { // Track for Stand
                outerRadius: '62%',
                innerRadius: '38%',
                backgroundColor: Highcharts.Color(Highcharts.getOptions().colors[2]).setOpacity(0.3).get(),
                borderWidth: 0
            }]
        },

        yAxis: {
            min: 0,
            max: 100,
            lineWidth: 0,
            tickPositions: []
        },

        plotOptions: {
            solidgauge: {
                borderWidth: '25px',
                dataLabels: {
                    enabled: false
                },
                linecap: 'round',
                stickyTracking: false
            }
        },

        series: [{
            name: 'Total Data Usage',
            borderColor: Highcharts.getOptions().colors[0],
            data: [{
                color: Highcharts.getOptions().colors[0],
                radius: '100%',
                innerRadius: '100%',
                y: <?php echo "$totalDataRecords"  ; ?>
            }]
        }, {
            name: 'Successfull Data Usage',
            borderColor: Highcharts.getOptions().colors[1],
            data: [{
                color: Highcharts.getOptions().colors[1],
                radius: '75%',
                innerRadius: '75%',
                y: <?php echo "$dataSuccessRecords";?>
            }]
        }, {
            name: 'Data Speed Ratio',
            borderColor: Highcharts.getOptions().colors[2],
            data: [{
                color: Highcharts.getOptions().colors[2],
                radius: '50%',
                innerRadius: '50%',
                y: <?php echo "$dsr";?>
            }]
        }]
    },

    /**
     * In the chart load callback, add icons on top of the circular shapes
     */
    function callback() {

        // Move icon
        this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8])
            .attr({
                'stroke': '#303030',
                'stroke-linecap': 'round',
                'stroke-linejoin': 'round',
                'stroke-width': 2,
                'zIndex': 10
            })
            .translate(190, 26)
            .add(this.series[2].group);

        // Exercise icon
        this.renderer.path(['M', -8, 0, 'L', 8, 0, 'M', 0, -8, 'L', 8, 0, 0, 8, 'M', 8, -8, 'L', 16, 0, 8, 8])
            .attr({
                'stroke': '#303030',
                'stroke-linecap': 'round',
                'stroke-linejoin': 'round',
                'stroke-width': 2,
                'zIndex': 10
            })
            .translate(190, 61)
            .add(this.series[2].group);

        // Stand icon
        this.renderer.path(['M', 0, 8, 'L', 0, -8, 'M', -8, 0, 'L', 0, -8, 8, 0])
            .attr({
                'stroke': '#303030',
                'stroke-linecap': 'round',
                'stroke-linejoin': 'round',
                'stroke-width': 2,
                'zIndex': 10
            })
            .translate(190, 96)
            .add(this.series[2].group);
    });


});
    </script>
  </head>
  <body>
    <div id="container1" style="min-width: 300px; height:300px; margin: 20 t"></div>
  


</body>
</html>
<html>
  <head>
    <title>
     
    </title>



 <script type="text/javascript">









$(function () {
    $('#container4').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Contents of Highsoft\'s weekly fruit delivery'
        },
        subtitle: {
            text: '3D donut in Highcharts'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Delivered amount',
            data: [
                ['Bananas', 8],
                ['Kiwi', 3],
                ['Mixed nuts', 1],
                ['Oranges', 6],
                ['Apples', 8],
                ['Pears', 4],
                ['Clementines', 4],
                ['Reddish (bag)', 1],
                ['Grapes (bunch)', 1]
            ]
        }]
    });
});

    </script>
  </head>
  <body>
    <div id="container4" style="min-width: 300px; height:300px; margin: 20 t"></div>
  


</body>
</html>




<?php

echo "<br>";

	//Function to get data through post request
	function get_post_data()
	{   
				$postdata = file_get_contents("php://input");
                $file = urldecode($postdata);
                //Comment this line when posting data through android 
	            $file = substr($file , 2);
               
				return $file;
	}

//HTML CONTENT TO MAKE A FORM	
?>






<html>
<body>
  <form action="<?php $_PHP_SELF ?>" method="POST">
		<input type="text" name=' ' />
  		<input type="submit" />
  </form>
	<form action="generateExcel.php" method="get">
		
		<input type="submit" value="Generate Excel">
	</form>
</body>
</html>
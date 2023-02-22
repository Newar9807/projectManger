<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>

    <title>Teacher</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
        <?php include($root . "/5thproject/php/assets/tecSidebar.php"); ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/5thproject/php/assets/tecNav.php"); ?>
            <!-- Navigation Ends -->

            <!-- mid div start -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <!-- <div class="numbers" id="TaskNumber" name="TaskNumber">
                            
                        </div> -->
                        <div class="numbers" id="Task">
                            Projects<br>
                        </div>
                    </div>
                    <div class="doughChart" id="chartdiv">

                    </div>
                </div>


                <div class="card">
                    <div>
                        <div class="numbers" id="TaskNumber" name="TaskNumber">
                            Meetings
                        </div>
                        <!-- <div class="cardName" id="Task">
                            Tasks
                        </div> -->
                    </div>
                    <div class="doughChart" id="chartdiv2">
                    </div>
                </div>
                <div class="card">
                    <div>
                        <!-- <div class="numbers" id="TaskNumber" name="TaskNumber">
                            
                        </div> -->
                        <div class="numbers" id="Task">
                            Tasks<br> Progress
                        </div>
                    </div>
                    <div class="doughChart" id="chartdiv1">

                    </div>
                </div>
                <!-- <div class="card">
                    <div>
                        <div class="numbers" id="TaskNumber" name="TaskNumber">
                            20
                        </div>
                        <div class="cardName" id="Task">
                            Tasks
                        </div>
                    </div>
                    <div class="doughChart">
                        <canvas id="doughnut2"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers" id="completedTaskNumber" name="completedTaskNumber">
                            10
                        </div>
                        <div class="cardName">
                            Meetings
                        </div>
                    </div>
                    <div class="doughChart">
                        <canvas id="doughnut3"></canvas>
                    </div>
                </div> -->
            </div>
            <!-- mid div end -->

            <!-- data charts -->
            <div class="charts">
                <div class="chart">
                    <h2>Project Progress</h2>
                    <div>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

            </div>
            <!-- data charts ends -->

        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/teacherDashbaord.js"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([am5themes_Animated.new(root)]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
            var chart = root.container.children.push(
                am5percent.PieChart.new(root, {
                    innerRadius: 30,
                    layout: root.verticalLayout,
                })
            );

            // Create series
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
            var series = chart.series.push(
                am5percent.PieSeries.new(root, {
                    valueField: "size",
                    categoryField: "sector",
                })
            );

            // Set data
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
            series.data.setAll([{
                    sector: "Completed",
                    size: 5
                },
                {
                    sector: "Pending",
                    size: 6
                },
            ]);

            // Play initial series animation
            // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
            series.appear(1000, 100);

            // Add label
            var label = root.tooltipContainer.children.push(
                am5.Label.new(root, {
                    x: am5.p50,
                    y: am5.p50,
                    centerX: am5.p50,
                    centerY: am5.p50,
                    fill: am5.color(0x50b300),
                    fontSize: 20,
                })
            );

            label.set("text", "[bold]12");
            series.labels.template.set("text", "{category}: {valuePercentTotal.formatNumber('0.00')}%[/] [bold]({value})");
        }); // end am5.ready()

        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv1");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([am5themes_Animated.new(root)]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
            var chart = root.container.children.push(
                am5percent.PieChart.new(root, {
                    innerRadius: 30,
                    layout: root.verticalLayout,
                })
            );

            // Create series
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
            var series = chart.series.push(
                am5percent.PieSeries.new(root, {
                    valueField: "size",
                    categoryField: "sector",
                })
            );

            // Set data
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
            series.data.setAll([{
                    sector: "Completed",
                    size: 2
                },
                {
                    sector: "Pending",
                    size: 6
                },
            ]);

            // Play initial series animation
            // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
            // series.appear(1000, 100);
            series.appear(2000, 500);

            // Add label
            var label = root.tooltipContainer.children.push(
                am5.Label.new(root, {
                    x: am5.p50,
                    y: am5.p50,
                    centerX: am5.p50,
                    centerY: am5.p50,
                    fill: am5.color(0x50b300),
                    fontSize: 20,
                })
            );

            label.set("text", "[bold]8");
            series.labels.template.set("text", "{category}: {valuePercentTotal.formatNumber('0.00')}%[/] [bold]({value})");
        }); // end am5.ready()

        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv2");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([am5themes_Animated.new(root)]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
            var chart = root.container.children.push(
                am5percent.PieChart.new(root, {
                    innerRadius: 30,
                    layout: root.verticalLayout,
                })
            );

            // Create series
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
            var series = chart.series.push(
                am5percent.PieSeries.new(root, {
                    valueField: "size",
                    categoryField: "sector",
                })
            );

            // Set data
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
            series.data.setAll([{
                    sector: "Completed",
                    size: 2
                },
                {
                    sector: "Pending",
                    size: 6
                },
            ]);

            // Play initial series animation
            // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
            // series.appear(1000, 100);
            series.appear(1500, 250);

            // Add label
            var label = root.tooltipContainer.children.push(
                am5.Label.new(root, {
                    x: am5.p50,
                    y: am5.p50,
                    centerX: am5.p50,
                    centerY: am5.p50,
                    fill: am5.color(0xff0000),
                    fontSize: 20,
                })
            );

            label.set("text", "[bold]6");
            series.labels.template.set("text", "{category}: {valuePercentTotal.formatNumber('0.00')}%[/] [bold]({value})");
        }); // end am5.ready()
    </script>

    <!-- Chart code -->
    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("line1");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true
            }));

            // Add cursor
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30
            });
            xRenderer.labels.template.setAll({
                rotation: -90,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            xRenderer.grid.template.setAll({
                location: 1
            })

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "country",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            }));


            // Create series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "country",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5,
                strokeOpacity: 0
            });
            series.columns.template.adapters.add("fill", function(fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function(stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });


            // Set data
            var data = [{
                country: "USA",
                value: 2025
            }, {
                country: "China",
                value: 1882
            }, {
                country: "Japan",
                value: 1809
            }, {
                country: "Germany",
                value: 1322
            }, {
                country: "UK",
                value: 1122
            }, {
                country: "France",
                value: 1114
            }, {
                country: "India",
                value: 984
            }, {
                country: "Spain",
                value: 711
            }, {
                country: "Netherlands",
                value: 665
            }, {
                country: "South Korea",
                value: 443
            }, {
                country: "Canada",
                value: 441
            }];

            xAxis.data.setAll(data);
            series.data.setAll(data);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>


</body>

</html>
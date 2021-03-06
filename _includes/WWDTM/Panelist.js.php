<?php
# Copyright (c) 2007-2020 Linh Pham
# wwdt.me_v3 is relased under the terms of the Apache License 2.0

function PanelistJS($panelistID, $panelistName) {
	if (!is_null($panelistID) and !is_null($panelistName)) {
?>
<script type="text/javascript" async>
AmCharts.ready(function() {
    AmCharts.theme = AmCharts.themes.wwdtm;
    var spreadData = AmCharts.loadJSON('<?php print GRAPH_LOAD_JSON_URL; ?>?type=spread&pnlid=<?php print $panelistID; ?>');
    var trendData = AmCharts.loadJSON('<?php print GRAPH_LOAD_JSON_URL; ?>?type=trend&pnlid=<?php print $panelistID; ?>');
    
    var spreadChart = new AmCharts.AmSerialChart();
    var spreadGraph = new AmCharts.AmGraph();
    var spreadCategoryAxis = spreadChart.categoryAxis;
    var spreadValueAxis = new AmCharts.ValueAxis();
    var spreadChartCursor = new AmCharts.ChartCursor();
	    
    spreadCategoryAxis.autoGridCount = false;
    spreadCategoryAxis.gridCount = 20;
    spreadCategoryAxis.title = 'Score';
    spreadValueAxis.title = '# Times Scored';
    spreadChartCursor.enabled = false;
	
    spreadChart.addValueAxis(spreadValueAxis);
    spreadChart.addChartCursor(spreadChartCursor);
    spreadChart.pathToImages = '<?php print GRAPH_PATH_TO_IMAGES; ?>';
    spreadChart.dataProvider = spreadData;
    spreadChart.categoryField = 'score';
    spreadChart.addTitle("Scoring Breakdown for <?php print $panelistName; ?>");

    spreadGraph.labelText = '[[value]]';
    spreadGraph.type = 'column';
    spreadGraph.valueField = 'count';
    spreadGraph.showBalloon = false;
    spreadGraph.gridAboveGraphs = true;
    spreadGraph.lineAlpha = 0.2;
    spreadGraph.fillAlphas = 0.8;
    spreadChart.addGraph(spreadGraph);

    var trendChart = new AmCharts.AmSerialChart();
    var trendGraph = new AmCharts.AmGraph();
    var trendCategoryAxis = trendChart.categoryAxis;
    var trendValueAxis = new AmCharts.ValueAxis();
    var trendChartScrollbar = new AmCharts.ChartScrollbar();
    var trendChartCursor = new AmCharts.ChartCursor();

    trendCategoryAxis.labelsEnabled = false;
    trendCategoryAxis.tickLength = 0;
    trendCategoryAxis.title = 'Appearance';
    trendValueAxis.title = 'Score';
    trendValueAxis.minimum = 0;

    trendChartScrollbar.autoGridCount = false;
    trendChartCursor.cursorPosition = 'mouse';
    trendChartCursor.categoryBalloonEnabled = false;

    trendChart.addValueAxis(trendValueAxis);
    trendChart.addChartScrollbar(trendChartScrollbar);
    trendChart.addChartCursor(trendChartCursor);
    trendChart.pathToImages = '<?php print GRAPH_PATH_TO_IMAGES; ?>';
    trendChart.dataProvider = trendData;
    trendChart.categoryField = 'showdate';
    trendChart.addTitle("Score Graph for <?php print $panelistName; ?>");

    trendGraph.valueField = 'score';
    trendGraph.bullet = 'round';
    trendGraph.bulletSize = 1;
    trendGraph.bulletBorderColor = '#ffffff';
    trendGraph.bulletBorderThickness = 0;
    trendGraph.balloonText = '[[category]]: <b>[[value]]</b>';
    trendChart.addGraph(trendGraph);

    spreadChart.write('pnl<?php print $panelistID; ?>spread');
    trendChart.write('pnl<?php print $panelistID; ?>trend');
});
</script>
<?php
	}
}

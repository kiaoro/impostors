<?php include ROOT.DS.'views'.DS.'header.tpl'; ?>



<div class="content">
    
    
<div style="text-align: center;">	
    <canvas id="cs_radar_chart" height="450"  width="600" ></canvas>
</div>
    
   
</div>

<script type="text/javascript">
var data = {
labels : [ "Eating","Drinking","Sleeping","Designing","Coding","Partying","Running" ], 
datasets : [
    {
    fillColor : '#D8F2EB', 
    strokeColor : '#97BBCD', 
    pointColor : '#97BBCD', 
    pointStrokeColor : '#FFFFFF', 
    data : [ 28,48,40,19,96,27,100 ] 
    }
    ]
}
    var options = {
    scaleOverlay : true, 
    scaleShowLine : true,
    scaleLineColor : '#E2E2E2', 
    scaleLineWidth : 1, 
    scaleOverride : false, 	
    scaleSteps : null,
    scaleStepWidth : null,
    scaleStartValue : null,
    scaleShowLabels : true,
    scaleFontFamily : "'Calibri'", 
    scaleFontSize : 12, 
    scaleFontStyle : 'normal', 
    scaleFontColor : '#666666', 
    scaleShowLabelBackdrop : true, 
    scaleBackdropColor : '#FFFFFF', 
    scaleBackdropPaddingY : 2, 
    scaleBackdropPaddingX : 2, 
    angleShowLineOut : true,
    angleLineColor : '#E2E2E2', 
    angleLineWidth : 1, 
    pointDot : true, 
    pointDotRadius : 3, 
    pointDotStrokeWidth : 1, 
    pointLabelFontFamily : "'Arial'", 
    pointLabelFontStyle : 'normal', 
    pointLabelFontSize : 12, 
    pointLabelFontColor : '#666666', 
    datasetStroke : true,
    datasetStrokeWidth : 2, 
    datasetFill : true, 
    animation : true,
    animationSteps : 60, 
    animationEasing: 'easeOutQuart', 
}
var ctx = $("#cs_radar_chart").get(0).getContext("2d");
var myRadar = new Chart(ctx).Radar(data,options);
</script>

<?php include ROOT.DS.'views'.DS.'footer.tpl'; ?>


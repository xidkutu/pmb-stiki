<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});
    
    $("#view").show();
 
 });
 

$(function() {
	$("#tabelPra tr:even").addClass("stripe1");
	$("#tabelPra tr:odd").addClass("stripe2");
	$("#tabelPra tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});


</script>



<!--
Tampilan VIEW untuk grid data
--!>
<div id="view">
<div style="float:left; padding-bottom:5px;">
    
</div>
<div style="padding:10px;"></div>

<fieldset >

    <?php
    echo $this->graph->render();
    ?>

<div style="padding:10px;"></div>

</fieldset>
</div>
<div style="padding:10px;"></div>
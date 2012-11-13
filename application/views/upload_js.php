<?php defined('SYSPATH') or die('No direct script access.');?>

<script type="text/javascript">

function imgMove(direction)
{
	var position = 0;
	var property = null;

	//grab the current position
	//and property that we're changing
	if(direction == 'up' || direction == 'down')
	{
		//move the image up or down
		property = 'top';
		position = parseInt($("#top_img").css(property));		
	}
	else
	{
		//move the image up or down
		property = 'left';
		position = parseInt($("#top_img").css(property));
	}
	//figure out which direction
	var delta = 0;
	if(direction == 'up' || direction == 'left')
	{
		delta = -1;
	}
	else
	{
		delta = 1;
	}

	//update the postion
	$("#top_img").css(property, position + delta);
	var updatedPosition = position + delta;

	//update things on the server via ajax goodness
	$.get('<?php echo URL::base();?>frmupload/position?o=<?php echo $order_id?>&p='+updatedPosition+'&d='+property, function(data) {	
		});

	return false;
	
}

</script>
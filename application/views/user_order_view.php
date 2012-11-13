<?php defined('SYSPATH') or die('No direct script access.');?>



	<div id="images" style="position:relative;">
		<img style="position:absoloute; top:0xp;left:0px;" id="base_img" src="<?php echo URL::base()?>uploads/<?php echo $product->company_id.'-'.$product->id;?>.png"/>
		<?php if($order != null) {?>
			<img id="top_img" style="position:absolute;top:<?php echo $order->y_offset;?>px;left:<?php echo $order->x_offset;?>px;" width="<?php echo $order->width;?>" height="<?php echo $order->height;?>" src="<?php echo URL::base(); ?>uploads/<?php echo $order->image;?>"/>
		<?php }?>		
	</div>

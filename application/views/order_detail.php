<?php defined('SYSPATH') or die('No direct script access.');?>

<?php if($error != null) {?>
<h1><?php __('Error'). ' '.$error;?></h1>
<?php } else {?>

<h1><?php $product->title. ' '. __('Order');?></h1>

	<table id="order_detail_table">
		<tr>
			<td class="label_column"><strong><?php echo __('Date').':';?></strong></td>
			<td><?php echo $order->date; ?></td>
		</tr>
		<tr>
			<td class="label_column"><strong><?php echo __('Order ID').':';?></strong></td>
			<td><?php echo $order->GUID; ?></td>
		</tr>
		<tr>
			<td class="label_column"><strong><?php echo __('X Offset').':';?></strong></td>
			<td><?php echo $order->x_offset; ?></td>
		</tr>
		<tr>
			<td class="label_column"><strong><?php echo __('Y Offset').':';?></strong></td>
			<td><?php echo $order->y_offset; ?></td>
		</tr>
		<tr>
			<td class="label_column"><strong><?php echo __('User View').':';?></strong></td>			
			<td>
				<div id="images" style="position:relative;">
				<img style="position:absoloute; top:0xp;left:0px;" id="base_img" src="<?php echo URL::base()?>uploads/<?php echo $product->company_id.'-'.$product->id;?>.png"/>
				<img id="top_img" style="position:absolute;top:<?php echo $order->y_offset;?>px;left:<?php echo $order->x_offset;?>px;" width="<?php echo $order->width;?>" height="<?php echo $order->height;?>" src="<?php echo URL::base(); ?>uploads/<?php echo $order->image;?>"/>
			</div>
			</td>
		</tr>
	</table>
	
	
	<p>
		<strong><?php echo __('Original Image');?>:</strong>
	</p>
	<img class="original" id="full_size_img" src="<?php echo URL::base(); ?>uploads/<?php echo $order->image;?>"/>
<?php }?>
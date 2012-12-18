<?php defined('SYSPATH') or die('No direct script access.');?>



<?php echo Form::open(NULL, array('id'=>'edit_product_form', 'enctype'=>'multipart/form-data')); ?>
	<h1 id="product_title"><?php echo $product->title;?></h1>
	<div id="images">
		<img id="base_img" src="<?php echo URL::base()?>uploads/<?php echo $product->image; ?>"/>
		<?php if($order != null) {?>
			<img id="top_img" style="top:<?php echo $order->y_offset;?>px;left:<?php echo $order->x_offset;?>px;" width="<?php echo $order->width;?>" height="<?php echo $order->height;?>" src="<?php echo URL::base(); ?>uploads/<?php echo $order->image;?>"/>
			<?php echo Form::hidden('order_id',$order->id, array('id'=>'order_id')); ?>	
		<?php }?>		
	</div>
	<?php if($order != null) {?>
		Adjust image position: 
		<a href="#" onclick="imgMove('up'); return false;">Up</a>
		<a href="#" onclick="imgMove('down'); return false;">Down</a> 
		<a href="#" onclick="imgMove('left'); return false;">Left</a> 
		<a href="#" onclick="imgMove('right'); return false;">Right</a>
		<br/>  
	<?php }?>		
	<p id="product_description"><?php echo $product->description;?></p>
	<?php if($order == null) {?>
		<label for="file">Image:</label>
	<?php } else {?>
		<label for="file">Choose new Image:</label>
	<?php }?>
	<?php echo Form::file('image', array('id'=>'image', 'onchange'=>"$('#upload_button').show('slow');")); ?> 
	<br />
	<?php echo Form::hidden('GUID',$guid, array('id'=>'GUID')); ?>
	<?php echo Form::submit('submit', __('Upload'), array('id'=>'upload_button', 'style'=>'display:none;'));?>
<?php echo Form::close(); ?>

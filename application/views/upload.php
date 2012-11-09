<?php defined('SYSPATH') or die('No direct script access.');?>



<?php echo Form::open(NULL, array('id'=>'edit_product_form', 'enctype'=>'multipart/form-data')); ?>
	<h1 id="product_title"><?php echo $product->title;?></h1>
	<div id="images">
		<img id="base_img" src="<?php echo URL::base()?>uploads/<?php echo $company_id.'-'.$product_id;?>.jpg"/>
		<?php if($order != null) {?>
			<img id="top_img" style="top:<?php echo $order->y_offset;?>px;left:<?php echo $order->x_offset;?>px;" width="<?php echo $order->width;?>" height="<?php echo $order->height;?>" src="<?php echo URL::base(); ?>uploads/<?php echo $order->image;?>"/>
			<?php echo Form::hidden('order_id',$order->id, array('id'=>'order_id')); ?>	
		<?php }?>
	</div>
	<p id="product_description"><?php echo $product->description;?></p>
	<label for="file">Image:</label>
	<?php echo Form::file('image', array('id'=>'image')); ?> 
	<br />
	<?php echo Form::hidden('GUID',$guid, array('id'=>'GUID')); ?>
	<?php echo Form::submit('submit', __('Upload'), array('id'=>'upload_button'));?>
<?php echo Form::close(); ?>

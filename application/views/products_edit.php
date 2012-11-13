<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* Categories.php - View
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 12/06/2011
*************************************************************/
?>
		
<h2><?php echo $header; if($data['id']!=0){echo " - Product ID: ".$data['id']."";	} ?></h2>
<p><?php echo __("Product edit explanation");?></p>

<a class="button" id="add_back_to_companies" href="<?php echo url::base(); ?>companies/edit?id=<?php echo $data['company_id'];?>"><?php echo __('back to companies');?></a>

<?php if(count($errors) > 0 )
{
?>
	<div class="errors">
	<?php echo __("error"); ?>
		<ul>
<?php 
	foreach($errors as $error)
	{
?>
		<li> <?php echo $error; ?></li>
<?php
	} 
	?>
		</ul>
	</div>
<?php 
}
?>

<?php if(count($messages) > 0 )
{
?>
	<div class="messages">
		<ul>
<?php 
	foreach($messages as $message)
	{
?>
		<li> <?php echo $message; ?></li>
<?php
	} 
	?>
		</ul>
	</div>
<?php 
}
?>

<div id="product_editor">
<?php 	
	
	echo Form::open(NULL, array('id'=>'edit_product_form', 'enctype'=>'multipart/form-data')); 
	echo Form::hidden('action','edit', array('id'=>'action'));
	echo Form::hidden('order_id',$data['order_id'], array('id'=>'order_id'));
	echo Form::hidden('company_id',$data['company_id'], array('id'=>'company_id'));
	echo '<table><tr><td>';
	echo Form::label('title', __('Title').": ");
	echo '</td><td>';
	echo Form::input('title', $data['title'], array('id'=>'title', 'style'=>'width:300px;'));
	echo '</td></tr><tr><td>';
	echo Form::label('description', __('Description').": ");
	echo '</td><td>';
	echo Form::textarea('description', $data['description'], array('id'=>'description', 'style'=>'width:600px;'));
	echo '</td></tr><tr><td>';
	echo Form::label('image', __('Image').": ");
	echo '</td><td>';
	echo Form::file('image', array('id'=>'image', 'style'=>'width:300px;'));
	if($data['id']!=0)
	{
		echo '<img src="'.url::base().'uploads/'.$data['image'].'"/>';
	}
	echo '</td></tr><tr><td>';
	echo Form::label('x_offset', __('X Offset').": ");
	echo '</td><td>';
	echo Form::input('x_offset', $data['x_offset'], array('id'=>'x_offset', 'style'=>'width:200px;'));
	echo '</td></tr><tr><td>';	
	echo Form::label('y_offset', __('Y Offset').": ");
	echo '</td><td>';
	echo Form::input('y_offset', $data['y_offset'], array('id'=>'x_offset', 'style'=>'width:200px;'));
	echo '</td></tr><tr><td>';
	echo Form::label('width', __('Width').": ");
	echo '</td><td>';
	echo Form::input('width', $data['width'], array('id'=>'x_offset', 'style'=>'width:200px;'));
	echo '</td></tr><tr><td>';
	echo Form::label('height', __('Height').": ");
	echo '</td><td>';
	echo Form::input('height', $data['height'], array('id'=>'x_offset', 'style'=>'width:200px;'));
	echo '</td></tr><tr><td>';
	echo Form::label('variant_id', __('Product ID').": ");
	echo '</td><td>';
	echo Form::input('variant_id', $data['variant_id'], array('id'=>'x_offset', 'style'=>'width:200px;'));	
	echo '</td></tr><tr><td>';
	echo Form::label('iframe_CSS', __('CSS for the contents of the iFrame').": ");
	echo '</td><td>';
	echo Form::textarea('iframe_CSS', $data['iframe_CSS'], array('id'=>'iframe_CSS', 'style'=>'width:600px;'));	
	echo '</td></tr><tr><td>';
	echo Form::label('parent_CSS', __('CSS for parent that holds the iFrame').": ");
	echo '</td><td>';
	echo Form::textarea('parent_CSS', $data['parent_CSS'], array('id'=>'parent_CSS', 'style'=>'width:600px;'));
	echo '</td></tr><tr><td>';
	echo Form::submit('edit', __('add/edit proudct'), array('id'=>'edit_button'));
	echo '</td><td></td></tr></table>';
	echo Form::close();
?>
</table>
</div>


<h2><?php echo __('Orders');?></h2>

<table class="list_table">
	<thead>
		<tr class="header">
			<th style="width:200px;">
				<?php echo __('date');?>
			</th>
			<th style="width:400px;">
				<?php echo __('image');?>
			</th>
			<th style="width:200px;">
				<?php echo __('actions');?>
			</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(count($orders) == 0)
		{
			echo '<tr><td colspan="4">'.__('This product has no orders').'</td></tr>';
		}
		$i = 0;
		foreach($orders as $order){
			$i++;
			$odd_row = ($i % 2) == 0 ? 'class="odd_row"' : '';
		?>

	<tr <?php echo $odd_row; ?>>
		<td style="width:200px;">
			<?php echo $order->date;?>
		</td>
		<td style="width:400px;">
		<a href="<?php echo url::base(); ?>orders?g=<?php echo $order->GUID;?>">
			<img src="<?php echo url::base().'uploads/'. $order->image;?>" height="<?php echo $order->height;?>" width="<?php echo $order->width;?>"/>
		</a>
		</td>		
		<td style="width:200px;">
			<a href="<?php echo url::base(); ?>orders?g=<?php echo $order->GUID;?>"> <?php echo __('view details');?></a>
			<a href="#" onclick="deleteOrder(<?php echo $order->id?>);"> <?php echo __('delete');?></a>
		</td>
	</tr>
	<?php }?>
	</tbody>
</table>




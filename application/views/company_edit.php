<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* Categories.php - View
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 12/06/2011
*************************************************************/
?>
		
<h2><?php echo $header ?></h2>
<p><?php echo __("Company edit explanation");?></p>

<a class="button" id="add_back_to_companies" href="<?php echo url::base(); ?>companies"><?php echo __('back to companies');?></a>

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

<div id="category_editor">
<?php 	
	echo Form::open(NULL, array('id'=>'edit_company_form')); 
	echo Form::hidden('action','edit', array('id'=>'action'));
	echo Form::hidden('company_id','0', array('id'=>'company_id'));
	echo '<table><tr><td>';
	echo Form::label('name', __('Name').": ");
	echo '</td><td>';
	echo Form::input('name', $data['name'], array('id'=>'name', 'style'=>'width:300px;'));
	echo '</td></tr><tr><td>';
	echo Form::label('description', __('Description').": ");
	echo '</td><td>';
	echo Form::textarea('description', $data['description'], array('id'=>'description', 'style'=>'width:600px;'));
	echo '</td></tr><tr><td>';
	echo Form::submit('edit', __('add/edit company'), array('id'=>'edit_button'));
	echo '</td><td></td></tr></table>';
	echo Form::close();
?>
</table>
</div>


<h2><?php echo __('Products');?></h2>
<?php if($data['id'] != 0){ ?>
<a class="button" id="add_field_button" href="<?php echo url::base(); ?>products?company=<?php echo $data['id'];?>"><?php echo __('add product');?></a>
<br/><br/>
<?php } ?>
<table class="list_table">
	<thead>
		<tr class="header">
			<th style="width:200px;">
				<?php echo __('Product');?>
			</th>
			<th style="width:400px;">
				<?php echo __('description');?>
			</th>
			<th style="width:200px;">
				<?php echo __('actions');?>
			</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(count($products) == 0)
		{
			echo '<tr><td colspan="4">'.__('This company has no products').'</td></tr>';
		}
		$i = 0;
		foreach($products as $product){
			$i++;
			$odd_row = ($i % 2) == 0 ? 'class="odd_row"' : '';
		?>

	<tr <?php echo $odd_row; ?>>
		<td style="width:200px;">
		<a href="<?php echo url::base(); ?>products?id=<?php echo $product->id;?>"><?php echo $product->title;?></a>			
		</td>
		<td style="width:400px;">
			<?php echo $product->description; ?>
		</td>		
		<td style="width:200px;">
			<a href="<?php echo url::base(); ?>products?id=<?php echo $product->id;?>"> <?php echo __('edit');?></a>
			<a href="#" onclick="deleteProduct(<?php echo $product->id?>);"> <?php echo __('delete');?></a>
		</td>
	</tr>
	<?php }?>
	</tbody>
</table>




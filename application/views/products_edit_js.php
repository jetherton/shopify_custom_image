<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* form_edit_js.php - View
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 12/06/2011
*************************************************************/
?>

<script type="text/javascript">
	
	
	
	function deleteOrder(id)
	{
		if (confirm("<?php echo __('are you sure you want to delete this order. All information will be forever lost');?>"))
		{
			$("#order_id").val(id);
			$("#action").val('delete_order');
			$("#edit_product_form").submit();
		}
	}

	
	function editCompany(orderId, name, description)
	{		
		$("#order_id").val(orderId);
		$("#title").val(name);
		$("#description").val(description);

	}
	
	
	
</script>

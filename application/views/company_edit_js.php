<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* form_edit_js.php - View
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 12/06/2011
*************************************************************/
?>

<script type="text/javascript">
	
	
	
	function deleteProduct(id)
	{
		if (confirm("<?php echo __('are you sure you want to delete a product. All orders associated with this product will be lost');?>"))
		{
			$("#product_id").val(id);
			$("#action").val('delete_product');
			$("#edit_company_form").submit();
		}
	}

	
	function editCompany(companyId, name, description)
	{		
		$("#company_id").val(companyId);
		$("#title").val(name);
		$("#description").val(description);

	}
	
	
	
</script>

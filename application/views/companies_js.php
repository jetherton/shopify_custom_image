<?php defined('SYSPATH') or die('No direct script access.');
/***********************************************************
* forms_js.php - View
* This software is copy righted by Etherton Technologies Ltd. 2011
* Writen by John Etherton <john@ethertontech.com>
* Started on 12/06/2011
*************************************************************/
?>

<script type="text/javascript">
	
	function deleteCompany(id)
	{
		if (confirm("<?php echo __('are you sure you want to delete a company? All of it\'s products and orders will be lost?');?>"))
		{
			$("#company_id").val(id);
			$("#action").val('delete');
			$("#edit_form_form").submit();
		}
	}
</script>

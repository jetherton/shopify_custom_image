var universalUp = null;

function Uploader(elementId, company_id, product_id)
{
	this.makeGUID = function  ()
	{
	    var S4 = function ()
	    {
	        return Math.floor(
	                Math.random() * 0x10000 /* 65536 */
	            ).toString(16);
	    };

	    return (
	            S4() + S4() + "-" +
	            S4() + "-" +
	            S4() + "-" +
	            S4() + "-" +
	            S4() + S4() + S4()
	        );
	}
	
	
	//define the base URL for everything
	this.urlBase = "http://localhost/shopify_custom_image/";
	
	//store the input from the user
	this.company_id = company_id;
	this.product_id = product_id;
	this.element=elementId;
	this.guid = this.makeGUID();
	
	//insert some css
	var headID = document.getElementsByTagName("head")[0];         
	var cssNode = document.createElement('link');
	cssNode.type = 'text/css';
	cssNode.rel = 'stylesheet';
	cssNode.href = this.urlBase+"frmupload/css?c="+company_id+"&p="+product_id;
	cssNode.media = 'screen';
	headID.appendChild(cssNode);
	
	//setup the iframe
	//get a handle on the root element
	var rootElement = document.getElementById(elementId);	
	//create the iframe for the file loader
	this.iframe = document.createElement("iframe");
	this.iframe.id = "cstm_img_frm" + company_id + "_" + product_id;
	this.iframe.className += "cstm_img_frm";
	this.iframe.src= this.urlBase+"frmupload?c="+company_id+"&p="+product_id+"&g="+this.guid;
	rootElement.appendChild(this.iframe);
	
	//set the gloabal point to this		
	universalUp = this;
	

	
	this.getCstmFileData = function() 
	{
		//finish this
	};
		
	//date call back
	this.setCstmFileData = function(date) 
	{
			//need to finish
	};
}
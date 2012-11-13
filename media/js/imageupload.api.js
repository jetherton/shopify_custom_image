var universalUp = null;

function Uploader(elementId, company_id, product_id, variantSelectorId, variantValue)
{
	var This = this;
	
	
	
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
	this.urlBase = "http://ethertontech.com/dev/superimpose/";
	
	//store the input from the user
	this.company_id = company_id;
	this.product_id = product_id;
	this.element=elementId;
	this.guid = null;
	

	
	this.init = function()
	{
	
		this.guid = this.makeGUID();
		
		//insert some css
		var headID = document.getElementsByTagName("head")[0];         
		this.cssNode = document.createElement('link');
		this.cssNode.type = 'text/css';
		this.cssNode.rel = 'stylesheet';
		this.cssNode.href = this.urlBase+"frmupload/css?c="+company_id+"&sp="+product_id;
		this.cssNode.media = 'screen';
		headID.appendChild(this.cssNode);
		
		//setup the iframe
		//get a handle on the root element
		var rootElement = document.getElementById(elementId);	
		//create the iframe for the file loader
		this.iframe = document.createElement("iframe");
		this.iframe.id = "cstm_img_frm" + company_id + "_" + product_id;
		this.iframe.className += "cstm_img_frm";
		this.iframe.src= this.urlBase+"frmupload?c="+company_id+"&sp="+product_id+"&g="+this.guid;
		rootElement.appendChild(this.iframe);
		
		//create the custom fields that pass our info on to the cart
		this.guidInput = document.createElement("input");
		this.guidInput.id = "cstm_img_guid_" + product_id;
		this.guidInput.name = "properties[cstm_img_guid]";
		this.guidInput.value = this.guid;
		this.guidInput.type = "hidden";
		rootElement.appendChild(this.guidInput);
	}
	
	this.deInit = function()
	{
		if(this.iframe != null && typeof (this.iframe) != "undefined")
		{
			var rootElement = document.getElementById(elementId);			
			rootElement.removeChild(this.iframe);
			rootElement.removeChild(this.guidInput);
			this.iframe = null;
			this.guidInput = null;
			
			var head = document.getElementsByTagName("head")[0];
			head.removeChild(this.cssNode);
		}
		
		this.guid = null;
	}
	
	//*********************************************************************************************************/
	// The actual constructing of stuff
	//*********************************************************************************************************/
	
	//how many images have we uploaded so far?
	if(typeof variantSelectorId == "undefined" || variantSelectorId == null || typeof variantValue == "undefined" || variantValue == null)
	{
		this.variantSelectorId = null;
		this.variantValue = null;
		//no selector given, so just initialize things
		this.init();
	}
	else
	{		
		//they gave us a variant selector and value, so set things to switch on and off based on that
		this.variantSelectorId = variantSelectorId;
		this.variantValue = variantValue;
		this.variantSelector = document.getElementById(variantSelectorId);
		if(this.variantSelector != null)
		{
			this.variantSelector.onchange = function()
			{
				//if it equals the value
				if(This.variantSelector.value == This.variantValue)
				{
					This.init();
				}
				//it's not equal, shut it down
				else
				{
					This.deInit();
				}
			};
		}
	}
}
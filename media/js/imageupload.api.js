var universalUp = null;

function Uploader(elementId, company_id, product_id, count)
{
	//how many images have we uploaded so far?
	if(typeof count == "undefined" || count==null || count == '')
	{
		this.count = 0;
	}
	else
	{
		this.count = parseInt(count);
	}
	
	//increment the count counting ourselves
	this.count++;

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
	this.guid = this.makeGUID();
	
	//insert some css
	var headID = document.getElementsByTagName("head")[0];         
	var cssNode = document.createElement('link');
	cssNode.type = 'text/css';
	cssNode.rel = 'stylesheet';
	cssNode.href = this.urlBase+"frmupload/css?c="+company_id+"&sp="+product_id;
	cssNode.media = 'screen';
	headID.appendChild(cssNode);
	
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
	
	//create the custom fields that updates the count
	this.countInput = document.createElement("input");
	this.countInput.id = "upimgcount";
	this.countInput.name = "attributes[upimgcount]";
	this.countInput.value = this.count;
	this.countInput.type = "hidden";
	rootElement.appendChild(this.countInput);

}
/*
===========================================================
AJAX Routine Class
Author  :Eko Heri
Version :1.0
===========================================================
*/

function Ajax()
{
		var http_request = false;
 		//var _datareturn='';//data return
		var _postvalue='';//get data from form value
		var _method='';//get or post
		var _url='';//url address
		var _responsetype='';//text or xml
		var _formobject;//form id
		var _documentid='';//get document id
		
		function setMethod(setValue){
			_method=setValue;
			return false;
		}
		this.setMethod=setMethod;
		
		function setUrl(setValue){
			_url=setValue;
		}
		this.setUrl=setUrl;
		
		function setResponseType(setValue){
			_responsetype=setValue;
		}
		this.setResponseType=setResponseType;
		
		function setDocumentId(setValue){
			_documentid=setValue;
		}
		this.setDocumentId=setDocumentId;
		
		function setFormObject(setValue){
			_formobject=setValue;
		}
		this.setFormObject=setFormObject;
		
		function createRequest()
		{

     	http_request = false ;
     	if (window.XMLHttpRequest) 
     	{ // Mozilla, Safari ,...
         http_request = new XMLHttpRequest();
         if (http_request.overrideMimeType) 
         {
             http_request.overrideMimeType('text/xml');
             // See note below about this line
       	 }
     	 } 
     	 else 
   	   if (window.ActiveXObject) 
   	 	 { // IE
       		var aVersions = [ "MSXML2.XMLHttp.6.0", 
           "MSXML2.XMLHttp.5.0", 
           "MSXML2.XMLHttp.4.0", 
           "MSXML2.XMLHttp.3.0", 
           "Microsoft.XMLHTTP" ];
       		for (var i = 0; i < aVersions.length; i++) 
       		{
           	try 
           	{ 
           			http_request = new ActiveXObject(aVersions[ i ]);
               	break;
           	}
           	catch (e)
           	{
               // Do nothing 
           	} 
       	  }//end for
   			}//end if window.ActiveXObject
	     	if (!http_request) 
	     	{
	         alert ('Giving up :( Cannot create an XMLHTTP instance');
	         return false;
	     	}
	     	
	     	var timestamp = new Date();
  			var uniqueURI = _url+ (_url.indexOf("?") > 0 ? "&" : "?")+ "timestamp="+ timestamp.getTime();
	     	
	     	if(_method=="get")
	     	{
     			http_request.open('GET', uniqueURI, true);
     			http_request.onreadystatechange = handleResponse;
     			http_request.send(null);
     		}
     		else
     		{
     			if(!_formobject)return false;
     			for(i = 0; i < _formobject.length; i++)
       		{
	       	   if (_postvalue.length) _postvalue += '&';
	       	   switch(_formobject.elements[i].type)
	       	   {
	       	   	  case "text":
	       	   	  	_postvalue += _formobject.elements[i].name + '=' + encodeURI(_formobject.elements[i].value);
	       	   	  break;
	       	   	  case "password":
	       	   	  	_postvalue += _formobject.elements[i].name + '=' + encodeURI(_formobject.elements[i].value);
	       	   	  break;
	       	   	  case "textarea":
	       	   	  	_postvalue += _formobject.elements[i].name + '=' + encodeURI(_formobject.elements[i].value);
	       	   	  break;
	       	   	  case "hidden":
	       	   	  	_postvalue += _formobject.elements[i].name + '=' + encodeURI(_formobject.elements[i].value);
	       	   	  break;
				  case "radio":
				    if(_formobject.elements[i].checked)
 					   _postvalue += _formobject.elements[i].name + '=' + encodeURI(_formobject.elements[i].value);
				  break;
				  case "checkbox":
				    if(_formobject.elements[i].checked)
 					   _postvalue += _formobject.elements[i].name + '=' + encodeURI(_formobject.elements[i].value);
				  break;
	       	   	  case "select":
	       	   	  	if(_formobject.elements[i].selectedIndex>=0)
	       	   	  	{
	       	   	  		_postvalue += _formobject.elements[i].options[_formobject.elements[i].selectedIndex-1].value;
	           		}
	       	   	  break;
	       	   	}//end switch
       		}//end for
     			http_request.open('POST', uniqueURI, true);
     			http_request.onreadystatechange = handleResponse;
     			http_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
     			http_request.send(_postvalue);
     			for(i = 0; i < _formobject.length; i++)
	   		 	{
					 if((_formobject.elements[i].type=="text")||
					    (_formobject.elements[i].type=="textarea")||
					    (_formobject.elements[i].type=="hidden")||
						(_formobject.elements[i].type=="radio")||
					    (_formobject.elements[i].type=="password"))
						 _formobject.elements[i].value="";
	   		 	}
	   		 	
     		}//end else
		}//end function
		this.createRequest=createRequest;
		
		function handleResponse()
		{
			if (http_request.readyState == 4) 
			{
        if (http_request.status == 200) 
        {
        		var docid=new Array();
        		var i;
        		docid=_documentid.split('~');
        		
        	  if(_responsetype=="text")
        	  {
        	  	var responsetxt=new Array();
        	  	responsetxt=http_request.responseText.split('|');
        	  	
        	  	for(i=0;i<docid.length;i++)
        	  	{
            		document.getElementById(docid[i]).innerHTML=''+responsetxt[i];
            	}
            }
            else if(_responsetype=="xml")
            	alert(http_request.responseXML);
      
        } else alert('There was a problem with the request.');
    	}//else alert('There was a problem with the request '+http_request.readyState);
    	return false;
		}//end function
}//end class

function doRequest(requestmethod, urladdress, responsetype, documentid, formobject){
	try
	{
		var obj=new Ajax();
		obj.setMethod(requestmethod);
		obj.setUrl(urladdress);
		obj.setResponseType(responsetype);
		obj.setDocumentId(documentid);
		if(formobject)
		{
			obj.setFormObject(formobject);
		}
		obj.createRequest();
	}catch(ex)
	{
		alert(ex.message);
	}
}

function pausecomp(millis){
	var date = new Date();
	var curDate = null;

	do { curDate = new Date(); }
	while(curDate-date < millis);
}

function openUrl(url,where)
{
 doRequest('get',url,'text',where);
}	

var XMLHttpRequestObject=false;
if (window.XMLHttpRequest) {
  XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
  XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHttp");
}
function getdata(url,respon) {
  if (XMLHttpRequestObject) {
    var obj = document.getElementById(respon);

    XMLHttpRequestObject.open("GET", url);
    XMLHttpRequestObject.onreadystatechange = function() {
    if (XMLHttpRequestObject.readyState == 1) {
      obj.innerHTML = "Loading...";
		
	    }
    if (XMLHttpRequestObject.readyState == 4 && 

XMLHttpRequestObject.status == 200) {
      obj.innerHTML = XMLHttpRequestObject.responseText;
    }
    }
  XMLHttpRequestObject.send(null);
  }
}



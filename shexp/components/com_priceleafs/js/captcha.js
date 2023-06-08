var httpRequest;

function createHttpRequest()
{
	var ret;

	try
	{
		ret = new ActiveXObject("Microsoft.XMLHTTP");
	}
	catch(e)
	{
		ret = new XMLHttpRequest();
	}
	
	return ret;
}

function request(method, uri, params)
{
	if(!httpRequest)
		httpRequest = createHttpRequest();
	
	httpRequest.open(method, uri, true);
	if(params)
	{
		httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		httpRequest.setRequestHeader("Content-length", params.length);
	}
	httpRequest.setRequestHeader("Connection", "close");
	
	httpRequest.onreadystatechange = getRequest;
	httpRequest.send(params);
}

function getRequest()
{
	if(httpRequest.readyState == 4)
	{
		try
		{
			var txt = httpRequest.responseText;
			if(txt.indexOf('good') != -1)
			{
			var soobshenie = document.getElementById('textcaptcha').value;
			if (document.getElementById('total_priceobshee').value>0) { document.getElementById('message').innerHTML = '<input type="submit" value="'+soobshenie+'" name="submit">';} else {alert (document.getElementById('textcaptcha_otpravit').value);}
				
			}
			else if(txt.indexOf('error') != -1)
			{
			var soobshenieerror = document.getElementById('textcaptchaerror').value;
				document.getElementById('message').innerHTML = soobshenieerror;
				captcha();
			}
			else
			{
				draw(txt);
			}
		}
		catch(e)
		{
			return false;
		}
	}
}

function draw(code)
{
	var canvas = document.getElementById('captcha');
				
	if(!canvas.getContext)
		return;
	
	var img, ctx = canvas.getContext('2d');

	if(ctx.createImageData)
		img = ctx.createImageData(140, 35);
	else if(ctx.getImageData)
		img = ctx.getImageData(0, 0, 140, 35);
	else
		img = {'width' : w, 'height' : h, 'data' : new Array(140 * 35 * 4)};
	
	eval(code);
	
	for(var j = 0; j < 35; j++)
	{
		for(var i = 0; i < 140; i++)
		{
			var idx = (i + j * 140) * 4;
			
			img.data[idx + 0] = colorArray[idx + 0];
			img.data[idx + 1] = colorArray[idx + 1];
			img.data[idx + 2] = colorArray[idx + 2];
			img.data[idx + 3] = colorArray[idx + 3];
		}
	}
	ctx.putImageData(img, 0, 0);
}

function captcha()
{
	request('GET', '/components/com_priceleafs/js/captcha.php?get', '');
}

function check_captcha()
{
	var cap = document.getElementById('cap').value;
	if(cap.length < 1)
	{
	var uvedomlenie = document.getElementById('uvedomlenie').value;
		alert(uvedomlenie);
		return false;
	}
	request('POST', '/components/com_priceleafs/js/captcha.php', 'cap='+cap);
}
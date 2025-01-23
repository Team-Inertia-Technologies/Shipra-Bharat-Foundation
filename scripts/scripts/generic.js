function str_trim(str) // strips of leading and following whitespaces from a string
{	
	//DumpProperties(str);
	
	if(str.length > 0)
		while(str.charAt(0)==' ')
			str = str.substr(1);
		
	if(str.length > 0)
		while(str.charAt((str.length - 1))==' ')
			str = str.substring(0, str.length-1);
	
	return str;
}

function ToggleVisibility(obj_id)
{
	var obj = document.getElementById(obj_id);
	if(!obj)
		return false;
	
	obj.style.display = (obj.style.display=='none')? '': 'none';
}

function GoToPage(page)
{
	window.document.location.href=page;
}

function numbersonly(e)
{
	var unicode = e.charCode ? e.charCode : e.keyCode;
	
	if(unicode != 8 && unicode!=46 && unicode!=43 )//if the key isn't the backspace key (which we should allow)
	{
		if((unicode < 48 || unicode > 57) || (unicode==40 || unicode==41 || unicode==43 || unicode==45 || unicode==16))   //if not a number
				return false;  //disable key press
		else
			return true;   // enable keypress
	}
	else
	{
		return true;   // enable keypress
	}
}

function validate_email(email_txt) // validates a string as a email id
{
	var emailReg = "^[\\w-_\.]*[\\w-_\.]\@([\\w].+)\.[\\w]$";
	var regex = new RegExp(emailReg);
	return regex.test(email_txt);
}

function GetRadioValue(rd_obj)
{
	for(var xi=0; xi < rd_obj.length; xi++)
	{
		if(rd_obj[xi].checked)
			return rd_obj[xi].value;
	}

	return false;
}
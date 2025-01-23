var ajax_url = 'includes/ajax.inc.php';

try 
{
	http = new XMLHttpRequest(); /* e.g. Firefox */
	http2 = new XMLHttpRequest(); /* e.g. Firefox */
} 
catch(e) 
{
	try 
	{
    	http = new ActiveXObject("Msxml2.XMLHTTP"); 
		http2 = new ActiveXObject("Msxml2.XMLHTTP"); 
  	}
	catch (e) 
	{
    	try 
		{
    		http = new ActiveXObject("Microsoft.XMLHTTP");  /* some versions IE */
    		http2 = new ActiveXObject("Microsoft.XMLHTTP");  /* some versions IE */
    	} 
		catch (E) 
		{
			http = false;
			http2 = false;
		} 
	} 
}

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

function RemoveRow(tr_id)
{
	var tr_obj = document.getElementById(tr_id);
	if(tr_obj) tr_obj.parentNode.removeChild(tr_obj);
}

function ConfirmDelete(txt, page)
{
	var msg = "You Are About To Delete this " + txt + "! Continue?";

	if(confirm(msg))
		window.document.location.href=page;
}

function ChangeStatus(obj, mode, status, id)
{
	$.get(ajax_url, {response:'UPDATE_STATUS', mode:mode, status:status, id:id}, function(results) {
		var result = results.split('~');
		obj.parentNode.innerHTML=result[0];		
		$('#LBL_INFO').html(NotifyThis(result[1], 'success'));
		// InitNotifyClose();
	});	// */
}

function ChangeFeatured(obj, mode, status, id)
{
	$.get(ajax_url, {response:'UPDATE_FEATURE', mode:mode, status:status, id:id}, function(results) {
		var result = results.split('~');
		obj.parentNode.innerHTML=result[0];		
		$('#LBL_INFO').html(NotifyThis(result[1], 'success'));
		// InitNotifyClose();
	});	// */
}

function NotifyThis(text, mode)
{
	var mode_str = 'msgalert';
	var mode_icon = 'flaticon-questions-circular-button';
	
	if(mode == 'success') mode_str = 'success';
	else if(mode == 'error') mode_str = 'danger';
	else if(mode == 'info') mode_str = 'warning';

	if(mode == 'success') mode_icon = 'flaticon2-check-mark';
	else if(mode == 'error') mode_icon = 'flaticon2-cross';
	else if(mode == 'info') mode_icon = 'flaticon-warning';

	text = str_trim(text);
	return (text!='')? ' <div class="alert alert-custom alert-light-'+ mode_str +' fade show mb-5" role="alert"><div class="alert-icon"><i class="'+ mode_icon +'"></i></div><div class="alert-text">'+text+'</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>': '';
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

function GetRadioValue(rd_obj)
{
	for(var xi=0; xi < rd_obj.length; xi++)
	{
		if(rd_obj[xi].checked)
			return rd_obj[xi].value;
	}

	return false;
}

function IsCodeUnique(id, obj, mode, prefix)
{
	var val = obj.value;
	if(!prefix || prefix == "undefined")
		prefix = '';

	$.get(ajax_url, {response:'UNIQUE_CODE', id:id, val:val, mode:mode}, function(results) {
		var ctrl_obj = document.getElementById(prefix+'code_flag');
		if(ctrl_obj)
		{
			ctrl_obj.value = results;
			obj.style.backgroundColor = (ctrl_obj.value=='0')? "#ffcfcf": "#cfffcf";
		}
	});
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

function ArrayIndex(arr, str)
{
	var ret_val = -1;
	var arr_len = 0;

	arr_len = arr.length;

	if(arr_len > 0)
	{
		for(var i=0; i < arr_len; i++)
		{			
			if(str_trim(arr[i]," ") == str)
			{
				ret_val = i;
				break;
			}
		}
	}

	return ret_val;
}

function inArray(srch_txt, arr)
{	
	for(var i=arr.length-1; i>=0; i--)
	{
		if(str_trim(arr[i]," ") == srch_txt)
			return true;
	}
	
	return false;
}

function setChecked(obj)
{
//	alert('1');
	var frm = obj.form;	
	var id = obj.value;
//	alert('2');
	
	var chk = obj.checked;
//	alert('3');
	
//	alert(frm + ' || ' + id );
	if(!frm || !id)
		return false;
//	alert('4');
	
	frm.multi_ids.value = str_trim(frm.multi_ids.value);
//	alert('5');

	if(chk) // adding
	{
//	alert('6');
		if(frm.multi_ids.value=='')
		{
			frm.multi_ids.value = id + ",";	
		}
		else
		{
			var id_arr = frm.multi_ids.value.split(",");
			var flag = inArray(id, id_arr);

			if(!flag)
			{	
				frm.multi_ids.value += " " + id + ",";
			}
		}
	}
	else // removing
	{ 
//	alert('7');
		if(frm.multi_ids.value!='')
		{
			var id_arr = frm.multi_ids.value.split(",");
			var id_len = id_arr.length;
			var rmv_index = ArrayIndex(id_arr, id);
			
			if(rmv_index > -1)
			{
				for(var i=rmv_index; i < id_arr.length; i++)
				{
					if(i != (id_arr.length - 1)) // not the last element in the array
					{
						id_arr[i] = id_arr[i+1];
					}
				}

				id_arr.length = (id_len - 1); // pop off the last array item
			}
			
			frm.multi_ids.value = id_arr.join(",");
		}
	}
//	alert('8');
}

function checkAll(frm)
{
	var elem_arr = frm.elements;
	var elem_len = elem_arr.length;

	for(var i=0; i<elem_len; i++)
	{
		if(elem_arr[i].type=='checkbox' && elem_arr[i].name=='c[]')
		{
			elem_arr[i].checked = true;
			setChecked(elem_arr[i]);
		}	
	}
	//document.getElementById('check').style.display="none";
	//document.getElementById('uncheck').style.display="inline";
}

function uncheckAll(frm)
{
	var elem_arr = frm.elements;
	var elem_len = elem_arr.length;

	for(var i=0; i<elem_len; i++)
	{
		if(elem_arr[i].type=='checkbox' && elem_arr[i].name=='c[]')
		{
			elem_arr[i].checked = false;
			setChecked(elem_arr[i]);
		}	
	}
	//document.getElementById('uncheck').style.display="none";
	//document.getElementById('check').style.display="inline";
}
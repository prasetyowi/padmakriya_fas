function cekNumber(e)
{
	var key = window.event ? e.keyCode : e.which;
	var keychar = String.fromCharCode(key);
	reg = /\d/;
	reg2 = //
	ret = false;
	if(reg.test(keychar) || keychar == '.')
	{
		ret = true;
	}
	return ret;

}

function addCommas(n){
	n = String(n).replace(/\./g,",");
    var rx=  /(\d+)(\d{3})/;
    return String(n).replace(/\d+/, function(w){
        while(rx.test(w)){
            w= w.replace(rx, '$1.$2');
        }
        return w;
    });
}

function removeCommas2(n){
    return n.replace(/\./g,"");
}
function removeCommas(n){
    return n.replace(/\./g,"").replace(/\,/g,".");
}


function extractNumber(obj, decimalPlaces, allowNegative, withThousand)
{
	withThousand = (typeof withThousand == 'undefined' ? 0 : withThousand);
	var temp = removeCommas2(obj.value);

	if(obj.value == '')
	{
		obj.value = '0';
		return true;
	}


	// avoid changing things if already formatted correctly
	var reg0Str = '[0-9]*';
	if (decimalPlaces > 0) {
		reg0Str += '\\,?[0-9]{0,' + decimalPlaces + '}';
	} else if (decimalPlaces < 0) {
		reg0Str += '\\,?[0-9]*';
	}
	reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
	reg0Str = reg0Str + '$';
	var reg0 = new RegExp(reg0Str);
	if (reg0.test(temp))
	{
		if(withThousand == 0)
		{
			obj.value = addCommas(temp);
		}
		return true;
	}

	// first replace all non numbers
	var reg1Str = '[^0-9' + (decimalPlaces != 0 ? ',' : '') + (allowNegative ? '-' : '') + ']';
	var reg1 = new RegExp(reg1Str, 'g');
	temp = temp.replace(reg1, '');

	if (allowNegative) {
		// replace extra negative
		var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
		var reg2 = /-/g;
		temp = temp.replace(reg2, '');
		if (hasNegative) temp = '-' + temp;
	}

	if (decimalPlaces != 0) {
		var reg3 = /\,/g;
		var reg3Array = reg3.exec(temp);
		if (reg3Array != null) {
			// keep only first occurrence of .
			//  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
			var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
			reg3Right = reg3Right.replace(reg3, '');
			reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
			temp = temp.substring(0,reg3Array.index) + ',' + reg3Right;
		}
	}

	if(withThousand == 0)
	{
		obj.value = addCommas(temp);
	}
	if(obj.value == '')
	{
		obj.value = '0';
	}
}

function extractNumber2(obj, decimalPlaces, allowNegative, withThousand)
{
	withThousand = (typeof withThousand == 'undefined' ? 0 : withThousand);
	var temp = obj.value;

	if(obj.value == '')
	{
		obj.value = '0';
		return true;
	}


	// avoid changing things if already formatted correctly
	var reg0Str = '[0-9]*';
	if (decimalPlaces > 0) {
		reg0Str += '\\.?[0-9]{0,' + decimalPlaces + '}';
	} else if (decimalPlaces < 0) {
		reg0Str += '\\.?[0-9]*';
	}
	reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
	reg0Str = reg0Str + '$';
	var reg0 = new RegExp(reg0Str);
	if (reg0.test(temp))
	{
		if(withThousand == 0)
		{
			obj.value = temp;
		}
		return true;
	}

	// first replace all non numbers
	var reg1Str = '[^0-9' + (decimalPlaces != 0 ? '.' : '') + (allowNegative ? '-' : '') + ']';
	var reg1 = new RegExp(reg1Str, 'g');
	temp = temp.replace(reg1, '');

	if (allowNegative) {
		// replace extra negative
		var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
		var reg2 = /-/g;
		temp = temp.replace(reg2, '');
		if (hasNegative) temp = '-' + temp;
	}

	if (decimalPlaces != 0) {
		var reg3 = /\./g;
		var reg3Array = reg3.exec(temp);
		if (reg3Array != null) {
			// keep only first occurrence of .
			//  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
			var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
			reg3Right = reg3Right.replace(reg3, '');
			reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
			temp = temp.substring(0,reg3Array.index) + '.' + reg3Right;
		}
	}

	if(withThousand == 0)
	{
		obj.value = temp;
	}
	if(obj.value == '')
	{
		obj.value = '0';
	}
}
function blockNonNumbers(obj, e, allowDecimal, allowNegative)
{
	var key;
	var isCtrl = false;
	var keychar;
	var reg;

	if(window.event) {
		key = e.keyCode;
		isCtrl = window.event.ctrlKey
	}
	else if(e.which) {
		key = e.which;
		isCtrl = e.ctrlKey;
	}

	if (isNaN(key)) return true;

	keychar = String.fromCharCode(key);

	// check for backspace or delete, or if Ctrl was pressed
	if (key == 8 || isCtrl)
	{
		return true;
	}

	reg = /\d/;
	var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
	var isFirstD = allowDecimal ? keychar == ',' && obj.value.indexOf(',') == -1 : false;

	return isFirstN || isFirstD || reg.test(keychar);
}

function parseFloat2(val){
	v = parseFloat(val);
	if(isNaN(v)){
		return 0;
	}
	else{
		return v;
	}
}

function convertYMDHIStoDMYHIS(tgl){
	tgl3 = '';
	if(tgl != "" && tgl){
		tgl3 = tgl;
		var tgl4 = tgl.split(' ');
		if(tgl4.length == 2){
			var tgl2 = tgl4[0].split('-');
			if(tgl2.length == 3){
				tgl3 = tgl2[2]+'/'+tgl2[1]+'/'+tgl2[0] + ' '+tgl4[1];
			}
		}
	}
	return tgl3;
}

function convertYMDHIStoDMY(tgl){
	tgl3 = '';
	if(tgl != "" && tgl){
		tgl3 = tgl;
		var tgl4 = tgl.split(' ');
		if(tgl4.length == 2){
			var tgl2 = tgl4[0].split('-');
			if(tgl2.length == 3){
				tgl3 = tgl2[2]+'/'+tgl2[1]+'/'+tgl2[0];
			}
		}
	}
	return tgl3;
}
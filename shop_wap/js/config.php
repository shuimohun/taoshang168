<?php
header('Content-Type: application/x-javascript; charset=UTF-8');

$host = '';
if (isset($_SERVER['HTTP_HOST']))
{
    $host = $_SERVER['HTTP_HOST'];
}

//$wap_config_contents
$shop_wap_config_file = './config_' . $host . '.js';

if (is_file($shop_wap_config_file))
{
    include $shop_wap_config_file;
}
else
{
    include './config.js';
}

?>

if (typeof(window.title) == 'undefined')
{
window.title = '商城触屏版';
}

//扩展函数,需要放入lib
function _($str)
{
return $str;
}


function sprintf () {
var regex = /%%|%(\d+\$)?([\-+'#0 ]*)(\*\d+\$|\*|\d+)?(?:\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g
var a = arguments
var i = 0
var format = a[i++]

var _pad = function (str, len, chr, leftJustify) {
if (!chr) {
chr = ' '
}
var padding = (str.length >= len) ? '' : new Array(1 + len - str.length >>> 0).join(chr)
return leftJustify ? str + padding : padding + str
}

var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
var diff = minWidth - value.length
if (diff > 0) {
if (leftJustify || !zeroPad) {
value = _pad(value, minWidth, customPadChar, leftJustify)
} else {
value = [
value.slice(0, prefix.length),
_pad('', diff, '0', true),
value.slice(prefix.length)
].join('')
}
}
return value
}

var _formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
// Note: casts negative numbers to positive ones
var number = value >>> 0
prefix = (prefix && number && {
'2': '0b',
'8': '0',
'16': '0x'
}[base]) || ''
value = prefix + _pad(number.toString(base), precision || 0, '0', false)
return justify(value, prefix, leftJustify, minWidth, zeroPad)
}

// _formatString()
var _formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
if (precision !== null && precision !== undefined) {
value = value.slice(0, precision)
}
return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar)
}

// doFormat()
var doFormat = function (substring, valueIndex, flags, minWidth, precision, type) {
var number, prefix, method, textTransform, value

if (substring === '%%') {
return '%'
}

// parse flags
var leftJustify = false
var positivePrefix = ''
var zeroPad = false
var prefixBaseX = false
var customPadChar = ' '
var flagsl = flags.length
var j
for (j = 0; j < flagsl; j++) {
switch (flags.charAt(j)) {
case ' ':
positivePrefix = ' '
break
case '+':
positivePrefix = '+'
break
case '-':
leftJustify = true
break
case "'":
customPadChar = flags.charAt(j + 1)
break
case '0':
zeroPad = true
customPadChar = '0'
break
case '#':
prefixBaseX = true
break
}
}

// parameters may be null, undefined, empty-string or real valued
// we want to ignore null, undefined and empty-string values
if (!minWidth) {
minWidth = 0
} else if (minWidth === '*') {
minWidth = +a[i++]
} else if (minWidth.charAt(0) === '*') {
minWidth = +a[minWidth.slice(1, -1)]
} else {
minWidth = +minWidth
}

// Note: undocumented perl feature:
if (minWidth < 0) {
minWidth = -minWidth
leftJustify = true
}

if (!isFinite(minWidth)) {
throw new Error('sprintf: (minimum-)width must be finite')
}

if (!precision) {
precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0 : undefined
} else if (precision === '*') {
precision = +a[i++]
} else if (precision.charAt(0) === '*') {
precision = +a[precision.slice(1, -1)]
} else {
precision = +precision
}

// grab value using valueIndex if required?
value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++]

switch (type) {
case 's':
return _formatString(value + '', leftJustify, minWidth, precision, zeroPad, customPadChar)
case 'c':
return _formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad)
case 'b':
return _formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
case 'o':
return _formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
case 'x':
return _formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
case 'X':
return _formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
.toUpperCase()
case 'u':
return _formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
case 'i':
case 'd':
number = +value || 0
// Plain Math.round doesn't just truncate
number = Math.round(number - number % 1)
prefix = number < 0 ? '-' : positivePrefix
value = prefix + _pad(String(Math.abs(number)), precision, '0', false)
return justify(value, prefix, leftJustify, minWidth, zeroPad)
case 'e':
case 'E':
case 'f': // @todo: Should handle locales (as per setlocale)
case 'F':
case 'g':
case 'G':
number = +value
prefix = number < 0 ? '-' : positivePrefix
method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())]
textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2]
value = prefix + Math.abs(number)[method](precision)
return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]()
default:
return substring
}
}

return format.replace(regex, doFormat)
}

function get_ext(filename){
var index1=filename.lastIndexOf(".");

var index2=filename.length;
var postf=filename.substring(index1,index2);//后缀名

return postf;
}

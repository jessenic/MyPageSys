<?php
############ BBCode - v1.0 ############
########### by: NDev / Tompz ##########
######## http://ndev.viuhka.fi/ #######
#######################################
#  Saa levittää ja muokata vapaasti   #
#######################################

//THANKS FOR THIS BBCODE SYSTEM ^^

function BBCode($teksti){

$teksti = nl2br(str_replace('\\r\\n', "\r\n", $teksti));

$code_search = array( // Etsittävät BBCode merkinnät
	'/\[b\](.*?)\[\/b\]/is',
	'/\[i\](.*?)\[\/i\]/is',
	'/\[u\](.*?)\[\/u\]/is',
	'/\[tt\](.*?)\[\/tt\]/is',
	'/\[img\](.*?)\[\/img\]/is',
	'/\[img\=(.*?)\]/is',
	'/\[url\](.*?)\[\/url\]/is',
	'/\[url\=(.*?)\](.*?)\[\/url\]/is',
	'/\[size\=(.*?)\](.*?)\[\/size\]/is',
	'/\[color\=(.*?)\](.*?)\[\/color\]/is',
	'/\[quote\](.*?)\[\/quote\]/is',
	'/\[quote\=(.*?)\](.*?)\[\/quote\]/is',
	'/\[left\](.*?)\[\/left\]/is',
	'/\[right\](.*?)\[\/right\]/is',
	'/\[center\](.*?)\[\/center\]/is'//,
	//'/\[    \](.*?)\[\/      \]/is',
);

$code_replace = array( // BBCode merkinnät korvataan näillä
	'<strong>$1</strong>',
	'<em>$1</em>',
	'<u>$1</u>',
	'<tt>$1</tt>',
	'<img src="$1">',
	'<img src="$1">',
	'<a href="$1" target="_blank">$1</a>',
	'<a href="$1" target="_blank">$2</a>',
	'<font size="$1">$2</font>',
	'<font color="$1">$2</font>',
	'Lainaus:<blockquote><p>$1</p></blockquote>',
	'Lainaus käyttäjältä $1:<blockquote><p>$2</p></blockquote>',
	'<div align="left">$1</div>',
	'<div align="right">$1</div>',
	'<div align="center">$1</div>'//,
	//'',
);

// Tehdään hommat
$teksti = preg_replace ($code_search, $code_replace, $teksti);
// Palautetaan valmis teksti
return $teksti;
}
?>
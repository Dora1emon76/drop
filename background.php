<?php
$type = $argv[4];
$data = json_decode($argv[1],true);
$counter = 0;
$url = $argv[3];



if($type == "fsms"){
$fapi = $argv[2];
$id = explode(" ",$data['result']['reply_markup']['inline_keyboard'][0][0]['callback_data'])[1];


while(true){
if($counter == 80){
break;}
$counter++;
$fdata = file_get_contents("https://otpindia.pro/stubs/handler_api.php?api_key=$fapi&action=getStatus&id=$id");
if($fdata == null || $fdata == "STATUS_WAIT_CODE"){
sleep(15);
continue;}
$otp = explode(':', $fdata); 
 if($otp[0] == "STATUS_OK"){
$data = json_encode(array(
    "callback_query" => array(
        "from" => $data["result"]["chat"],
        "message" => array(
            "message_id" => $data["result"]["message_id"]
        ),
        "data" => $data['result']['reply_markup']['inline_keyboard'][0][0]['callback_data']
    )
));

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST',
        'content' => $data,
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

break;
}elseif($fdata == "STATUS_CANCEL"){

$data = json_encode(array(
    "callback_query" => array(
        "from" => $data["result"]["chat"],
        "message" => array(
            "message_id" => $data["result"]["message_id"]
        ),
        "data" => $data['result']['reply_markup']['inline_keyboard'][0][1]['callback_data']
    )
));

$options = [
    'http' => [
        'header' => "Content-type: application/json\r\n",
        'method' => 'POST',
        'content' => $data,
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

break;}
}}
?>

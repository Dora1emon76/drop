 <?php
$data = json_decode(file_get_contents("php://input"),true);
if(isset($data["type"])){
if($data["type"] == "fsms"){
$command = "php background.php ".("'".$data["data"]."'")." ".$data['fapi']." ".$data['url']." ".$data['type']." > /dev/null 2>&1 &";
}
exec($command);
}
?>

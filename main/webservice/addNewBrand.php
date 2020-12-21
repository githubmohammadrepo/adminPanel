<?php
$url = "http://hypertester.ir/serverHypernetShowUnion/RegisterBrandUP.php";
$post = [
  'brandusername' => $_POST["form"]["brandusername"],
  'brandpassword' => $_POST["form"]["brandpassword"]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
curl_close($ch);
if ($output == "exist") {
  $invalid[] = RSFormProHelper::getComponentId("brandusername");
}
$_SESSION["idusername"] = $output;

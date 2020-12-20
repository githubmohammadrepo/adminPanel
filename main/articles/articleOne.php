{source}<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);


//call cats list webservice
//http://hypernetshow.com/serverHypernetShowUnion/GetCatInfo.php

$url = "http://hypernetshow.com/serverHypernetShowUnion/GetCatInfo.php";
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
 echo curl_error($ch);
 echo "\n<br />";
 $contents = '';
} else {
 curl_close($ch);
}
$contents = json_decode($contents, true);

?>
<div style="display: flex;flex-direction: row;flex-wrap: wrap;">
 
 
<?php
foreach($contents as $category) {
?>
<div style="flex: 25%;display: flex; flex-direction: column;align-items:center;justify-content: center;text-align: center;margin-top: 10px;margin-bottom: 35px;border: 1px solid #c7c7c7; border-radius: 5px;margin-left: 10px; margin-right: 10px;padding: 5px;">
 <img src="<?=$category["cat_image"]?>" style="max-width:100px;max-height:100px;" >
<a href="http://localhost:8080/main/articles/articleTwo.php?cat=<?=$category["category_id"]?>" style="text-decoration: none;">
 <p style="font-weight:bold;font-size:16px;"><?=$category["category_name"]?></p>
</a>

 </div>
<?php
}
?>
</div>{/source}
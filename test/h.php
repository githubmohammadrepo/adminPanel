<?php
/**
 * Created by PhpStorm.
 * User: androiddev
 * Date: 7/17/17
 * Time: 10:49 PM
 */
 
/* error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);*/

include "connection.php";

$userId = $_POST["userid"];
$owner = $_POST["owner"];
$phone = $_POST["phone"];
$fax = $_POST["fax"];
$email = $_POST["email"];
$imgstring = $_POST["imgstring"];

$target_dir_profile = "images/com_hikashop/upload";

$sql = "SELECT * FROM pish_phocamaps_marker_company WHERE user_id = '$userId'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

if($imgstring == ""){
    
    $sql = "UPDATE pish_phocamaps_marker_company SET phone = '$phone', Fax = '$fax', OwnerName = '$owner', description = '$matchUrlProfile', Email = '$email' WHERE user_id = '$userId'";

    if ($conn->query($sql) === TRUE) {
    echo "ok";
} else {
    echo "notok";
}
    
}else{
    
$urlProfileImage = "http://www.fishopping.ir/serverHypernetShowUnion/";

if (!is_dir($target_dir_profile))
{
    mkdir($target_dir_profile, 0777, true);

}

//set random image file name with time
$imageFileName = rand() ."_". time() . ".png";
$target_dir_profile = $target_dir_profile ."/". $imageFileName;

$matchUrlProfile = $urlProfileImage . $target_dir_profile;

if (file_put_contents($target_dir_profile, base64_decode($imgstring))) 
{
    
    $sql = "UPDATE pish_phocamaps_marker_company SET phone = '$phone', Fax = '$fax', OwnerName = '$owner', description = '$matchUrlProfile', Email = '$email' WHERE user_id = '$userId'";

    if ($conn->query($sql) === TRUE) {
        
        $sql_cat = "SELECT * FROM pish_hikashop_category WHERE user_id = '$userId'";

        $result = $conn->query($sql_cat);

        if ($result->num_rows > 0) {
            // output data of each row
                
            $cat_id = $result->fetch_assoc()['category_id'];
        
            $sql3 = "SELECT * FROM pish_hikashop_file WHERE file_ref_id = '$cat_id'";
            
            $result = $conn->query($sql3);
            
            if ($result->num_rows > 0) {
                
                 $sql2 = "UPDATE pish_hikashop_file SET file_path='$imageFileName', file_type='category' WHERE file_ref_id = '$cat_id'";
            
                if ($conn->query($sql2) === TRUE) {
                    
                    echo "ok";
                
                }else{
                    
                    echo "notok";
                
                }
                
            }else{
                
                 $sql2 = "INSERT INTO pish_hikashop_file (file_path, file_type, file_ref_id) VALUES ('$imageFileName', 'category', '$cat_id')";
            
                    if ($conn->query($sql2) === TRUE) 
                    {
                        echo "ok";
                    } else {
                        echo "notok";
                    }
                    
            }
        
        } else {
            
            echo "notok";
        
        }
        
    } else {
        echo "notok";
    }
    
}

}

} else {
    
        echo "notexist";

}

$conn->close();

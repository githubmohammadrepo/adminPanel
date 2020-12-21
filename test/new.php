<?php

include "connection.php";

$sql = "SELECT pish_hikashop_category.category_id,pish_hikashop_category.category_name, pish_hikashop_category.user_id, pish_hikashop_file.file_path as brand_image, COUNT(pish_hikashop_product.product_id) as productsCount FROM pish_hikashop_category 
INNER JOIN pish_hikashop_file ON pish_hikashop_file.file_ref_id = pish_hikashop_category.category_id 
LEFT JOIN pish_hikashop_product ON pish_hikashop_product.product_manufacturer_id = pish_hikashop_category.category_id 
WHERE pish_hikashop_category.category_type='manufacturer' AND pish_hikashop_category.category_parent_id = 10 GROUP BY pish_hikashop_category.category_id";

$imagePath = "http://www.hypertester.ir/images/com_hikashop/upload/";

$result = $conn->query($sql);

$dev_array = array();

if ($result->num_rows > 0) 
{
    // output data of each row
    for ($i = 0; $i < $result-> num_rows; $i++)
    {
        $row = $result->fetch_assoc();
        $dev_array[$i] = $row;
        $dev_array[$i]['brand_image'] = $imagePath . $row['brand_image'];
        
        $cat_id = $row['category_id'];
        
        $sql2 = "SELECT pish_hikashop_category.category_id,pish_hikashop_category.category_name, pish_hikashop_category.user_id, pish_hikashop_file.file_path as brand_image, COUNT(pish_hikashop_product.product_id) as productsCount FROM pish_hikashop_category 
        INNER JOIN pish_hikashop_file ON pish_hikashop_file.file_ref_id = pish_hikashop_category.category_id 
        LEFT JOIN pish_hikashop_product ON pish_hikashop_product.product_manufacturer_id = pish_hikashop_category.category_id 
        WHERE pish_hikashop_category.category_type='manufacturer' AND pish_hikashop_category.category_parent_id = '$cat_id' GROUP BY pish_hikashop_category.category_id";

        $result2 = $conn->query($sql2);
        $sub_array = [];
        if ($result2->num_rows > 0) 
        {
            for ($j = 0; $j < $result2->num_rows; $j++)
            {
                $sub_row = $result2->fetch_assoc();
                $sub_array[$j] = $sub_row;
                $sub_array[$j]['brand_image'] = $imagePath . $sub_row['brand_image'];
                $sub_array[$j]['sub_cat'] = [];

            }
        }
        
        $dev_array[$i]['sub_cat'] = $sub_array;
        
    }
    


    $jsonEncode = json_encode($dev_array, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    echo $jsonEncode;

} else {
    echo "notok";
}
$conn->close();


SELECT  pish_hikashop_category.category_id
       ,pish_hikashop_category.category_name
       ,pish_hikashop_category.user_id
       ,pish_hikashop_file.file_path            AS brand_image
       ,COUNT(pish_hikashop_product.product_id) AS productsCount
FROM pish_hikashop_category
INNER JOIN pish_hikashop_file
ON pish_hikashop_file.file_ref_id = pish_hikashop_category.category_id
LEFT JOIN pish_hikashop_product
ON pish_hikashop_product.product_manufacturer_id = pish_hikashop_category.category_id
WHERE pish_hikashop_category.category_type='manufacturer' 
AND pish_hikashop_category.category_parent_id = 10 
GROUP BY  pish_hikashop_category.category_id




-- optimized section one

SELECT newTables.*
 	,pish_hikashop_category.category_id
    ,pish_hikashop_category.category_name
    ,pish_hikashop_category.user_id 
    ,COUNT(pish_hikashop_product.product_id) AS productsCount
from (SELECT
 pish_hikashop_file.file_path AS brand_image,
 pish_hikashop_file.file_ref_id
FROM pish_hikashop_file limit 0,10) AS newTables
INNER JOIN pish_hikashop_category
ON newTables.file_ref_id = pish_hikashop_category.category_id
LEFT JOIN pish_hikashop_product
ON pish_hikashop_product.product_manufacturer_id = pish_hikashop_category.category_id
WHERE pish_hikashop_category.category_type='manufacturer' 
AND pish_hikashop_category.category_parent_id = 10 
GROUP BY  pish_hikashop_category.category_id


-- optimized section two **working with count 10 time: 0.3333***

SELECT newTables.*
    ,COUNT(pish_hikashop_product.product_id) AS productsCount,
    pish_hikashop_product.product_manufacturer_id
 FROM (SELECT pish_hikashop_category.category_id
    ,pish_hikashop_category.category_name
       ,pish_hikashop_category.category_type
       ,pish_hikashop_category.category_parent_id
    ,pish_hikashop_category.user_id ,
 pish_hikashop_file.file_path AS brand_image,
 pish_hikashop_file.file_ref_id
FROM pish_hikashop_category
INNER JOIN pish_hikashop_file
ON  pish_hikashop_category.category_id = pish_hikashop_file.file_ref_id limit 0,10) AS newTables
LEFT JOIN pish_hikashop_product
ON pish_hikashop_product.product_manufacturer_id = newTables.category_id
WHERE newTables.category_type='manufacturer' 
AND newTables.category_parent_id = 10 
GROUP BY  newTables.category_id



-- optimization three or end
SELECT newTables.*
    ,COUNT(pish_hikashop_product.product_id) AS productsCount,
    pish_hikashop_product.product_manufacturer_id
  pish_hikashop_file.file_path AS brand_image,
  pish_hikashop_file.file_ref_id
 FROM (SELECT pish_hikashop_category.category_id
    ,pish_hikashop_category.category_name
       ,pish_hikashop_category.category_type
       ,pish_hikashop_category.category_parent_id
    ,pish_hikashop_category.user_id ,
FROM pish_hikashop_category limit 0,10) AS newTables
INNER JOIN pish_hikashop_file
ON  pish_hikashop_category.category_id = pish_hikashop_file.file_ref_id
LEFT JOIN pish_hikashop_product
ON pish_hikashop_product.product_manufacturer_id = newTables.category_id
WHERE newTables.category_type='manufacturer' 
AND newTables.category_parent_id = 10 
GROUP BY  newTables.category_id
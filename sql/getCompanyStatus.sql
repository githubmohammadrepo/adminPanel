SELECT NewTable.*,count(product_id) from (SELECT Category.*,pish_hikashop_product.* FROM (SELECT pish_hikashop_category.category_id,pish_hikashop_category.user_id FROM pish_hikashop_category WHERE pish_hikashop_category.user_id IN (1960,
0,
961,
1425,
1439,
1440,
1445,
1514,
1955,1960) )AS Category
LEFT JOIN pish_hikashop_product 
ON Category.category_id = pish_hikashop_product.product_manufacturer_id) as NewTable
GROUP BY user_id
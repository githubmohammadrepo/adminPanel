-- section one
SELECT Company.*
FROM (SELECT  pish_phocamaps_marker_company.id
       ,pish_phocamaps_marker_company.catid
FROM pish_phocamaps_marker_company
WHERE pish_phocamaps_marker_company.id = 127359)as Company


127378
-- section global
SELECT Company.*,pish_hikashop_product.*
FROM (SELECT  pish_phocamaps_marker_company.id
       ,pish_phocamaps_marker_company.catid
FROM pish_phocamaps_marker_company
WHERE pish_phocamaps_marker_company.id = 127359)as Company

INNER JOIN pish_hikashop_product
ON Company.catid = pish_hikashop_product.product_manufacturer_id
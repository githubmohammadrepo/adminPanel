SELECT 
pish_users.id,
pish_users.name,
pish_hikashop_category.category_id,
pish_hikashop_category.user_id,
pish_hikashop_category.category_name,
company.* FROM (SELECT pish_phocamaps_marker_company.id,
pish_phocamaps_marker_company.user_id,
pish_phocamaps_marker_company.RegionID,
pish_phocamaps_marker_company.catid,
pish_phocamaps_marker_company.title,
pish_phocamaps_marker_company.ShopName,
pish_phocamaps_marker_company.phone,
pish_phocamaps_marker_company.alias,
pish_phocamaps_marker_company.ManagerName,
pish_phocamaps_marker_company.MobilePhone,
pish_phocamaps_marker_company.OwnerName,
pish_phocamaps_marker_company.Address,
pish_phocamaps_marker_company.published
FROM `pish_phocamaps_marker_company` limit 0,10) AS company
LEFT JOIN pish_users ON company.user_id = pish_users.id
LEFT JOIN pish_hikashop_category ON company.catid = pish_hikashop_category.category_id
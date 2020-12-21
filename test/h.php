<?php
//<code>
$user= JFactory::getUser();
$id= $user->id;
$db = JFactory::getDbo();
$db->setQuery("SELECT `pish_phocamaps_marker_company`.ShopName
FROM `pish_phocamaps_marker_company` 
INNER JOIN `pish_users` ON `pish_phocamaps_marker_company`.user_id = $id
");
$result = $db->loadresult();
return $result;
//</code>




//<code>
$user= JFactory::getUser();
$id= $user->id;
$db = JFactory::getDbo();
$db->setQuery("SELECT `pish_phocamaps_marker_company`.title
FROM `pish_phocamaps_marker_company` 
INNER JOIN `pish_users` ON `pish_phocamaps_marker_company`.user_id = $id
");
$result = $db->loadresult();
return $result;
//</code>
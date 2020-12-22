اپیدت مرحله دوم
delete from pish_phocamaps_marker_fake where user_id = user_id

insert into  pish_phocamaps_marker_fake set
brandSelectedname = brandSelectedId,
user_id = userid,
title = brandname,
ShopName = CompanyName,
phone = phone,
MobilePhone = MobilePhone,
OwnerName = OwnerName,
Address = Address,
RegCode = RegCode




تایید پیامکی شرکت

updat `pish_phocamaps_markr_company` SET 7
'title'={brandname},
ShopName = {CompanyName},
phone = phone,
ManagerName = OwnerName,
MobilePhone = MobilPhone,
OwnerName = OwnerName,
Address = Address,
sms_confirmed = 1,
where id = brandSelectedId

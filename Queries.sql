-- Query 1
SELECT * FROM aih_facilities JOIN aih_member_physicians ON aih_facilities.fedTaxID=aih_member_physicians.providerTaxID;

-- Query 2
SELECT * FROM aih_facilities JOIN aih_member_physicians ON aih_facilities.fedTaxID=aih_member_physicians.providerTaxID WHERE Member_ID = 1370;

-- Query 3
SELECT * FROM `aih_facility_definition` INNER JOIN `aih_facilities` ON aih_facility_definition.AIHFacilityID = aih_facilities.Facility_ID INNER JOIN `facility_type` ON aih_facility_definition.facilityTypeID = facility_type.facilityTypeID;

-- Query 4
SELECT * FROM `aih_facilities` LEFT JOIN `aih_facility_definition` ON aih_facility_definition.AIHFacilityID = aih_facilities.Facility_ID WHERE aih_facility_definition.AIHFacilityID IS NULL;

-- Query 5
SELECT * FROM `facility_type` LEFT JOIN `aih_facility_definition` ON aih_facility_definition.facilityTypeID = facility_type.facilityTypeID WHERE aih_facility_definition.facilityTypeID IS NULL;

-- Query 6
SELECT * FROM `aih_facility_definition` INNER JOIN `aih_facilities` ON aih_facility_definition.AIHFacilityID = aih_facilities.Facility_ID INNER JOIN `facility_type` ON aih_facility_definition.facilityTypeID = facility_type.facilityTypeID;

-- Query 7
UPDATE `wp_posts` SET guid = REPLACE(guid, '/hajr.golpik.net/', '/assets.hajr.no/') WHERE `post_type` = "attachment";

-- Query 8
SELECT ID, post_name, guid FROM `wp_posts` JOIN `wp_postmeta` WHERE wp_posts.post_type = 'attachment' AND wp_postmeta.meta_key != '_wp_attachment_image_alt';

-- Query 9
SELECT ID, post_name, guid FROM `wp_posts` JOIN `wp_postmeta` WHERE wp_posts.post_type = 'attachment' AND wp_postmeta.meta_key = '_wp_attached_file' AND wp_postmeta.meta_key != '_wp_attachment_image_alt';

-- Query 10
SELECT ID, post_name, guid FROM `wp_posts` JOIN `wp_postmeta` ON wp_posts.ID = wp_postmeta.post_id WHERE wp_posts.post_type = 'attachment' AND wp_postmeta.meta_key != '_wp_attachment_image_alt';
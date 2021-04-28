<?php


namespace ShippingAppointments\Service\User;

use ShippingAppointments\Service\PostType\AvailabilityPost;
use ShippingAppointments\Service\PostType\DepartmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use ShippingAppointments\Service\PostType\SupplierCompanyPost;
use ShippingAppointments\Service\Taxonomy\CountryTaxonomy;

class UserFields {

	const TIME_ZONES = array(
		'Pacific/Midway' => '(UTC-11:00) Midway',
		'Pacific/Niue' => '(UTC-11:00) Niue',
		'Pacific/Pago_Pago' => '(UTC-11:00) Pago Pago',
		'America/Adak' => '(UTC-10:00) Adak',
		'Pacific/Honolulu' => '(UTC-10:00) Honolulu',
		'Pacific/Johnston' => '(UTC-10:00) Johnston',
		'Pacific/Rarotonga' => '(UTC-10:00) Rarotonga',
		'Pacific/Tahiti' => '(UTC-10:00) Tahiti',
		'Pacific/Marquesas' => '(UTC-09:30) Marquesas',
		'America/Anchorage' => '(UTC-09:00) Anchorage',
		'Pacific/Gambier' => '(UTC-09:00) Gambier',
		'America/Juneau' => '(UTC-09:00) Juneau',
		'America/Nome' => '(UTC-09:00) Nome',
		'America/Sitka' => '(UTC-09:00) Sitka',
		'America/Yakutat' => '(UTC-09:00) Yakutat',
		'America/Dawson' => '(UTC-08:00) Dawson',
		'America/Los_Angeles' => '(UTC-08:00) Los Angeles',
		'America/Metlakatla' => '(UTC-08:00) Metlakatla',
		'Pacific/Pitcairn' => '(UTC-08:00) Pitcairn',
		'America/Santa_Isabel' => '(UTC-08:00) Santa Isabel',
		'America/Tijuana' => '(UTC-08:00) Tijuana',
		'America/Vancouver' => '(UTC-08:00) Vancouver',
		'America/Whitehorse' => '(UTC-08:00) Whitehorse',
		'America/Boise' => '(UTC-07:00) Boise',
		'America/Cambridge_Bay' => '(UTC-07:00) Cambridge Bay',
		'America/Chihuahua' => '(UTC-07:00) Chihuahua',
		'America/Creston' => '(UTC-07:00) Creston',
		'America/Dawson_Creek' => '(UTC-07:00) Dawson Creek',
		'America/Denver' => '(UTC-07:00) Denver',
		'America/Edmonton' => '(UTC-07:00) Edmonton',
		'America/Hermosillo' => '(UTC-07:00) Hermosillo',
		'America/Inuvik' => '(UTC-07:00) Inuvik',
		'America/Mazatlan' => '(UTC-07:00) Mazatlan',
		'America/Ojinaga' => '(UTC-07:00) Ojinaga',
		'America/Phoenix' => '(UTC-07:00) Phoenix',
		'America/Shiprock' => '(UTC-07:00) Shiprock',
		'America/Yellowknife' => '(UTC-07:00) Yellowknife',
		'America/Bahia_Banderas' => '(UTC-06:00) Bahia Banderas',
		'America/Belize' => '(UTC-06:00) Belize',
		'America/North_Dakota/Beulah' => '(UTC-06:00) Beulah',
		'America/Cancun' => '(UTC-06:00) Cancun',
		'America/North_Dakota/Center' => '(UTC-06:00) Center',
		'America/Chicago' => '(UTC-06:00) Chicago',
		'America/Costa_Rica' => '(UTC-06:00) Costa Rica',
		'Pacific/Easter' => '(UTC-06:00) Easter',
		'America/El_Salvador' => '(UTC-06:00) El Salvador',
		'Pacific/Galapagos' => '(UTC-06:00) Galapagos',
		'America/Guatemala' => '(UTC-06:00) Guatemala',
		'America/Indiana/Knox' => '(UTC-06:00) Knox',
		'America/Managua' => '(UTC-06:00) Managua',
		'America/Matamoros' => '(UTC-06:00) Matamoros',
		'America/Menominee' => '(UTC-06:00) Menominee',
		'America/Merida' => '(UTC-06:00) Merida',
		'America/Mexico_City' => '(UTC-06:00) Mexico City',
		'America/Monterrey' => '(UTC-06:00) Monterrey',
		'America/North_Dakota/New_Salem' => '(UTC-06:00) New Salem',
		'America/Rainy_River' => '(UTC-06:00) Rainy River',
		'America/Rankin_Inlet' => '(UTC-06:00) Rankin Inlet',
		'America/Regina' => '(UTC-06:00) Regina',
		'America/Resolute' => '(UTC-06:00) Resolute',
		'America/Swift_Current' => '(UTC-06:00) Swift Current',
		'America/Tegucigalpa' => '(UTC-06:00) Tegucigalpa',
		'America/Indiana/Tell_City' => '(UTC-06:00) Tell City',
		'America/Winnipeg' => '(UTC-06:00) Winnipeg',
		'America/Atikokan' => '(UTC-05:00) Atikokan',
		'America/Bogota' => '(UTC-05:00) Bogota',
		'America/Cayman' => '(UTC-05:00) Cayman',
		'America/Detroit' => '(UTC-05:00) Detroit',
		'America/Grand_Turk' => '(UTC-05:00) Grand Turk',
		'America/Guayaquil' => '(UTC-05:00) Guayaquil',
		'America/Havana' => '(UTC-05:00) Havana',
		'America/Indiana/Indianapolis' => '(UTC-05:00) Indianapolis',
		'America/Iqaluit' => '(UTC-05:00) Iqaluit',
		'America/Jamaica' => '(UTC-05:00) Jamaica',
		'America/Lima' => '(UTC-05:00) Lima',
		'America/Kentucky/Louisville' => '(UTC-05:00) Louisville',
		'America/Indiana/Marengo' => '(UTC-05:00) Marengo',
		'America/Kentucky/Monticello' => '(UTC-05:00) Monticello',
		'America/Montreal' => '(UTC-05:00) Montreal',
		'America/Nassau' => '(UTC-05:00) Nassau',
		'America/New_York' => '(UTC-05:00) New York',
		'America/Nipigon' => '(UTC-05:00) Nipigon',
		'America/Panama' => '(UTC-05:00) Panama',
		'America/Pangnirtung' => '(UTC-05:00) Pangnirtung',
		'America/Indiana/Petersburg' => '(UTC-05:00) Petersburg',
		'America/Port-au-Prince' => '(UTC-05:00) Port-au-Prince',
		'America/Thunder_Bay' => '(UTC-05:00) Thunder Bay',
		'America/Toronto' => '(UTC-05:00) Toronto',
		'America/Indiana/Vevay' => '(UTC-05:00) Vevay',
		'America/Indiana/Vincennes' => '(UTC-05:00) Vincennes',
		'America/Indiana/Winamac' => '(UTC-05:00) Winamac',
		'America/Caracas' => '(UTC-04:30) Caracas',
		'America/Anguilla' => '(UTC-04:00) Anguilla',
		'America/Antigua' => '(UTC-04:00) Antigua',
		'America/Aruba' => '(UTC-04:00) Aruba',
		'America/Asuncion' => '(UTC-04:00) Asuncion',
		'America/Barbados' => '(UTC-04:00) Barbados',
		'Atlantic/Bermuda' => '(UTC-04:00) Bermuda',
		'America/Blanc-Sablon' => '(UTC-04:00) Blanc-Sablon',
		'America/Boa_Vista' => '(UTC-04:00) Boa Vista',
		'America/Campo_Grande' => '(UTC-04:00) Campo Grande',
		'America/Cuiaba' => '(UTC-04:00) Cuiaba',
		'America/Curacao' => '(UTC-04:00) Curacao',
		'America/Dominica' => '(UTC-04:00) Dominica',
		'America/Eirunepe' => '(UTC-04:00) Eirunepe',
		'America/Glace_Bay' => '(UTC-04:00) Glace Bay',
		'America/Goose_Bay' => '(UTC-04:00) Goose Bay',
		'America/Grenada' => '(UTC-04:00) Grenada',
		'America/Guadeloupe' => '(UTC-04:00) Guadeloupe',
		'America/Guyana' => '(UTC-04:00) Guyana',
		'America/Halifax' => '(UTC-04:00) Halifax',
		'America/Kralendijk' => '(UTC-04:00) Kralendijk',
		'America/La_Paz' => '(UTC-04:00) La Paz',
		'America/Lower_Princes' => '(UTC-04:00) Lower Princes',
		'America/Manaus' => '(UTC-04:00) Manaus',
		'America/Marigot' => '(UTC-04:00) Marigot',
		'America/Martinique' => '(UTC-04:00) Martinique',
		'America/Moncton' => '(UTC-04:00) Moncton',
		'America/Montserrat' => '(UTC-04:00) Montserrat',
		'Antarctica/Palmer' => '(UTC-04:00) Palmer',
		'America/Port_of_Spain' => '(UTC-04:00) Port of Spain',
		'America/Porto_Velho' => '(UTC-04:00) Porto Velho',
		'America/Puerto_Rico' => '(UTC-04:00) Puerto Rico',
		'America/Rio_Branco' => '(UTC-04:00) Rio Branco',
		'America/Santiago' => '(UTC-04:00) Santiago',
		'America/Santo_Domingo' => '(UTC-04:00) Santo Domingo',
		'America/St_Barthelemy' => '(UTC-04:00) St. Barthelemy',
		'America/St_Kitts' => '(UTC-04:00) St. Kitts',
		'America/St_Lucia' => '(UTC-04:00) St. Lucia',
		'America/St_Thomas' => '(UTC-04:00) St. Thomas',
		'America/St_Vincent' => '(UTC-04:00) St. Vincent',
		'America/Thule' => '(UTC-04:00) Thule',
		'America/Tortola' => '(UTC-04:00) Tortola',
		'America/St_Johns' => '(UTC-03:30) St. Johns',
		'America/Araguaina' => '(UTC-03:00) Araguaina',
		'America/Bahia' => '(UTC-03:00) Bahia',
		'America/Belem' => '(UTC-03:00) Belem',
		'America/Argentina/Buenos_Aires' => '(UTC-03:00) Buenos Aires',
		'America/Argentina/Catamarca' => '(UTC-03:00) Catamarca',
		'America/Cayenne' => '(UTC-03:00) Cayenne',
		'America/Argentina/Cordoba' => '(UTC-03:00) Cordoba',
		'America/Fortaleza' => '(UTC-03:00) Fortaleza',
		'America/Godthab' => '(UTC-03:00) Godthab',
		'America/Argentina/Jujuy' => '(UTC-03:00) Jujuy',
		'America/Argentina/La_Rioja' => '(UTC-03:00) La Rioja',
		'America/Maceio' => '(UTC-03:00) Maceio',
		'America/Argentina/Mendoza' => '(UTC-03:00) Mendoza',
		'America/Miquelon' => '(UTC-03:00) Miquelon',
		'America/Montevideo' => '(UTC-03:00) Montevideo',
		'America/Paramaribo' => '(UTC-03:00) Paramaribo',
		'America/Recife' => '(UTC-03:00) Recife',
		'America/Argentina/Rio_Gallegos' => '(UTC-03:00) Rio Gallegos',
		'Antarctica/Rothera' => '(UTC-03:00) Rothera',
		'America/Argentina/Salta' => '(UTC-03:00) Salta',
		'America/Argentina/San_Juan' => '(UTC-03:00) San Juan',
		'America/Argentina/San_Luis' => '(UTC-03:00) San Luis',
		'America/Santarem' => '(UTC-03:00) Santarem',
		'America/Sao_Paulo' => '(UTC-03:00) Sao Paulo',
		'Atlantic/Stanley' => '(UTC-03:00) Stanley',
		'America/Argentina/Tucuman' => '(UTC-03:00) Tucuman',
		'America/Argentina/Ushuaia' => '(UTC-03:00) Ushuaia',
		'America/Noronha' => '(UTC-02:00) Noronha',
		'Atlantic/South_Georgia' => '(UTC-02:00) South Georgia',
		'Atlantic/Azores' => '(UTC-01:00) Azores',
		'Atlantic/Cape_Verde' => '(UTC-01:00) Cape Verde',
		'America/Scoresbysund' => '(UTC-01:00) Scoresbysund',
		'Africa/Abidjan' => '(UTC+00:00) Abidjan',
		'Africa/Accra' => '(UTC+00:00) Accra',
		'Africa/Bamako' => '(UTC+00:00) Bamako',
		'Africa/Banjul' => '(UTC+00:00) Banjul',
		'Africa/Bissau' => '(UTC+00:00) Bissau',
		'Atlantic/Canary' => '(UTC+00:00) Canary',
		'Africa/Casablanca' => '(UTC+00:00) Casablanca',
		'Africa/Conakry' => '(UTC+00:00) Conakry',
		'Africa/Dakar' => '(UTC+00:00) Dakar',
		'America/Danmarkshavn' => '(UTC+00:00) Danmarkshavn',
		'Europe/Dublin' => '(UTC+00:00) Dublin',
		'Africa/El_Aaiun' => '(UTC+00:00) El Aaiun',
		'Atlantic/Faroe' => '(UTC+00:00) Faroe',
		'Africa/Freetown' => '(UTC+00:00) Freetown',
		'Europe/Guernsey' => '(UTC+00:00) Guernsey',
		'Europe/Isle_of_Man' => '(UTC+00:00) Isle of Man',
		'Europe/Jersey' => '(UTC+00:00) Jersey',
		'Europe/Lisbon' => '(UTC+00:00) Lisbon',
		'Africa/Lome' => '(UTC+00:00) Lome',
		'Europe/London' => '(UTC+00:00) London',
		'Atlantic/Madeira' => '(UTC+00:00) Madeira',
		'Africa/Monrovia' => '(UTC+00:00) Monrovia',
		'Africa/Nouakchott' => '(UTC+00:00) Nouakchott',
		'Africa/Ouagadougou' => '(UTC+00:00) Ouagadougou',
		'Atlantic/Reykjavik' => '(UTC+00:00) Reykjavik',
		'Africa/Sao_Tome' => '(UTC+00:00) Sao Tome',
		'Atlantic/St_Helena' => '(UTC+00:00) St. Helena',
		'UTC' => '(UTC+00:00) UTC',
		'Africa/Algiers' => '(UTC+01:00) Algiers',
		'Europe/Amsterdam' => '(UTC+01:00) Amsterdam',
		'Europe/Andorra' => '(UTC+01:00) Andorra',
		'Africa/Bangui' => '(UTC+01:00) Bangui',
		'Europe/Belgrade' => '(UTC+01:00) Belgrade',
		'Europe/Berlin' => '(UTC+01:00) Berlin',
		'Europe/Bratislava' => '(UTC+01:00) Bratislava',
		'Africa/Brazzaville' => '(UTC+01:00) Brazzaville',
		'Europe/Brussels' => '(UTC+01:00) Brussels',
		'Europe/Budapest' => '(UTC+01:00) Budapest',
		'Europe/Busingen' => '(UTC+01:00) Busingen',
		'Africa/Ceuta' => '(UTC+01:00) Ceuta',
		'Europe/Copenhagen' => '(UTC+01:00) Copenhagen',
		'Africa/Douala' => '(UTC+01:00) Douala',
		'Europe/Gibraltar' => '(UTC+01:00) Gibraltar',
		'Africa/Kinshasa' => '(UTC+01:00) Kinshasa',
		'Africa/Lagos' => '(UTC+01:00) Lagos',
		'Africa/Libreville' => '(UTC+01:00) Libreville',
		'Europe/Ljubljana' => '(UTC+01:00) Ljubljana',
		'Arctic/Longyearbyen' => '(UTC+01:00) Longyearbyen',
		'Africa/Luanda' => '(UTC+01:00) Luanda',
		'Europe/Luxembourg' => '(UTC+01:00) Luxembourg',
		'Europe/Madrid' => '(UTC+01:00) Madrid',
		'Africa/Malabo' => '(UTC+01:00) Malabo',
		'Europe/Malta' => '(UTC+01:00) Malta',
		'Europe/Monaco' => '(UTC+01:00) Monaco',
		'Africa/Ndjamena' => '(UTC+01:00) Ndjamena',
		'Africa/Niamey' => '(UTC+01:00) Niamey',
		'Europe/Oslo' => '(UTC+01:00) Oslo',
		'Europe/Paris' => '(UTC+01:00) Paris',
		'Europe/Podgorica' => '(UTC+01:00) Podgorica',
		'Africa/Porto-Novo' => '(UTC+01:00) Porto-Novo',
		'Europe/Prague' => '(UTC+01:00) Prague',
		'Europe/Rome' => '(UTC+01:00) Rome',
		'Europe/San_Marino' => '(UTC+01:00) San Marino',
		'Europe/Sarajevo' => '(UTC+01:00) Sarajevo',
		'Europe/Skopje' => '(UTC+01:00) Skopje',
		'Europe/Stockholm' => '(UTC+01:00) Stockholm',
		'Europe/Tirane' => '(UTC+01:00) Tirane',
		'Africa/Tripoli' => '(UTC+01:00) Tripoli',
		'Africa/Tunis' => '(UTC+01:00) Tunis',
		'Europe/Vaduz' => '(UTC+01:00) Vaduz',
		'Europe/Vatican' => '(UTC+01:00) Vatican',
		'Europe/Vienna' => '(UTC+01:00) Vienna',
		'Europe/Warsaw' => '(UTC+01:00) Warsaw',
		'Africa/Windhoek' => '(UTC+01:00) Windhoek',
		'Europe/Zagreb' => '(UTC+01:00) Zagreb',
		'Europe/Zurich' => '(UTC+01:00) Zurich',
		'Europe/Athens' => '(UTC+02:00) Athens',
		'Asia/Beirut' => '(UTC+02:00) Beirut',
		'Africa/Blantyre' => '(UTC+02:00) Blantyre',
		'Europe/Bucharest' => '(UTC+02:00) Bucharest',
		'Africa/Bujumbura' => '(UTC+02:00) Bujumbura',
		'Africa/Cairo' => '(UTC+02:00) Cairo',
		'Europe/Chisinau' => '(UTC+02:00) Chisinau',
		'Asia/Damascus' => '(UTC+02:00) Damascus',
		'Africa/Gaborone' => '(UTC+02:00) Gaborone',
		'Asia/Gaza' => '(UTC+02:00) Gaza',
		'Africa/Harare' => '(UTC+02:00) Harare',
		'Asia/Hebron' => '(UTC+02:00) Hebron',
		'Europe/Helsinki' => '(UTC+02:00) Helsinki',
		'Europe/Istanbul' => '(UTC+02:00) Istanbul',
		'Asia/Jerusalem' => '(UTC+02:00) Jerusalem',
		'Africa/Johannesburg' => '(UTC+02:00) Johannesburg',
		'Europe/Kiev' => '(UTC+02:00) Kiev',
		'Africa/Kigali' => '(UTC+02:00) Kigali',
		'Africa/Lubumbashi' => '(UTC+02:00) Lubumbashi',
		'Africa/Lusaka' => '(UTC+02:00) Lusaka',
		'Africa/Maputo' => '(UTC+02:00) Maputo',
		'Europe/Mariehamn' => '(UTC+02:00) Mariehamn',
		'Africa/Maseru' => '(UTC+02:00) Maseru',
		'Africa/Mbabane' => '(UTC+02:00) Mbabane',
		'Asia/Nicosia' => '(UTC+02:00) Nicosia',
		'Europe/Riga' => '(UTC+02:00) Riga',
		'Europe/Simferopol' => '(UTC+02:00) Simferopol',
		'Europe/Sofia' => '(UTC+02:00) Sofia',
		'Europe/Tallinn' => '(UTC+02:00) Tallinn',
		'Europe/Uzhgorod' => '(UTC+02:00) Uzhgorod',
		'Europe/Vilnius' => '(UTC+02:00) Vilnius',
		'Europe/Zaporozhye' => '(UTC+02:00) Zaporozhye',
		'Africa/Addis_Ababa' => '(UTC+03:00) Addis Ababa',
		'Asia/Aden' => '(UTC+03:00) Aden',
		'Asia/Amman' => '(UTC+03:00) Amman',
		'Indian/Antananarivo' => '(UTC+03:00) Antananarivo',
		'Africa/Asmara' => '(UTC+03:00) Asmara',
		'Asia/Baghdad' => '(UTC+03:00) Baghdad',
		'Asia/Bahrain' => '(UTC+03:00) Bahrain',
		'Indian/Comoro' => '(UTC+03:00) Comoro',
		'Africa/Dar_es_Salaam' => '(UTC+03:00) Dar es Salaam',
		'Africa/Djibouti' => '(UTC+03:00) Djibouti',
		'Africa/Juba' => '(UTC+03:00) Juba',
		'Europe/Kaliningrad' => '(UTC+03:00) Kaliningrad',
		'Africa/Kampala' => '(UTC+03:00) Kampala',
		'Africa/Khartoum' => '(UTC+03:00) Khartoum',
		'Asia/Kuwait' => '(UTC+03:00) Kuwait',
		'Indian/Mayotte' => '(UTC+03:00) Mayotte',
		'Europe/Minsk' => '(UTC+03:00) Minsk',
		'Africa/Mogadishu' => '(UTC+03:00) Mogadishu',
		'Europe/Moscow' => '(UTC+03:00) Moscow',
		'Africa/Nairobi' => '(UTC+03:00) Nairobi',
		'Asia/Qatar' => '(UTC+03:00) Qatar',
		'Asia/Riyadh' => '(UTC+03:00) Riyadh',
		'Antarctica/Syowa' => '(UTC+03:00) Syowa',
		'Asia/Tehran' => '(UTC+03:30) Tehran',
		'Asia/Baku' => '(UTC+04:00) Baku',
		'Asia/Dubai' => '(UTC+04:00) Dubai',
		'Indian/Mahe' => '(UTC+04:00) Mahe',
		'Indian/Mauritius' => '(UTC+04:00) Mauritius',
		'Asia/Muscat' => '(UTC+04:00) Muscat',
		'Indian/Reunion' => '(UTC+04:00) Reunion',
		'Europe/Samara' => '(UTC+04:00) Samara',
		'Asia/Tbilisi' => '(UTC+04:00) Tbilisi',
		'Europe/Volgograd' => '(UTC+04:00) Volgograd',
		'Asia/Yerevan' => '(UTC+04:00) Yerevan',
		'Asia/Kabul' => '(UTC+04:30) Kabul',
		'Asia/Aqtau' => '(UTC+05:00) Aqtau',
		'Asia/Aqtobe' => '(UTC+05:00) Aqtobe',
		'Asia/Ashgabat' => '(UTC+05:00) Ashgabat',
		'Asia/Dushanbe' => '(UTC+05:00) Dushanbe',
		'Asia/Karachi' => '(UTC+05:00) Karachi',
		'Indian/Kerguelen' => '(UTC+05:00) Kerguelen',
		'Indian/Maldives' => '(UTC+05:00) Maldives',
		'Antarctica/Mawson' => '(UTC+05:00) Mawson',
		'Asia/Oral' => '(UTC+05:00) Oral',
		'Asia/Samarkand' => '(UTC+05:00) Samarkand',
		'Asia/Tashkent' => '(UTC+05:00) Tashkent',
		'Asia/Colombo' => '(UTC+05:30) Colombo',
		'Asia/Kolkata' => '(UTC+05:30) Kolkata',
		'Asia/Kathmandu' => '(UTC+05:45) Kathmandu',
		'Asia/Almaty' => '(UTC+06:00) Almaty',
		'Asia/Bishkek' => '(UTC+06:00) Bishkek',
		'Indian/Chagos' => '(UTC+06:00) Chagos',
		'Asia/Dhaka' => '(UTC+06:00) Dhaka',
		'Asia/Qyzylorda' => '(UTC+06:00) Qyzylorda',
		'Asia/Thimphu' => '(UTC+06:00) Thimphu',
		'Antarctica/Vostok' => '(UTC+06:00) Vostok',
		'Asia/Yekaterinburg' => '(UTC+06:00) Yekaterinburg',
		'Indian/Cocos' => '(UTC+06:30) Cocos',
		'Asia/Rangoon' => '(UTC+06:30) Rangoon',
		'Asia/Bangkok' => '(UTC+07:00) Bangkok',
		'Indian/Christmas' => '(UTC+07:00) Christmas',
		'Antarctica/Davis' => '(UTC+07:00) Davis',
		'Asia/Ho_Chi_Minh' => '(UTC+07:00) Ho Chi Minh',
		'Asia/Hovd' => '(UTC+07:00) Hovd',
		'Asia/Jakarta' => '(UTC+07:00) Jakarta',
		'Asia/Novokuznetsk' => '(UTC+07:00) Novokuznetsk',
		'Asia/Novosibirsk' => '(UTC+07:00) Novosibirsk',
		'Asia/Omsk' => '(UTC+07:00) Omsk',
		'Asia/Phnom_Penh' => '(UTC+07:00) Phnom Penh',
		'Asia/Pontianak' => '(UTC+07:00) Pontianak',
		'Asia/Vientiane' => '(UTC+07:00) Vientiane',
		'Asia/Brunei' => '(UTC+08:00) Brunei',
		'Antarctica/Casey' => '(UTC+08:00) Casey',
		'Asia/Choibalsan' => '(UTC+08:00) Choibalsan',
		'Asia/Chongqing' => '(UTC+08:00) Chongqing',
		'Asia/Harbin' => '(UTC+08:00) Harbin',
		'Asia/Hong_Kong' => '(UTC+08:00) Hong Kong',
		'Asia/Kashgar' => '(UTC+08:00) Kashgar',
		'Asia/Krasnoyarsk' => '(UTC+08:00) Krasnoyarsk',
		'Asia/Kuala_Lumpur' => '(UTC+08:00) Kuala Lumpur',
		'Asia/Kuching' => '(UTC+08:00) Kuching',
		'Asia/Macau' => '(UTC+08:00) Macau',
		'Asia/Makassar' => '(UTC+08:00) Makassar',
		'Asia/Manila' => '(UTC+08:00) Manila',
		'Australia/Perth' => '(UTC+08:00) Perth',
		'Asia/Shanghai' => '(UTC+08:00) Shanghai',
		'Asia/Singapore' => '(UTC+08:00) Singapore',
		'Asia/Taipei' => '(UTC+08:00) Taipei',
		'Asia/Ulaanbaatar' => '(UTC+08:00) Ulaanbaatar',
		'Asia/Urumqi' => '(UTC+08:00) Urumqi',
		'Australia/Eucla' => '(UTC+08:45) Eucla',
		'Asia/Dili' => '(UTC+09:00) Dili',
		'Asia/Irkutsk' => '(UTC+09:00) Irkutsk',
		'Asia/Jayapura' => '(UTC+09:00) Jayapura',
		'Pacific/Palau' => '(UTC+09:00) Palau',
		'Asia/Pyongyang' => '(UTC+09:00) Pyongyang',
		'Asia/Seoul' => '(UTC+09:00) Seoul',
		'Asia/Tokyo' => '(UTC+09:00) Tokyo',
		'Australia/Adelaide' => '(UTC+09:30) Adelaide',
		'Australia/Broken_Hill' => '(UTC+09:30) Broken Hill',
		'Australia/Darwin' => '(UTC+09:30) Darwin',
		'Australia/Brisbane' => '(UTC+10:00) Brisbane',
		'Pacific/Chuuk' => '(UTC+10:00) Chuuk',
		'Australia/Currie' => '(UTC+10:00) Currie',
		'Antarctica/DumontDUrville' => '(UTC+10:00) DumontDUrville',
		'Pacific/Guam' => '(UTC+10:00) Guam',
		'Australia/Hobart' => '(UTC+10:00) Hobart',
		'Asia/Khandyga' => '(UTC+10:00) Khandyga',
		'Australia/Lindeman' => '(UTC+10:00) Lindeman',
		'Australia/Melbourne' => '(UTC+10:00) Melbourne',
		'Pacific/Port_Moresby' => '(UTC+10:00) Port Moresby',
		'Pacific/Saipan' => '(UTC+10:00) Saipan',
		'Australia/Sydney' => '(UTC+10:00) Sydney',
		'Asia/Yakutsk' => '(UTC+10:00) Yakutsk',
		'Australia/Lord_Howe' => '(UTC+10:30) Lord Howe',
		'Pacific/Efate' => '(UTC+11:00) Efate',
		'Pacific/Guadalcanal' => '(UTC+11:00) Guadalcanal',
		'Pacific/Kosrae' => '(UTC+11:00) Kosrae',
		'Antarctica/Macquarie' => '(UTC+11:00) Macquarie',
		'Pacific/Noumea' => '(UTC+11:00) Noumea',
		'Pacific/Pohnpei' => '(UTC+11:00) Pohnpei',
		'Asia/Sakhalin' => '(UTC+11:00) Sakhalin',
		'Asia/Ust-Nera' => '(UTC+11:00) Ust-Nera',
		'Asia/Vladivostok' => '(UTC+11:00) Vladivostok',
		'Pacific/Norfolk' => '(UTC+11:30) Norfolk',
		'Asia/Anadyr' => '(UTC+12:00) Anadyr',
		'Pacific/Auckland' => '(UTC+12:00) Auckland',
		'Pacific/Fiji' => '(UTC+12:00) Fiji',
		'Pacific/Funafuti' => '(UTC+12:00) Funafuti',
		'Asia/Kamchatka' => '(UTC+12:00) Kamchatka',
		'Pacific/Kwajalein' => '(UTC+12:00) Kwajalein',
		'Asia/Magadan' => '(UTC+12:00) Magadan',
		'Pacific/Majuro' => '(UTC+12:00) Majuro',
		'Antarctica/McMurdo' => '(UTC+12:00) McMurdo',
		'Pacific/Nauru' => '(UTC+12:00) Nauru',
		'Antarctica/South_Pole' => '(UTC+12:00) South Pole',
		'Pacific/Tarawa' => '(UTC+12:00) Tarawa',
		'Pacific/Wake' => '(UTC+12:00) Wake',
		'Pacific/Wallis' => '(UTC+12:00) Wallis',
		'Pacific/Chatham' => '(UTC+12:45) Chatham',
		'Pacific/Apia' => '(UTC+13:00) Apia',
		'Pacific/Enderbury' => '(UTC+13:00) Enderbury',
		'Pacific/Fakaofo' => '(UTC+13:00) Fakaofo',
		'Pacific/Tongatapu' => '(UTC+13:00) Tongatapu',
		'Pacific/Kiritimati' => '(UTC+14:00) Kiritimati',
	);


	/**
	 * Post Type Meta Fields slugs
	 * @var array
	 */
	const META_FIELDS_SLUG = [
		'location'                          => 'user_location',
		'timezone'                          => 'user_time_zone',
		'shipping_company_id'               => 'user_shipping_company',
		'shipping_company_department_id'    => 'user_shipping_company_department',
		'supplier_company_id'               => 'user_supplier_company_id',
		'availability_id'                   => 'user_availability',
		'meeting_duration'                  => 'user_meeting_duration',
		'meeting_buffer'                    => 'user_meeting_buffer',
		'minimum_notice'                    => 'user_minimum_notice',
		'max_meetings_per_day'              => 'user_max_meetings_per_day',
		'book_in_advance_days'              => 'user_book_in_advance_days',
		'booking_request_type'              => 'user_booking_request_type',
		'meeting_repetition'                => 'user_meeting_repetition',
		'meet_same_supplier_times'          => 'user_meet_same_supplier_times',
		'booking_method'                    => 'user_booking_method',
        'selected_products'                 => 'user_selected_products',
        'selected_brands'                   => 'user_selected_brands',
        'visible'                           => 'user_visible',
        'availability_period'               => 'user_availability_period',
        'availability_period_saved_date'    => 'user_availability_period_saved_date',
        'instant_booking'                   => 'user_instant_booking',
        'instant_booking_products'          => 'user_instant_booking_products',
        'instant_booking_brands'            => 'user_instant_booking_brands',
	];

	public function registerUserFields( $meta_boxes ) {

		$meta_boxes[] = array(
			'title' => 'Location /Time',
			'type'  => 'user',
			'fields' => array(

				array(
					'name' => 'Location',
					'id'                => self::META_FIELDS_SLUG['location'],
					'type' => 'select_advanced',
					'options' => CountryTaxonomy::COUNTRIES_ARRAY,
				),

				array(
					'name'              => 'Time Zone',
					'id'                => self::META_FIELDS_SLUG['timezone'],
					'desc'              => 'The time zone of the user',
					'type'              => 'select_advanced',
					'options'           => self::TIME_ZONES
				),

			),
		);

		$meta_boxes[] = array(
			'title' => 'Company Info',
			'type'  => 'user',
			'fields' => array(
				array(
					'name'              => 'Shipping Company',
					'id'                => self::META_FIELDS_SLUG['shipping_company_id'],
					'desc'              => 'The shipping company the user belongs to. Applicable only if the user is a Shipping Company Admin, Department Admin or Shipping company employee',
					'type'              => 'post',
					'post_type'         => ShippingCompanyPost::POST_TYPE_NAME,
					'field_type'        => 'select',
					'placeholder'       => 'Select a company',
				),
				array(
					'name'              => 'Shipping Company Department',
					'id'                => self::META_FIELDS_SLUG['shipping_company_department_id'],
					'desc'              => 'The shipping company department the user belongs to. Applicable only if the user is a Shipping Company Department Admin or Shipping company employee',
					'type'              => 'post',
					'post_type'         => DepartmentPost::POST_TYPE_NAME,
					'field_type'        => 'select_advanced',
					'placeholder'       => 'Select a department',
				),
				array(
					'name'              => 'Supplier Company',
					'id'                => self::META_FIELDS_SLUG['supplier_company_id'],
					'desc'              => 'The shipping company department the user belongs to. Applicable only if the user is a Supplier Company Admin or Supplier company employee',
					'type'              => 'post',
					'post_type'         => SupplierCompanyPost::POST_TYPE_NAME,
					'field_type'        => 'select_advanced',
					'placeholder'       => 'Select a supplier company',
				),

			),
		);

		$meta_boxes[] = array(
			'title' => 'Booking Settings',
			'type'  => 'user', // Specifically for user
			'fields' => array(
				array(
					'name'              => 'User Availability',
					'id'                => self::META_FIELDS_SLUG['availability_id'],
					'type'              => 'post',
					'post_type'         => AvailabilityPost::POST_TYPE_NAME,
					'field_type'        => 'select',
					'placeholder'       => 'Select an availability object',
				),
				array(
					'name'              => 'Meeting Time Duration',
					'id'                => self::META_FIELDS_SLUG['meeting_duration'],
					'desc'              => 'Timeframe of the meeting in minutes (ex.30)',
					'type'              => 'number',
				),
				array(
					'name'              => 'Meeting Time Buffer',
					'id'                => self::META_FIELDS_SLUG['meeting_buffer'],
					'desc'              => 'Buffer duration (in minutes) before and after meetings',
					'type'              => 'number',
				),
				array(
					'name'              => 'Max meetings per day',
					'id'                => self::META_FIELDS_SLUG['max_meetings_per_day'],
					'desc'              => 'The maximum meetings the current user can be booked for.',
					'type'              => 'number',
				),
                array(
                    'name'              => 'Minimum Notice Period',
                    'id'                => self::META_FIELDS_SLUG['minimum_notice'],
                    'desc'              => 'The way the booking requests are made. Email or instant booking',
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'minimum_notice_in_advance'             => 'Book an appointment at least xxx(example 24hours) in advance',
                        'minimum_notice_no_limit'               => 'No time limit',
                    ),
                ),
				array(
					'name'              => 'Book in advance days',
					'id'                => self::META_FIELDS_SLUG['book_in_advance_days'],
					'desc'              => 'The minimum days notice to book the current user for - 0 is no limit.',
					'type'              => 'number',
				),
				array(
					'name'              => 'Booking request type',
					'id'                => self::META_FIELDS_SLUG['booking_request_type'],
					'desc'              => 'The way the booking requests are made. Email or instant booking',
					'type'              => 'radio',
					'options'           => array(
						'email'             => 'Ask via Email first',
						'instant'           => 'Instant Booking',
					),
				),
                array(
                    'name'              => 'Instant Booking',
                    'id'                => self::META_FIELDS_SLUG['instant_booking'],
                    'type'              => 'radio',
                    'inline'            => false,
                    'options'           => array(
                        'accept_specific'               => 'Accept for specific',
                        'decline'                       => 'Do not accept',
                    ),
                ),
                array(
                    'name'       => 'Instant Booking: Specific Products',
                    'id'         => self::META_FIELDS_SLUG['instant_booking_products'],
                    'type'       => 'text',
                ),
                array(
                    'name'       => 'Instant Booking: Specific Brands',
                    'id'         => self::META_FIELDS_SLUG['instant_booking_brands'],
                    'type'       => 'text',
                ),
                array(
                    'name'              => 'Meeting Repetition',
                    'id'                => self::META_FIELDS_SLUG['meeting_repetition'],
                    'type'              => 'radio',
                    'options'           => array(
                        'meeting_repetition_limit'          => 'Do not let the same supplier to visit our company',
                        'meeting_repetition_no_limit'       => 'No time limit',
                    ),
                    'inline'            => false,
                    'select_all_none'   => true,
                ),
				array(
					'name'              => 'How many times to meet same supplier',
					'id'                => self::META_FIELDS_SLUG['meet_same_supplier_times'],
					'desc'              => 'The maximum number of times the user can meet a supplier - 0 is no limit',
					'type'              => 'number',
				),
                array(
                    'name'              => 'Booking Method',
                    'id'                => self::META_FIELDS_SLUG['booking_method'],
                    'type'              => 'checkbox_list',
                    'options'           => array(
                        'physical_location'     => 'Physical Location',
                        'phone_call'            => 'Phone Call',
                        'online'                => 'Remote Online',
                    ),
                    'inline'            => true,
                    'select_all_none'   => true,
                ),
                array(
                    'name'       => 'Products',
                    'id'         => self::META_FIELDS_SLUG['selected_products'],
                    'type'       => 'text',
                ),
                array(
                    'name'       => 'Brands',
                    'id'         => self::META_FIELDS_SLUG['selected_brands'],
                    'type'       => 'text',
                ),

                array(
                    'name'       => 'Visible',
                    'id'         => self::META_FIELDS_SLUG['visible'],
                    'type'    => 'radio',
                    'options' => array(
                        'user_visibile'     => 'Yes',
                        'user_not_visibile' => 'No',
                    ),
                    'inline' => true,
                ),
                array(
                    'name'       => 'Availability Period',
                    'id'         => self::META_FIELDS_SLUG['availability_period'],
                    'type'    => 'radio',
                    'options' => array(
                        'year'      => 'Year',
                        'month'     => 'Month',
                    ),
                    'inline' => true,
                ),
                array(
                    'name'       => 'Availability Period Saved Date',
                    'id'         => self::META_FIELDS_SLUG['availability_period_saved_date'],
                    'type'       => 'text',
                ),

            ),
		);

		return $meta_boxes; 

	}

}

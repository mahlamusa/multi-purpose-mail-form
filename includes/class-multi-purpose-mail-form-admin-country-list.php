<?php

/**
* This function lists countries in the worls. 
* It only displays the fields where they are required
*/
class Multi_Purpose_Mail_Form_Countries {
	public function __construct() {}
	/**
	* Print a select box of all countries
	*/
	public function print_countries($id="",$name="",$selected=""){
		$countries = $this->get_countries();
		$countries_list = '<select name="'.(($name !="")?$name:"country").'" id="'.(($id != "")?$id:"country").'" class="form-control input">';
			foreach ( $countries as $key=>$value) {
				$countries_list .= '<option value="'.$key.'" '.selected($key,$selected).'>'.$value.'</option>';
			}
		$countries_list .= '</select>';
		
		return $countries_list;
	}
	
	/** 
	* Print the states 
	* Given the country name
	*/
	public function print_states($country,$id="",$name="",$selected=""){
		$states = $this->get_states($country);
		
		if ( $states != null ) {
			$states_list = '<select name="'.(($name !="")?$name:"state").'" id="'.(($id != "")?$id:"state").'" class="form-control input">';
				foreach ( $states as $key=>$value) {
					$states_list .= '<option value="'.$key.'" '.selected($key,$selected).'>'.$value.'</option>';
				}
			$states_list .= '</select>';
			return $states_list;
		}else{
			return '<input name="state" id="state" type="text" class="form-control input" />';
		}
	}
	
	/**
	* Return the full name of the country
	* given the country code
	*/
	public function name_country( $code ){
		$countries = $this->get_countries();
		return $countries[$code];
	}
	
	/**
	* Return the full name of the  state
	* given the code of the state
	*/
	public function name_state( $code ){
		$states = $this->get_states();
		return $states[$code];
	}
	
	/**
	* Return all countries in the world
	*/
	public function get_countries(){
		return array(
			'US'	=>	'United States',
			'AF'	=>	'Afghanistan',
			'AL'	=>	'Albania',
			'DZ'	=>	'Algeria',
			'AS'	=>	'American Samoa',
			'AD'	=>	'Andorra',
			'AO'	=>	'Angola',
			'AI'	=>	'Anguilla',
			'AQ'	=>	'Antarctica',
			'AG'	=>	'Antigua And Barbuda',
			'AR'	=>	'Argentina',
			'AM'	=>	'Armenia',
			'AW'	=>	'Aruba',
			'AU'	=>	'Australia',
			'AT'	=>	'Austria',
			'AZ'	=>	'Azerbaijan',
			'BS'	=>	'Bahamas',
			'BH'	=>	'Bahrain',
			'BD'	=>	'Bangladesh',
			'BB'	=>	'Barbados',
			'BY'	=>	'Belarus',
			'BE'	=>	'Belgium',
			'BZ'	=>	'Belize',
			'BJ'	=>	'Benin',
			'BM'	=>	'Bermuda',
			'BT'	=>	'Bhutan',
			'BO'	=>	'Bolivia',
			'BA'	=>	'Bosnia And Herzegowina',
			'BW'	=>	'Botswana',
			'BV'	=>	'Bouvet Island',
			'BR'	=>	'Brazil',
			'IO'	=>	'British Indian Ocean Territory',
			'BN'	=>	'Brunei Darussalam',
			'BG'	=>	'Bulgaria',
			'BF'	=>	'Burkina Faso',
			'BI'	=>	'Burundi',
			'KH'	=>	'Cambodia',
			'CM'	=>	'Cameroon',
			'CA'	=>	'Canada',
			'CV'	=>	'Cape Verde',
			'KY'	=>	'Cayman Islands',
			'CF'	=>	'Central African Republic',
			'TD'	=>	'Chad',
			'CL'	=>	'Chile',
			'CN'	=>	'China',
			'CX'	=>	'Christmas Island',
			'CC'	=>	'Cocos (Keeling) Islands',
			'CO'	=>	'Colombia',
			'KM'	=>	'Comoros',
			'CG'	=>	'Congo',
			'CD'	=>	'Congo, The Democratic Republic Of The',
			'CK'	=>	'Cook Islands',
			'CR'	=>	'Costa Rica',
			'CI'	=>	'Cote D\'Ivoire',
			'HR'	=>	'Croatia (Local Name: Hrvatska)',
			'CU'	=>	'Cuba',
			'CY'	=>	'Cyprus',
			'CZ'	=>	'Czech Republic',
			'DK'	=>	'Denmark',
			'DJ'	=>	'Djibouti',
			'DM'	=>	'Dominica',
			'DO'	=>	'Dominican Republic',
			'TP'	=>	'East Timor',
			'EC'	=>	'Ecuador',
			'EG'	=>	'Egypt',
			'SV'	=>	'El Salvador',
			'GQ'	=>	'Equatorial Guinea',
			'ER'	=>	'Eritrea',
			'EE'	=>	'Estonia',
			'ET'	=>	'Ethiopia',
			'FK'	=>	'Falkland Islands (Malvinas)',
			'FO'	=>	'Faroe Islands',
			'FJ'	=>	'Fiji',
			'FI'	=>	'Finland',
			'FR'	=>	'France',
			'FX'	=>	'France, Metropolitan',
			'GF'	=>	'French Guiana',
			'PF'	=>	'French Polynesia',
			'TF'	=>	'French Southern Territories',
			'GA'	=>	'Gabon',
			'GM'	=>	'Gambia',
			'GE'	=>	'Georgia',
			'DE'	=>	'Germany',
			'GH'	=>	'Ghana',
			'GI'	=>	'Gibraltar',
			'GR'	=>	'Greece',
			'GL'	=>	'Greenland',
			'GD'	=>	'Grenada',
			'GP'	=>	'Guadeloupe',
			'GU'	=>	'Guam',
			'GT'	=>	'Guatemala',
			'GN'	=>	'Guinea',
			'GW'	=>	'Guinea-Bissau',
			'GY'	=>	'Guyana',
			'HT'	=>	'Haiti',
			'HM'	=>	'Heard And Mc Donald Islands',
			'HN'	=>	'Honduras',
			'HK'	=>	'Hong Kong',
			'HU'	=>	'Hungary',
			'IS'	=>	'Iceland',
			'IN'	=>	'India',
			'ID'	=>	'Indonesia',
			'IR'	=>	'Iran (Islamic Republic Of)',
			'IQ'	=>	'Iraq',
			'IE'	=>	'Ireland',
			'IL'	=>	'Israel',
			'IT'	=>	'Italy',
			'JM'	=>	'Jamaica',
			'JP'	=>	'Japan',
			'JO'	=>	'Jordan',
			'KZ'	=>	'Kazakhstan',
			'KE'	=>	'Kenya',
			'KI'	=>	'Kiribati',
			'KP'	=>	'Korea, Democratic People\'S Republic Of',
			'KR'	=>	'Korea, Republic Of',
			'KW'	=>	'Kuwait',
			'KG'	=>	'Kyrgyzstan',
			'LA'	=>	'Lao People\'S Democratic Republic',
			'LV'	=>	'Latvia',
			'LB'	=>	'Lebanon',
			'LS'	=>	'Lesotho',
			'LR'	=>	'Liberia',
			'LY'	=>	'Libyan Arab Jamahiriya',
			'LI'	=>	'Liechtenstein',
			'LT'	=>	'Lithuania',
			'LU'	=>	'Luxembourg',
			'MO'	=>	'Macau',
			'MK'	=>	'Macedonia, Former Yugoslav Republic Of',
			'MG'	=>	'Madagascar',
			'MW'	=>	'Malawi',
			'MY'	=>	'Malaysia',
			'MV'	=>	'Maldives',
			'ML'	=>	'Mali',
			'MT'	=>	'Malta',
			'MH'	=>	'Marshall Islands, Republic of the',
			'MQ'	=>	'Martinique',
			'MR'	=>	'Mauritania',
			'MU'	=>	'Mauritius',
			'YT'	=>	'Mayotte',
			'MX'	=>	'Mexico',
			'FM'	=>	'Micronesia, Federated States Of',
			'MD'	=>	'Moldova, Republic Of',
			'MC'	=>	'Monaco',
			'MN'	=>	'Mongolia',
			'MS'	=>	'Montserrat',
			'MA'	=>	'Morocco',
			'MZ'	=>	'Mozambique',
			'MM'	=>	'Myanmar',
			'NA'	=>	'Namibia',
			'NR'	=>	'Nauru',
			'NP'	=>	'Nepal',
			'NL'	=>	'Netherlands',
			'AN'	=>	'Netherlands Antilles',
			'NC'	=>	'New Caledonia',
			'NZ'	=>	'New Zealand',
			'NI'	=>	'Nicaragua',
			'NE'	=>	'Niger',
			'NG'	=>	'Nigeria',
			'NU'	=>	'Niue',
			'NF'	=>	'Norfolk Island',
			'MP'	=>	'Northern Mariana Islands, Commonwealth of the',
			'NO'	=>	'Norway',
			'OM'	=>	'Oman',
			'PK'	=>	'Pakistan',
			'PW'	=>	'Palau, Republic of',
			'PA'	=>	'Panama',
			'PG'	=>	'Papua New Guinea',
			'PY'	=>	'Paraguay',
			'PE'	=>	'Peru',
			'PH'	=>	'Philippines',
			'PN'	=>	'Pitcairn',
			'PL'	=>	'Poland',
			'PT'	=>	'Portugal',
			'PR'	=>	'Puerto Rico',
			'QA'	=>	'Qatar',
			'RE'	=>	'Reunion',
			'RO'	=>	'Romania',
			'RU'	=>	'Russian Federation',
			'RW'	=>	'Rwanda',
			'KN'	=>	'Saint Kitts And Nevis',
			'LC'	=>	'Saint Lucia',
			'VC'	=>	'Saint Vincent And The Grenadines',
			'WS'	=>	'Samoa',
			'SM'	=>	'San Marino',
			'ST'	=>	'Sao Tome And Principe',
			'SA'	=>	'Saudi Arabia',
			'SN'	=>	'Senegal',
			'SC'	=>	'Seychelles',
			'SL'	=>	'Sierra Leone',
			'SG'	=>	'Singapore',
			'SK'	=>	'Slovakia (Slovak Republic)',
			'SI'	=>	'Slovenia',
			'SB'	=>	'Solomon Islands',
			'SO'	=>	'Somalia',
			'ZA'	=>	'South Africa',
			'GS'	=>	'South Georgia, South Sandwich Islands',
			'ES'	=>	'Spain',
			'LK'	=>	'Sri Lanka',
			'SH'	=>	'St. Helena',
			'PM'	=>	'St. Pierre And Miquelon',
			'SD'	=>	'Sudan',
			'SR'	=>	'Suriname',
			'SJ'	=>	'Svalbard And Jan Mayen Islands',
			'SZ'	=>	'Swaziland',
			'SE'	=>	'Sweden',
			'CH'	=>	'Switzerland',
			'SY'	=>	'Syrian Arab Republic',
			'TW'	=>	'Taiwan',
			'TJ'	=>	'Tajikistan',
			'TZ'	=>	'Tanzania, United Republic Of',
			'TH'	=>	'Thailand',
			'TG'	=>	'Togo',
			'TK'	=>	'Tokelau',
			'TO'	=>	'Tonga',
			'TT'	=>	'Trinidad And Tobago',
			'TN'	=>	'Tunisia',
			'TR'	=>	'Turkey',
			'TM'	=>	'Turkmenistan',
			'TC'	=>	'Turks And Caicos Islands',
			'TV'	=>	'Tuvalu',
			'UG'	=>	'Uganda',
			'UA'	=>	'Ukraine',
			'AE'	=>	'United Arab Emirates',
			'GB'	=>	'United Kingdom',
			'UM'	=>	'United States Minor Outlying Islands',
			'UY'	=>	'Uruguay',
			'UZ'	=>	'Uzbekistan',
			'VU'	=>	'Vanuatu',
			'VA'	=>	'Vatican City, State of the',
			'VE'	=>	'Venezuela',
			'VN'	=>	'Viet Nam',
			'VG'	=>	'Virgin Islands (British)',
			'VI'	=>	'Virgin Islands (U.S.)',
			'WF'	=>	'Wallis And Futuna Islands',
			'EH'	=>	'Western Sahara',
			'YE'	=>	'Yemen',
			'YU'	=>	'Yugoslavia',
			'ZM'	=>	'Zambia',
			'ZW'	=>	'Zimbabwe'
		);
	}
	
	
	/** 
	* Return the states of a country
	* Given the country code
	*/
	public function get_states($country=""){
		$us = array(
					'AL'	=>	'Alabama',
					'AK'	=>	'Alaska',
					'AS'	=>	'American Samoa',
					'AZ'	=>	'Arizona',
					'AR'	=>	'Arkansas',
					'AE'	=>	'Armed Forces - Europe',
					'AP'	=>	'Armed Forces - Pacific',
					'AA'	=>	'Armed Forces - USA/Canada',
					'CA'	=>	'California',
					'CO'	=>	'Colorado',
					'CT'	=>	'Connecticut',
					'DE'	=>	'Delaware',
					'DC'	=>	'District of Columbia',
					'FL'	=>	'Florida',
					'GA'	=>	'Georgia',
					'GU'	=>	'Guam',
					'HI'	=>	'Hawaii',
					'ID'	=>	'Idaho',
					'IL'	=>	'Illinois',
					'IN'	=>	'Indiana',
					'IA'	=>	'Iowa',
					'KS'	=>	'Kansas',
					'KY'	=>	'Kentucky',
					'LA'	=>	'Louisiana',
					'ME'	=>	'Maine',
					'MD'	=>	'Maryland',
					'MA'	=>	'Massachusetts',
					'MI'	=>	'Michigan',
					'MN'	=>	'Minnesota',
					'MS'	=>	'Mississippi',
					'MO'	=>	'Missouri',
					'MT'	=>	'Montana',
					'NE'	=>	'Nebraska',
					'NV'	=>	'Nevada',
					'NH'	=>	'New Hampshire',
					'NJ'	=>	'New Jersey',
					'NM'	=>	'New Mexico',
					'NY'	=>	'New York',
					'NC'	=>	'North Carolina',
					'ND'	=>	'North Dakota',
					'OH'	=>	'Ohio',
					'OK'	=>	'Oklahoma',
					'OR'	=>	'Oregon',
					'PA'	=>	'Pennsylvania',
					'PR'	=>	'Puerto Rico',
					'RI'	=>	'Rhode Island',
					'SC'	=>	'South Carolina',
					'SD'	=>	'South Dakota',
					'TN'	=>	'Tennessee',
					'TX'	=>	'Texas',
					'UT'	=>	'Utah',
					'VT'	=>	'Vermont',
					'VI'	=>	'Virgin Islands',
					'VA'	=>	'Virginia',
					'WA'	=>	'Washington',
					'WV'	=>	'West Virginia',
					'WI'	=>	'Wisconsin',
					'WY'	=>	'Wyoming'
				);
			$ca = array(
					'AB'	=>	'Alberta',
					'BC'	=>	'British Columbia',
					'MB'	=>	'Manitoba',
					'NB'	=>	'New Brunswick',
					'NF'	=>	'Newfoundland and Labrador',
					'NT'	=>	'Northwest Territories',
					'NS'	=>	'Nova Scotia',
					'NU'	=>	'Nunavut',
					'ON'	=>	'Ontario',
					'PE'	=>	'Prince Edward Island',
					'QC'	=>	'Quebec',
					'SK'	=>	'Saskatchewan',
					'YT'	=>	'Yukon Territory'
				);
			$au = array(
					'AAT' => 'Australian Antarctic Territory',
					'ACT' => 'Australian Capital Territory',
					'JBT' => 'Jervis Bay Territory',
					'NSW' => 'New South Wales',
					'NT'  => 'Northern Territory',
					'QLD' => 'Queensland',
					'SA'  => 'South Australia',
					'TAS' => 'Tasmania',
					'VIC' => 'Victoria',
					'WA'  => 'Western Australia'
				);
			$in = array (
					'AP' => 'Andhra Pradesh',
					'AR' => 'Arunachal Pradesh',
					'AS' => 'Assam',
					'BR' => 'Bihar',
					'CT' => 'Chhattisgarh',
					'GA' => 'Goa',
					'GJ' => 'Gujarat',
					'HR' => 'Haryana',
					'HP' => 'Himachal Pradesh',
					'JK' => 'Jammu & Kashmir',
					'JH' => 'Jharkhand',
					'KA' => 'Karnataka',
					'KL' => 'Kerala',
					'MP' => 'Madhya Pradesh',
					'MH' => 'Maharashtra',
					'MN' => 'Manipur',
					'ML' => 'Meghalaya',
					'MZ' => 'Mizoram',
					'NL' => 'Nagaland',
					'OR' => 'Odisha',
					'PB' => 'Punjab',
					'RJ' => 'Rajasthan',
					'SK' => 'Sikkim',
					'TN' => 'Tamil Nadu',
					'TR' => 'Tripura',
					'UK' => 'Uttarakhand',
					'UP' => 'Uttar Pradesh',
					'WB' => 'West Bengal',
					'AN' => 'Andaman & Nicobar',
					'CH' => 'Chandigarh',
					'DN' => 'Dadra and Nagar Haveli',
					'DD' => 'Daman & Diu',
					'DL' => 'Delhi',
					'LD' => 'Lakshadweep',
					'PY' => 'Puducherry',
				);
			$za = array(
					'EC'=>'Eastern Cape',
					'FS'=>'Free State',
					'GT'=>'Gauteng',
					'NL'=>'KwaZulu-Natal',
					'LP'=>'Limpopo',
					'MP'=>'Mpumalanga',
					'NC'=>'Northern Cape',
					'NW'=>'North West',
					'WC'=>'Western Cape'
				);
		$all = array_merge($us,$ca,$au,$in,$za);		
				
		switch ($country){			
			case "US":
				return $us;
				break;			
			case "CA":
				return $ca;
				break;
			case "AU":
				return $au;
				break;
			case "IN":
				return $in;
				break;
			case "ZA":
				return $za;
				break;
			default:
				return $all;
				break;
		}
	}
}
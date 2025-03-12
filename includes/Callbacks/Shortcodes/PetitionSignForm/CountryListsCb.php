<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionSignForm;

/**
 * Class for Petition sign form country list callback.
 *
 * @since: 1.0.0
 * @package BwlPetitionsManager
 */
class CountryListsCb {

	/**
     * Retrieves the layout for the country list
     *
     * @param array $atts Shortcode attributes.
     * @return string The layout of country list dropdown
     */
	public function get_the_layout( $atts ) {

		$atts = shortcode_atts([
			'id'  => '', // if row=1 we wrap the input field with row. rs = row status.
			'fri' => '', // fri = Form id
			'cli' => '', // cli = col id
			'cc'  => 'col-sm-12',  // cc = col class
			'fi'  => '', // fi = field ID
			'fn'  => '', // fn = field name
			'fc'  => 'form-control', // fc = field class.
			'fp'  => esc_attr__( 'Your Country', 'bwl_ptmn' ), // fp = field place holder.
			'fd'  => '', // fd = field default.
			'fr'  => '0', // fr = field required.
			'fer' => esc_attr__( 'Select Country', 'bwl_ptmn' ), // fer = field error message
		], $atts);

		extract( $atts );

		$countries = [
			'Afghanistan',
			'Albania',
			'Algeria',
			'American Samoa',
			'Andorra',
			'Angola',
			'Anguilla',
			'Antarctica',

			'Antigua and Barbuda',
			'Argentina',
			'Armenia',
			'Aruba',
			'Australia',
			'Austria',
			'Azerbaijan',
			'Bahamas',
			'Bahrain',

			'Bangladesh',
			'Barbados',
			'Belarus',
			'Belgium',
			'Belize',
			'Benin',
			'Bermuda',
			'Bhutan',
			'Bolivia',
			'Bosnia and Herzegowina',

			'Botswana',
			'Bouvet Island',
			'Brazil',
			'British Indian Ocean Territory',
			'Brunei Darussalam',
			'Bulgaria',
			'Burkina Faso',
			'Burundi',

			'Cambodia',
			'Cameroon',
			'Canada',
			'Cape Verde',
			'Cayman Islands',
			'Central African Republic',
			'Chad',
			'Chile',
			'China',
			'Christmas Island',

			'Cocos (Keeling) Islands',
			'Colombia',
			'Comoros',
			'Congo',
			'Congo, the Democratic Republic of the',
			'Cook Islands',
			'Costa Rica',
			"Cote d'Ivoire",
			'Croatia (Hrvatska)',

			'Cuba',
			'Cyprus',
			'Czech Republic',
			'Denmark',
			'Djibouti',
			'Dominica',
			'Dominican Republic',
			'East Timor',
			'Ecuador',
			'Egypt',
			'El Salvador',
			'Equatorial Guinea',
			'Eritrea',
			'Estonia',

			'Ethiopia',
			'Falkland Islands (Malvinas)',
			'Faroe Islands',
			'Fiji',
			'Finland',
			'France',
			'France Metropolitan',
			'French Guiana',
			'French Polynesia',
			'French Southern Territories',
			'Gabon',
			'Gambia',

			'Georgia',
			'Germany',
			'Ghana',
			'Gibraltar',
			'Greece',
			'Greenland',
			'Grenada',
			'Guadeloupe',
			'Guam',
			'Guatemala',
			'Guinea',
			'Guinea-Bissau',
			'Guyana',
			'Haiti',
			'Heard and Mc Donald Islands',

			'Holy See (Vatican City State)',
			'Honduras',
			'Hong Kong',
			'Hungary',
			'Iceland',
			'India',
			'Indonesia',
			'Iran (Islamic Republic of)',
			'Iraq',
			'Ireland',
			'Israel',
			'Italy',
			'Jamaica',
			'Japan',
			'Jordan',

			'Kazakhstan',
			'Kenya',
			'Kiribati',
			"Korea, Democratic People's Republic of",
			'Korea, Republic of',
			'Kuwait',
			'Kyrgyzstan',
			"Lao, People's Democratic Republic",
			'Latvia',
			'Lebanon',
			'Lesotho',
			'Liberia',

			'Libyan Arab Jamahiriya',
			'Liechtenstein',
			'Lithuania',
			'Luxembourg',
			'Macau',
			'Macedonia, The Former Yugoslav Republic of',
			'Madagascar',
			'Malawi',
			'Malaysia',
			'Maldives',
			'Mali',
			'Malta',
			'Marshall Islands',

			'Martinique',
			'Mauritania',
			'Mauritius',
			'Mayotte',
			'Mexico',
			'Micronesia, Federated States of',
			'Moldova, Republic of',
			'Monaco',
			'Mongolia',
			'Montserrat',
			'Morocco',
			'Mozambique',
			'Myanmar',
			'Namibia',
			'Nauru',

			'Nepal',
			'Netherlands',
			'Netherlands Antilles',
			'New Caledonia',
			'New Zealand',
			'Nicaragua',
			'Niger',
			'Nigeria',
			'Niue',
			'Norfolk Island',
			'Northern Mariana Islands',
			'Norway',
			'Oman',
			'Pakistan',
			'Palau',
			'Panama',

			'Papua New Guinea',
			'Paraguay',
			'Peru',
			'Philippines',
			'Pitcairn',
			'Poland',
			'Portugal',
			'Puerto Rico',
			'Qatar',
			'Reunion',
			'Romania',
			'Russian Federation',
			'Rwanda',
			'Saint Kitts and Nevis',
			'Saint Lucia',

			'Saint Vincent and the Grenadines',
			'Samoa',
			'San Marino',
			'Sao Tome and Principe',
			'Saudi Arabia',
			'Senegal',
			'Seychelles',
			'Sierra Leone',
			'Singapore',
			'Slovakia (Slovak Republic)',
			'Slovenia',
			'Solomon Islands',

			'Somalia',
			'South Africa',
			'South Georgia and the South Sandwich Islands',
			'Spain',
			'Sri Lanka',
			'St. Helena',
			'St. Pierre and Miquelon',
			'Sudan',
			'Suriname',
			'Svalbard and Jan Mayen Islands',
			'Swaziland',
			'Sweden',

			'Switzerland',
			'Syrian Arab Republic',
			'Taiwan, Province of China',
			'Tajikistan',
			'Tanzania, United Republic of',
			'Thailand',
			'Togo',
			'Tokelau',
			'Tonga',
			'Trinidad and Tobago',
			'Tunisia',
			'Turkey',
			'Turkmenistan',

			'Turks and Caicos Islands',
			'Tuvalu',
			'Uganda',
			'Ukraine',
			'United Arab Emirates',
			'United Kingdom',
			'United States',
			'United States Minor Outlying Islands',
			'Uruguay',
			'Uzbekistan',
			'Vanuatu',
			'Venezuela',

			'Vietnam',
			'Virgin Islands (British)',
			'Virgin Islands (U.S.)',
			'Wallis and Futuna Islands',
			'Western Sahara',
			'Yemen',
			'Yugoslavia',
			'Zambia',
			'Zimbabwe',
		];

		$countries = apply_filters( 'bpm_cl_filter', $countries );

		$petitions_options = get_option( 'petitions_options' );

		$bptm_more_countries = 0;

		if ( isset( $petitions_options['bptm_more_countries'] ) && $petitions_options['bptm_more_countries'] != '' ) {

			$custom_countries = explode( ',', $petitions_options['bptm_more_countries'] );

			if ( sizeof( $custom_countries ) > 0 ) {

				$bptm_more_countries = 1;
			}
		}

		// Append new countries in old list.

		if ( $bptm_more_countries == 1 ) {

			foreach ( $custom_countries as $key => $value ) {

				array_push( $countries, ucfirst( $value ) );
			}
		}

		sort( $countries );

		$countries_string = '<select name="' . $fn . '" id="' . $fn . '" class="' . $cc . ' ' . $fc . '"  data-required="' . $fr . '" data-error_msg="' . $fer . '" >';

		$countries_string .= '<option value="" selected="selected">' . $fp . '</option>';

		foreach ( $countries as $country_name ) {

			$country_name = \mb_convert_encoding( $country_name, 'UTF-8' );

			$countries_string .= '<option value="' . strtolower( $country_name ) . '">' . $country_name . '</option>';
		}

		$countries_string .= '</select>';

		return $countries_string;
	}
}

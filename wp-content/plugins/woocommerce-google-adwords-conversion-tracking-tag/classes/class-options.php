<?php
/**
 * Options class
 * https://stackoverflow.com/a/55658771/4688612
 */

namespace WCPM\Classes;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Options {

	private static $options;
	private static $options_obj;

	private static $did_init = false;

	private static function init() {

		// If already initialized, do nothing
		if (self::$did_init) {
			return;
		}

		self::$did_init = true;

		self::$options = get_option(PMW_DB_OPTIONS_NAME);

		if (self::$options) { // If option retrieved, update it with new defaults

			// running the DB updater
			Database::run_options_db_upgrade();

			// Update options that are missing with defaults, recursively
			self::$options = self::update_with_defaults(self::$options, self::get_default_options());
		} else { // If option not available, get default options and save it

			self::$options = self::get_default_options();
			update_option(PMW_DB_OPTIONS_NAME, self::$options);
		}

		self::$options_obj = self::encode_options_object(self::$options);
	}

	private function __construct() {
		// Do nothing
	}

	public static function get_options() {
		self::init();

		return self::$options;
	}

	public static function get_options_obj() {
		self::init();

		return self::$options_obj;
	}

	public static function encode_options_object( $options ) {

		// This is the most elegant way to convert an array to an object recursively
		$options_obj = json_decode(wp_json_encode($options));

		if (function_exists('get_woocommerce_currency')) {
			$options_obj->shop->currency = get_woocommerce_currency();
		}

		return $options_obj;
	}

	// get the default options
	public static function get_default_options() {

		// default options settings
		return [
			'bing'       => [
				'uet_tag_id' => ''
			],
			'facebook'   => [
				'pixel_id'  => '',
				'microdata' => false,
				'capi'      => [
					'token'             => '',
					'test_event_code'   => '',
					'user_transparency' => [
						'process_anonymous_hits'             => false,
						'send_additional_client_identifiers' => false,
					]
				]
			],
			'google'     => [
				'ads'          => [
					'conversion_id'            => '',
					'conversion_label'         => '',
					'aw_merchant_id'           => '',
					'product_identifier'       => 0,
					'google_business_vertical' => 0,
					'dynamic_remarketing'      => false, // TODO should be moved to a more general section
					'phone_conversion_number'  => '',
					'phone_conversion_label'   => '',
					'enhanced_conversions'     => false,
					'conversion_adjustments'   => [
						'conversion_name' => '',
					],
				],
				'analytics'    => [
					'universal'        => [
						'property_id' => '',
					],
					'ga4'              => [
						'measurement_id'          => '',
						'api_secret'              => '',
						'data_api'                => [
							'property_id' => '',
							'credentials' => [],
						],
						'page_load_time_tracking' => false,
					],
					'link_attribution' => false,
				],
				'optimize'     => [
					'container_id'         => '',
					'anti_flicker'         => false,
					'anti_flicker_timeout' => 4000,
				],
				'consent_mode' => [
					'active'  => false,
					'regions' => [],
				],
				'user_id'      => false,
			],
			'hotjar'     => [
				'site_id' => ''
			],
			'pinterest'  => [
				'pixel_id'          => '',
				'ad_account_id'     => '',
				'enhanced_match'    => false,
				'advanced_matching' => false,
				'apic'              => [
					'token'                  => '',
					'process_anonymous_hits' => false,
				]
			],
			'snapchat'   => [
				'pixel_id' => ''
			],
			'tiktok'     => [
				'pixel_id'          => '',
				'advanced_matching' => false,
				'eapi'              => [
					'token'                  => '',
					'test_event_code'        => '',
					'process_anonymous_hits' => false,
				],
			],
			'twitter'    => [
				'pixel_id'  => '',
				'event_ids' => [
					'view_content'      => '',
					'search'            => '',
					'add_to_cart'       => '',
					'add_to_wishlist'   => '',
					'initiate_checkout' => '',
					//					'add_payment_info'      => '',
					'purchase'          => '',
				]
			],
			'pixels'     => [
				'reddit' => [
					'advertiser_id'     => '',
					'advanced_matching' => false,
				],
			],
			'shop'       => [
				'order_total_logic'             => 0,
				'cookie_consent_mgmt'           => [
					'explicit_consent' => false,
				],
				'order_deduplication'           => true,
				'disable_tracking_for'          => [],
				'order_list_info'               => true,
				'subscription_value_multiplier' => 1.00,
			],
			'general'    => [
				'variations_output'          => true,  // TODO maybe should be in the shop section
				'maximum_compatibility_mode' => false,
				'pro_version_demo'           => false,
				'scroll_tracker_thresholds'  => [],
				'lazy_load_pmw'              => false,
			],
			'db_version' => PMW_DB_VERSION,
		];
	}

	public static function update_with_defaults( $target_array, $default_array ) {

//		error_log(print_r($target_array, true));

		// Walk through every key in the default array
		foreach ($default_array as $default_key => $default_value) {

			// If the target key doesn't exist yet
			// copy all default values,
			// including the subtree if one exists,
			// into the target array.
			if (!isset($target_array[$default_key])) {
				$target_array[$default_key] = $default_value;

				// We only want to keep going down the tree
				// if the array contains more settings in an associative array,
				// otherwise we keep the settings of what's in the target array.
			} elseif (self::is_associative_array($default_value)) {

				$target_array[$default_key] = self::update_with_defaults($target_array[$default_key], $default_value);
			}
		}

//		error_log(print_r($target_array, true));
		return $target_array;
	}

	protected static function does_contain_nested_arrays( $array ) {

		foreach ($array as $key) {
			if (is_array($key)) {
				return true;
			}
		}

		return false;
	}

	protected static function is_associative_array( $array ) {

		if (is_array($array)) {
			return ( array_values($array) !== $array );
		} else {
			return false;
		}
	}

	public static function get_db_version() {
		return self::get_options_obj()->db_version;
	}

	public static function server_2_server_enabled() {
		return
			self::is_facebook_capi_enabled()
			|| self::is_tiktok_eapi_enabled()
			|| self::is_pinterest_apic_active();
	}

	public static function is_facebook_enabled() {
		return (bool) self::get_options_obj()->facebook->pixel_id;
	}

	public static function is_facebook_capi_enabled() {
		return self::is_facebook_enabled() && self::get_options_obj()->facebook->capi->token;
	}

	public static function is_tiktok_enabled() {
		return (bool) self::get_options_obj()->tiktok->pixel_id;
	}

	public static function is_tiktok_eapi_enabled() {
		return self::is_tiktok_enabled() && self::get_options_obj()->tiktok->eapi->token;
	}

	public static function is_tiktok_eapi_active() {
		return self::get_options_obj()->tiktok->pixel_id && self::get_options_obj()->tiktok->eapi->token;
	}

	public static function is_hotjar_enabled() {
		return (bool) self::get_options_obj()->hotjar->site_id;
	}

	public static function is_bing_enabled() {
		return (bool) self::get_options_obj()->bing->uet_tag_id;
	}

	public static function is_snapchat_enabled() {
		return (bool) self::get_options_obj()->snapchat->pixel_id;
	}

	public static function is_pinterest_enabled() {
		return (bool) self::get_options_obj()->pinterest->pixel_id;
	}

	public static function is_pinterest_enhanced_match_enabled() {
		return self::get_options_obj()->pinterest->enhanced_match;
	}

	public static function get_pinterest_ad_account_id() {
		return self::get_options_obj()->pinterest->ad_account_id;
	}

	public static function is_pinterest_ad_account_id_active() {
		return self::get_options_obj()->pinterest->ad_account_id;
	}

	public static function is_pinterest_apic_active() {
		return self::get_options_obj()->pinterest->ad_account_id && self::get_options_obj()->pinterest->apic->token;
	}

	public static function get_pinterest_apic_token() {
		return self::get_options_obj()->pinterest->apic->token;
	}

	public static function is_pinterest_advanced_matching_active() {
		return self::get_options_obj()->pinterest->advanced_matching;
	}

	public static function is_pinterest_apic_process_anonymous_hits() {
		return self::get_options_obj()->pinterest->apic->process_anonymous_hits;
	}

	public static function is_twitter_enabled() {
		return (bool) self::get_options_obj()->twitter->pixel_id;
	}

	public static function is_google_ads_purchase_conversion_enabled() {
		if (
			self::get_options_obj()->google->ads->conversion_id
			&& self::get_options_obj()->google->ads->conversion_label
		) {
			return true;
		}

		return false;
	}

	public static function is_google_ads_enabled() {
		return (bool) self::get_options_obj()->google->ads->conversion_id;
	}

	public static function get_google_ads_conversion_id() {
		return self::get_options_obj()->google->ads->conversion_id;
	}

	public static function is_google_ads_enhanced_conversions_active() {
		if (
			self::is_google_ads_purchase_conversion_enabled()
			&& self::get_options_obj()->google->ads->enhanced_conversions
		) {
			return true;
		}

		return false;
	}

	public static function is_google_ads_conversion_adjustments_active() {
		if (
			self::is_google_ads_purchase_conversion_enabled()
			&& self::get_options_obj()->google->ads->conversion_adjustments->conversion_name
		) {
			return true;
		}

		return false;
	}

	public static function is_google_ads_conversion_cart_data_enabled() {
		if (
			self::is_google_ads_purchase_conversion_enabled()
			&& self::get_options_obj()->google->ads->aw_merchant_id
		) {
			return true;
		}

		return false;
	}

	public static function is_at_least_one_paid_ads_pixel_active() {
		return self::is_bing_enabled()
			|| self::is_facebook_enabled()
			|| self::is_google_ads_purchase_conversion_enabled()
			|| self::is_pinterest_enabled()
			|| self::is_reddit_enabled()
			|| self::is_snapchat_enabled()
			|| self::is_tiktok_enabled()
			|| self::is_twitter_enabled();
	}

	public static function is_dynamic_remarketing_enabled() {
		return self::get_options_obj()->google->ads->dynamic_remarketing;
	}

	public static function is_dynamic_remarketing_variations_output_enabled() {
		return self::get_options_obj()->general->variations_output;
	}

	public static function is_google_optimize_active() {
		return self::get_options_obj()->google->optimize->container_id;
	}

	public static function get_subscription_multiplier() {
		return self::get_options_obj()->shop->subscription_value_multiplier;
	}

	public static function is_lazy_load_pmw_active() {
		return self::get_options_obj()->general->lazy_load_pmw;
	}

	public static function is_google_optimize_anti_flicker_active() {

		// Google Optimize must be enabled in order to use the anti-flicker snippet.
		if (!self::is_google_optimize_active()) {
			return false;
		}

		// Either the anti-flicker snippet is enabled in the settings by the user,
		// or it is automatically enabled if PMW Lazy Load is enabled.
		if (self::get_options_obj()->google->optimize->anti_flicker) {
			return true;
		}

		return false;
	}

	public static function lazy_load_requirements() {

		// If Google Optimize is active we need to make sure that the Google Optimize anti flicker snippet is active too

		if (!self::is_google_optimize_active()) {
			return true;
		}

		if (self::is_google_optimize_anti_flicker_active()) {
			return true;
		}

		return false;
	}

	public static function is_ga3_enabled() {
		return self::get_options_obj()->google->analytics->universal->property_id;
	}

	public static function is_ga4_enabled() {
		return self::get_options_obj()->google->analytics->ga4->measurement_id;
	}

	public static function is_ga3_or_ga4_enabled() {
		return self::is_ga3_enabled() || self::is_ga4_enabled();
	}

	public static function are_ga3_and_ga4_enabled() {
		return self::is_ga3_enabled() && self::is_ga4_enabled();
	}

	public static function get_reddit_advertiser_id() {
		return self::get_options_obj()->pixels->reddit->advertiser_id;
	}

	public static function is_reddit_enabled() {
		return (bool) self::get_reddit_advertiser_id();
	}

	public static function is_reddit_advanced_matching_enabled() {
		return self::get_options_obj()->pixels->reddit->advanced_matching;
	}
}

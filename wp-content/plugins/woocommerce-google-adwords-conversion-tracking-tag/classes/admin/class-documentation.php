<?php

namespace WCPM\Classes\Admin;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Documentation {

	public static function get_link( $key = 'default' ) {

		// Change to wcm through gulp for the wcm distribution
		$doc_host_url = 'default';

		$url = self::get_documentation_host() . self::get_documentation_path($key, $doc_host_url);

		return self::add_utm_parameters($url, $key);
	}

	private static function add_utm_parameters( $url, $key ) {

		$url_parts = explode('#', $url);

		$url = $url_parts[0] . '?utm_source=woocommerce-plugin&utm_medium=documentation-link&utm_campaign=' . str_replace('_', '-', $key);

		if (count($url_parts) === 2) {
			$url .= '#' . $url_parts[1];
		}

		return $url;
	}

	private static function get_documentation_host() {
		return 'https://sweetcode.com';
	}

	private static function get_documentation_path( $key = 'default', $doc_host_url = 'default' ) {

		$documentation_links = [
			'default'                                                => [
				'default' => '/docs/wpm/',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'script_blockers'                                        => [
				'default' => '/docs/wpm/setup/script-blockers/',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/script-blockers/'],
			'google_analytics_universal_property'                    => [
				'default' => '/docs/wpm/plugin-configuration/google-analytics',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-analytics/'],
			'google_analytics_4_id'                                  => [
				'default' => '/docs/wpm/plugin-configuration/google-analytics#connect-an-existing-google-analytics-4-property',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-analytics/#section-3'],
			'google_ads_conversion_id'                               => [
				'default' => '/docs/wpm/plugin-configuration/google-ads#configure-the-plugin',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-ads/#section-2'],
			'google_ads_conversion_label'                            => [
				'default' => '/docs/wpm/plugin-configuration/google-ads#configure-the-plugin',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-ads/#section-2'],
			'google_optimize_container_id'                           => [
				'default' => '/docs/wpm/plugin-configuration/google-optimize',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-optimize/'],
			'google_optimize_anti_flicker'                           => [
				'default' => '/docs/wpm/plugin-configuration/google-optimize#anti-flicker-snippet',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-optimize/#section-3'],
			'google_optimize_anti_flicker_timeout'                   => [
				'default' => '/docs/wpm/plugin-configuration/google-optimize#adjusting-the-anti-flicker-snippet-timeout',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-optimize/#section-3'],
			'facebook_pixel_id'                                      => [
				'default' => '/docs/wpm/plugin-configuration/meta#find-the-pixel-id',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/facebook/#find-the-pixel-id'],
			'bing_uet_tag_id'                                        => [
				'default' => '/docs/wpm/plugin-configuration/microsoft-advertising#setting-up-the-uet-tag',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/microsoft-advertising-bing-ads/#section-1'],
			'twitter_pixel_id'                                       => [
				'default' => '/docs/wpm/plugin-configuration/twitter#pixel-id',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'twitter_event_ids'                                      => [
				'default' => '/docs/wpm/plugin-configuration/twitter#event-setup',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'pinterest_pixel_id'                                     => [
				'default' => '/docs/wpm/plugin-configuration/pinterest',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/pinterest/'],
			'snapchat_pixel_id'                                      => [
				'default' => '/docs/wpm/plugin-configuration/snapchat',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'tiktok_pixel_id'                                        => [
				'default' => '/docs/wpm/plugin-configuration/tiktok',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/tiktok/'],
			'tiktok_advanced_matching'                               => [
				'default' => '/docs/wpm/plugin-configuration/tiktok#advanced-matching',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/tiktok/#tiktok-advanced-matching'],
			'tiktok_eapi_token'                                      => [
				'default' => '/docs/wpm/plugin-configuration/tiktok#access-token',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/tiktok/#access-token'],
			'tiktok_eapi_process_anonymous_hits'                     => [
				'default' => '/docs/wpm/plugin-configuration/tiktok#process-anonymous-hits',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/tiktok/#process-anonymous-hits'],
			'hotjar_site_id'                                         => [
				'default' => '/docs/wpm/plugin-configuration/hotjar#hotjar-site-id',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/hotjar/#section-1'],
			'google_gtag_deactivation'                               => [
				'default' => '/docs/wpm/faq/&utm_medium=documentation-link&utm_campaign=pixel-manager-for-woocommerce-docs&utm_content=gtag-js#google-tag-assistant-reports-multiple-installations-of-global-site-tag-gtagjs-detected-what-shall-i-do',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'google_consent_mode'                                    => [
				'default' => '/docs/wpm/consent-management/google-consent-mode',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/consent-management/google-consent-mode/'],
			'google_consent_regions'                                 => [
				'default' => '/docs/wpm/consent-management/google-consent-mode#regions',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/consent-management/google-consent-mode/#section-3'],
			'google_analytics_eec'                                   => [
				'default' => '/docs/wpm/plugin-configuration/google-analytics#enhanced-e-commerce-funnel-setup',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-analytics/#section-5'],
			'google_analytics_4_api_secret'                          => [
				'default' => '/docs/wpm/plugin-configuration/google-analytics#ga4-api-secret',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-analytics/#section-4'],
			'google_ads_enhanced_conversions'                        => [
				'default' => '/docs/wpm/plugin-configuration/google-ads#enhanced-conversions',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-ads/#section-5'],
			'google_ads_phone_conversion_number'                     => [
				'default' => '/docs/wpm/plugin-configuration/google-ads#phone-conversion-number',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-ads/#section-4'],
			'google_ads_phone_conversion_label'                      => [
				'default' => '/docs/wpm/plugin-configuration/google-ads#phone-conversion-number',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-ads/#section-4'],
			'explicit_consent_mode'                                  => [
				'default' => '/docs/wpm/consent-management/overview/#explicit-consent-mode',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/consent-management/overview/#section-1'],
			'facebook_capi_token'                                    => [
				'default' => '/docs/wpm/plugin-configuration/meta/#meta-facebook-conversion-api-capi',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/facebook/#section-4'],
			'facebook_capi_user_transparency_process_anonymous_hits' => [
				'default' => '/docs/wpm/plugin-configuration/meta#user-transparency-settings',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/facebook/#section-5'],
			'facebook_advanced_matching'                             => [
				'default' => '/docs/wpm/plugin-configuration/meta#meta-facebook-advanced-matching',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/facebook/#section-8'],
			'facebook_microdata'                                     => [
				'default' => '/docs/wpm/plugin-configuration/meta#microdata-tags-for-catalogues',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/facebook/#section-8'],
			'maximum_compatibility_mode'                             => [
				'default' => '/docs/wpm/plugin-configuration/general-settings/#maximum-compatibility-mode',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'google_ads_dynamic_remarketing'                         => [
				'default' => '/docs/wpm/plugin-configuration/dynamic-remarketing',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/dynamic-remarketing/'],
			'variations_output'                                      => [
				'default' => '/docs/wpm/plugin-configuration/dynamic-remarketing',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/dynamic-remarketing/'],
			'aw_merchant_id'                                         => [
				'default' => '/docs/wpm/plugin-configuration/google-ads/#conversion-cart-data',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-ads/#section-3'],
			'custom_thank_you'                                       => [
				'default' => '/docs/wpm/troubleshooting/#wc-custom-thank-you',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/troubleshooting/#wc-custom-thank-you'],
			'the_dismiss_button_doesnt_work_why'                     => [
				'default' => '/docs/wpm/faq/#the-dismiss-button-doesnt-work-why',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/faq/#section-10'],
			'wp-rocket-javascript-concatenation'                     => [
				'default' => '/docs/wpm/troubleshooting',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'litespeed-cache-inline-javascript-after-dom-ready'      => [
				'default' => '/docs/wpm/troubleshooting',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'payment-gateways'                                       => [
				'default' => '/docs/wpm/setup/requirements#payment-gateways',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/requirements/#payment-gateways'],
			'test_order'                                             => [
				'default' => '/docs/wpm/testing#test-order',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/testing/'],
			'payment_gateway_tracking_accuracy'                      => [
				'default' => '/docs/wpm/diagnostics/#payment-gateway-tracking-accuracy-report',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/diagnostics/#payment-gateway-tracking-accuracy-report'],
			'acr'                                                    => [
				'default' => '/docs/wpm/features/acr',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/features/automatic-conversion-recovery-acr/'],
			'order_list_info'                                        => [
				'default' => '/docs/wpm/plugin-configuration/general-settings#order-list-info',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/general-settings/#order-list-info'],
			'order_total_logic'                                      => [
				'default' => '/docs/wpm/plugin-configuration/general-settings#order-total-logic',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'order_subtotal'                                         => [
				'default' => '/docs/wpm/plugin-configuration/general-settings#order-subtotal-default',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'order_total'                                            => [
				'default' => '/docs/wpm/plugin-configuration/general-settings#order-total',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/'],
			'order_profit_margin'                                    => [
				'default' => '/docs/wpm/plugin-configuration/general-settings#profit-margin',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/general-settings/#profit-margin'],
			'scroll_tracker_threshold'                               => [
				'default' => '/docs/wpm/plugin-configuration/general-settings/#scroll-tracker',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/general-settings/#section-8'],
			'google_ads_conversion_adjustments'                      => [
				'default' => '/docs/wpm/plugin-configuration/google-ads#conversion-adjustments',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-ads/#section-6'],
			'ga4_data_api_property_id'                               => [
				'default' => '/docs/wpm/plugin-configuration/google-analytics#ga4-property-id',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-analytics/#ga4-property-id'],
			'ga4_data_api_credentials'                               => [
				'default' => '/docs/wpm/plugin-configuration/google-analytics#ga4-data-api-credentials',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-analytics/#ga4-data-api-credentials'],
			'duplication_prevention'                                 => [
				'default' => '/docs/wpm/shop#order-duplication-prevention',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/shop/#order-duplication-prevention'],
			'license_expired_warning'                                => [
				'default' => '/docs/wpm/license-management#expired-license-warning',
				'wcm'     => '/'],
			'subscription_value_multiplier'                          => [
				'default' => '/docs/wpm/plugin-configuration/general-settings#subscription-value-multiplier',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/general-settings/#section-9'],
			'lazy_load_pmw'                                          => [
				'default' => '/docs/wpm/plugin-configuration/general-settings#lazy-load-the-pixel-manager',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/general-settings/#lazy-load-the-pixel-manager'],
			'opportunity_google_ads_enhanced_conversions'            => [
				'default' => '/docs/wpm/opportunities#google-ads-enhanced-conversions',
				'wcm'     => ''],
			'opportunity_google_ads_conversion_adjustments'          => [
				'default' => '/docs/wpm/opportunities#google-ads-conversion-adjustments',
				'wcm'     => ''],
			'ga4_page_load_time_tracking'                            => [
				'default' => '/docs/wpm/plugin-configuration/google-analytics#page-load-time-tracking',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/google-analytics/#section-9'],
			'reddit_advertiser_id'                                   => [
				'default' => '/docs/wpm/plugin-configuration/reddit#setup-instruction',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/reddit/'],
			'reddit_advanced_matching'                               => [
				'default' => '/docs/wpm/plugin-configuration/reddit#advanced-matching',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/reddit/#section-3'],
			'pinterest_ad_account_id'                                => [
				'default' => '/docs/wpm/plugin-configuration/pinterest#ad-account-id',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/pinterest/#section-5'],
			'pinterest_apic_token'                                   => [
				'default' => '/docs/wpm/plugin-configuration/pinterest#api-for-conversions-token',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/pinterest/#section-6'],
			'pinterest_apic_process_anonymous_hits'                  => [
				'default' => '/docs/wpm/plugin-configuration/pinterest#process-anonymous-hits',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/pinterest/#section-8'],
			'pinterest_enhanced_match'                               => [
				'default' => '/docs/wpm/plugin-configuration/pinterest#enhanced-match',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/pinterest/#pinterest-enhanced-match'],
			'pinterest_advanced_matching'                            => [
				'default' => '/docs/wpm/plugin-configuration/pinterest#advanced-matching',
				'wcm'     => '/document/pixel-manager-pro-for-woocommerce/pmw-plugin-configuration/pinterest/#section-7'],
		];

		if (array_key_exists($key, $documentation_links)) {
			return $documentation_links[$key][$doc_host_url];
		} else {
			return $documentation_links['default'][$doc_host_url];
		}
	}
}

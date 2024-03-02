<?php

namespace WCPM\Classes\Admin;

use WCPM\Classes\Helpers;
use WCPM\Classes\Options;
use WCPM\Classes\Profit_Margin;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Environment {

	public static function is_allowed_notification_page( $page = null ) {

		global $pagenow;

		if (is_null($page)) {
			$page = $pagenow;
		}

		// Don't check for the plugin settings page. Notifications have to be handled there.
		$allowed_pages = [
			'index.php',
			'dashboard'
		];

		foreach ($allowed_pages as $allowed_page) {
			if (strpos($page, $allowed_page) !== false) {
				return true;
			}
		}

		return false;
	}

	public static function is_pmw_settings_page() {

		if (!is_admin()) {
			return false;
		}

		$_get = Helpers::get_input_vars_sanitized(INPUT_GET);
		$page = isset($_get['page']) ? $_get['page'] : '';

		if ('wpm' !== $page) {
			return false;
		}

		return true;
	}

	public static function is_not_allowed_notification_page( $page = null ) {
		return !self::is_allowed_notification_page($page);
	}

	public static function run_incompatible_plugins_checks() {

		$saved_notifications = get_option(PMW_DB_NOTIFICATIONS_NAME);

		foreach (self::get_incompatible_plugins_list() as $plugin) {

			// If the plugin is not active, continue
			if (!is_plugin_active($plugin['file_location'])) {
				continue;
			}

			// If a notification has already been saved for this plugin, continue
			if (
				is_array($saved_notifications)
				&& array_key_exists($plugin['slug'], $saved_notifications)
			) {
				continue;
			}

			Notifications::plugin_is_incompatible(
				$plugin['name'],
				$plugin['version'],
				$plugin['slug'],
				$plugin['link'],
				$plugin['pmw_doc_link']
			);
		}
	}

	public static function get_incompatible_plugins_list() {
		return [
			'wc-custom-thank-you' => [
				'name'          => 'WC Custom Thank You',
				'slug'          => 'wc-custom-thank-you',
				'file_location' => 'wc-custom-thank-you/woocommerce-custom-thankyou.php',
				'link'          => 'https://wordpress.org/plugins/wc-custom-thank-you/',
				'pmw_doc_link'  => Documentation::get_link('custom_thank_you'),
				'version'       => '1.2.1',
			]
		];
	}

	public static function flush_cache_on_plugin_changes() {

		// flush cache after saving the plugin options
		add_action('update_option_wgact_plugin_options', [__CLASS__, 'flush_cache_of_all_cache_plugins'], 10, 3);

		// flush cache after install
		// we don't need that because after first install the user needs to set new options anyway where the cache flush happens too
//        add_filter('upgrader_post_install', [__CLASS__, 'flush_cache_of_all_cache_plugins'], 10, 3);

		// flush cache after plugin update
		add_action('upgrader_process_complete', [__CLASS__, 'upgrader_flush_cache_if_pmw_was_updated'], 10, 2);
	}

	public static function upgrader_flush_cache_if_pmw_was_updated( $upgrader_object, $options ) {

		if (
			isset($options['type']) &&
			'plugin' === $options['type'] &&
			isset($options['plugins']) &&
			is_array($options['plugins']) &&
			in_array(PMW_PLUGIN_BASENAME, $options['plugins'], true)
		) {
			self::flush_cache_of_all_cache_plugins();
		}
	}

	public static function flush_cache_of_all_cache_plugins() {

//        error_log('flush cache of all cache plugins');
		if (self::is_wp_rocket_active()) {
			self::flush_wp_rocket_cache();
		}                                                                              // works
		if (self::is_litespeed_active()) {
			self::flush_litespeed_cache();
		}                                                                              // works
		if (self::is_autoptimize_active()) {
			self::flush_autoptimize_cache();
		}                                                                              // works
		if (self::is_hummingbird_active()) {
			self::flush_hummingbird_cache();
		}                                                                              // works
		if (self::is_nitropack_active()) {
			self::flush_nitropack_cache();
		}                                                                              // works
		if (self::is_sg_optimizer_active()) {
			self::flush_sg_optimizer_cache();
		}                                                                              // works
		if (self::is_w3_total_cache_active()) {
			self::flush_w3_total_cache();
		}                                                                              // works
		if (self::is_wp_optimize_active()) {
			self::flush_wp_optimize_cache();
		}                                                                              // works
		if (self::is_wp_super_cache_active()) {
			self::flush_wp_super_cache();
		}                                                                              // works
		if (self::is_wp_fastest_cache_active()) {
			self::flush_wp_fastest_cache();
		}                                                                              // works
		if (self::is_cloudflare_active()) {
			self::flush_cloudflare_cache();
		}                                                                              // works
		if (self::is_flying_press_active()) {
			self::flush_flying_press_cache();
		}                                                                              // works


		if (self::is_hosting_wp_engine()) {
			self::flush_wp_engine_cache();
		}         // works
//        if (self::is_hosting_pagely()) $this->flush_pagely_cache();               // TODO test
		if (self::is_hosting_kinsta()) {
			self::flush_kinsta_cache();
		}                                                                          // TODO test
//
//        if ($this->is_nginx_helper_active()) $this->flush_nginx_cache();           // TODO test

		// TODO add generic varnish purge
	}

	private static function flush_kinsta_cache() {
		try {
			wp_remote_get('https://localhost/kinsta-clear-cache-all', [
				'sslverify' => false,
				'timeout'   => 5
			]);

		} catch (\Exception $e) {
			error_log($e);
		}
	}

	public static function is_nginx_helper_active() {
		return defined('NGINX_HELPER_BASEPATH');
	}

	private static function flush_nginx_cache() {
		global $nginx_purger;
		if ($nginx_purger) {
			$nginx_purger->purge_all();
		}
		return true;
	}

	public static function flush_cloudflare_cache() {
		try {
			if (class_exists('\CF\WordPress\Hooks')) {
				( new \CF\WordPress\Hooks() )->purgeCacheEverything();
			}
		} catch (\Exception $e) {
			error_log($e);
		}
	}

	public static function flush_flying_press_cache() {
		try {
			if (class_exists('\FlyingPress\Purge') && method_exists('\FlyingPress\Purge', 'purge_cached_pages')) {
				\FlyingPress\Purge::purge_cached_pages();
			}
		} catch (\Exception $e) {
			error_log($e);
		}
	}

	public static function flush_wp_engine_cache() {
		try {
			if (class_exists('WpeCommon')) {
				\WpeCommon::purge_varnish_cache_all();
			}
		} catch (\Exception $e) {
			error_log($e);
		}
	}

	private static function flush_pagely_cache() {
		try {
			if (class_exists('PagelyCachePurge')) { // We need to have this check for clients that switch hosts
				$pagely = new \PagelyCachePurge();
				$pagely->purgeAll();
			}
		} catch (\Exception $e) {
			error_log($e);
		}
	}

	public static function flush_wp_fastest_cache() {
		if (function_exists('wpfc_clear_all_cache')) {
			wpfc_clear_all_cache(true);
		}
	}

	public static function flush_wp_super_cache() {
		if (function_exists('wp_cache_clean_cache')) {
			global $file_prefix;
			wp_cache_clean_cache($file_prefix, true);
		}
	}

	public static function flush_wp_optimize_cache() {
		if (function_exists('wpo_cache_flush')) {
			wpo_cache_flush();
		}
	}

	public static function flush_w3_total_cache() {
		if (function_exists('w3tc_flush_all')) {
			w3tc_flush_all();
		}
	}

	public static function flush_sg_optimizer_cache() {
		if (function_exists('sg_cachepress_purge_everything')) {
			sg_cachepress_purge_everything();
		}
	}

	public static function flush_nitropack_cache() {
		try {
			if (class_exists('\NitroPack\SDK\Api\Cache')) {
				$siteId     = get_option('nitropack-siteId');
				$siteSecret = get_option('nitropack-siteSecret');
				( new \NitroPack\SDK\Api\Cache($siteId, $siteSecret) )->purge();
			}

		} catch (\Exception $e) {
			error_log($e);
		}

//        do_action('nitropack_integration_purge_all');
	}

	public static function flush_hummingbird_cache() {
		do_action('wphb_clear_page_cache');
	}

	public static function flush_autoptimize_cache() {
		if (class_exists('autoptimizeCache')) {
			// we need the backslash because autoptimizeCache is in the global namespace
			// and otherwise our plugin would search in its own namespace and throw an error
			\autoptimizeCache::clearall();
		}
	}

	public static function flush_litespeed_cache() {
		do_action('litespeed_purge_all');
	}

	protected static function flush_wp_rocket_cache() {
		// flush WP Rocket cache
		if (function_exists('rocket_clean_domain')) {
			rocket_clean_domain();
		}

		// Preload cache.
		if (function_exists('run_rocket_bot')) {
			run_rocket_bot();
		}

		if (function_exists('run_rocket_sitemap_preload')) {
			run_rocket_sitemap_preload();
		}
	}

	public static function run_checks() {
//        $this->check_wp_rocket_js_concatenation();
//        $this->check_litespeed_js_inline_after_dom();
	}

	public static function is_wp_rocket_active() {
		return is_plugin_active('wp-rocket/wp-rocket.php');
	}

	public static function is_sg_optimizer_active() {
		return is_plugin_active('sg-cachepress/sg-cachepress.php');
	}

	public static function is_w3_total_cache_active() {
		return is_plugin_active('w3-total-cache/w3-total-cache.php');
	}

	public static function is_litespeed_active() {
		// TODO find out if there is a pro version with different folder and file name

		return is_plugin_active('litespeed-cache/litespeed-cache.php');
	}

	public static function is_autoptimize_active() {
		// TODO find out if there is a pro version with different folder and file name

		return is_plugin_active('autoptimize/autoptimize.php');
	}

	public static function is_hummingbird_active() {
		// TODO find out if there is a pro version with different folder and file name

		return is_plugin_active('hummingbird-performance/wp-hummingbird.php');
	}

	public static function is_nitropack_active() {
		// TODO find out if there is a pro version with different folder and file name

		return is_plugin_active('nitropack/main.php');
	}

	public static function is_yoast_seo_active() {
		// TODO find out if there is a pro version with different folder and file name

		return is_plugin_active('wordpress-seo/wp-seo.php');
	}

	public static function is_borlabs_cookie_active() {
		// TODO find out if there is a pro version with different folder and file name

		return is_plugin_active('borlabs-cookie/borlabs-cookie.php');
	}

	public static function is_cookiebot_active() {
		return is_plugin_active('cookiebot/cookiebot.php');
	}

	public static function is_complianz_active() {
		return is_plugin_active('complianz-gdpr/complianz-gpdr.php') || is_plugin_active('complianz-gdpr-premium/complianz-gpdr-premium.php');
	}

	// Cookie Notice by hu-manity.co
	public static function is_cookie_notice_active() {
		return is_plugin_active('cookie-notice/cookie-notice.php');
	}

	public static function is_cookie_script_active() {
		return is_plugin_active('cookie-script-com/cookie-script.php');
	}

	public static function is_moove_gdpr_active() {
		return is_plugin_active('gdpr-cookie-compliance/moove-gdpr.php');
	}

	public static function is_cookie_law_info_active() {
		return is_plugin_active('cookie-law-info/cookie-law-info.php');
	}

	// WooCommerce Cost of Goods
	// https://woocommerce.com/products/woocommerce-cost-of-goods/
	public static function is_woocommerce_cog_active() {
		return class_exists('WC_COG') || is_plugin_active('woocommerce-cost-of-goods/woocommerce-cost-of-goods.php');
	}

	// Cost of Good for WooCommerce
	// https://wordpress.org/plugins/cost-of-goods-for-woocommerce/
	public static function is_cog_for_woocommerce_active() {
		return class_exists('Alg_WC_Cost_of_Goods') || is_plugin_active('cost-of-goods-for-woocommerce/cost-of-goods-for-woocommerce.php');
	}

	public static function is_a_cog_plugin_active() {
		return self::is_woocommerce_cog_active() || self::is_cog_for_woocommerce_active() || Profit_Margin::get_custom_cog_meta_key();
	}

	public static function is_some_cmp_active() {
		if (
			self::is_borlabs_cookie_active() ||
			self::is_cookiebot_active() ||
			self::is_complianz_active() ||
			self::is_cookie_notice_active() ||
			self::is_cookie_script_active() ||
			self::is_moove_gdpr_active() ||
			self::is_cookie_law_info_active()
		) {
			return true;
		} else {
			return false;
		}
	}

	public static function is_woocommerce_active() {
		return is_plugin_active('woocommerce/woocommerce.php');
	}

	public static function is_wp_super_cache_active() {
		// TODO find out if there is a pro version with different folder and file name

		return is_plugin_active('wp-super-cache/wp-cache.php');
	}

	public static function is_wp_fastest_cache_active() {
		// The pro version requires the free version to be active

		return is_plugin_active('wp-fastest-cache/wpFastestCache.php');
	}

	public static function is_cloudflare_active() {
		return is_plugin_active('cloudflare/cloudflare.php');
	}

	public static function is_wpml_woocommerce_multi_currency_active() {
		global $woocommerce_wpml;

		if (
			is_plugin_active('woocommerce-multilingual/wpml-woocommerce.php') &&
			is_object($woocommerce_wpml->multi_currency)
		) {
			return true;
		} else {
			return false;
		}
	}

	public static function is_woo_discount_rules_active() {
		return
			is_plugin_active('woo-discount-rules/woo-discount-rules.php') ||
			is_plugin_active('woo-discount-rules-pro/woo-discount-rules-pro.php');
	}

	public static function is_woofunnels_active() {
		return
			is_plugin_active('funnel-builder/funnel-builder.php') ||
			is_plugin_active('funnel-builder-pro/funnel-builder-pro.php');
	}

	public static function is_woo_product_feed_active() {
		return
			is_plugin_active('woo-product-feed-pro/woocommerce-sea.php') ||
			is_plugin_active('woo-product-feed-elite/woocommerce-sea.php');
	}

	public static function is_wp_optimize_active() {
		return is_plugin_active('wp-optimize/wp-optimize.php');
	}

	public static function is_woocommerce_brands_active() {
		return is_plugin_active('woocommerce-brands/woocommerce-brands.php');
	}

	public static function is_woocommerce_subscriptions_active() {
		return is_plugin_active('woocommerce-subscriptions/woocommerce-subscriptions.php');
	}

	public static function is_yith_wc_brands_active() {
		return is_plugin_active('yith-woocommerce-brands-add-on-premium/init.php');
	}

	public static function is_optimocha_active() {
		// TODO find out if there is a pro version with different folder and file name
		return is_plugin_active('speed-booster-pack/speed-booster-pack.php');
	}

	public static function is_async_javascript_active() {
		// TODO find out if there is a pro version with different folder and file name
		return is_plugin_active('async-javascript/async-javascript.php');
	}

	public static function is_flying_press_active() {
		// TODO find out if there is a pro version with different folder and file name
		return is_plugin_active('flying-press/flying-press.php');
	}

	/*
	 * Check to find out what hosting provider is being used
	 * */

	public static function is_hosting_flywheel() {
		return defined('FLYWHEEL_PLUGIN_DIR');
	}

	public static function is_hosting_cloudways() {

		$_server = Helpers::get_input_vars(INPUT_SERVER);

		if ($_server && array_key_exists('cw_allowed_ip', $_server)) {
			return true;
		} elseif (preg_match('~/home/.*?cloudways.*~', __FILE__)) {
			return true;
		} else {
			return false;
		}
	}

	public static function is_hosting_wp_engine() {
		return !!getenv('IS_WPE');
	}

	public static function is_hosting_godaddy_wpaas() {
		return class_exists('\WPaaS\Plugin');
	}

	public static function is_hosting_siteground() {
		$configFilePath = self::get_wpconfig_path();
		if (!$configFilePath) {
			return false;
		}
		return strpos(file_get_contents($configFilePath), 'Added by SiteGround WordPress management system') !== false;
	}

	public static function is_hosting_gridpane() {
		$configFilePath = self::get_wpconfig_path();
		if (!$configFilePath) {
			return false;
		}
		return strpos(file_get_contents($configFilePath), 'GridPane Cache Settings') !== false;
	}

	public static function is_hosting_kinsta() {
		return defined('KINSTAMU_VERSION');
	}

	public static function is_hosting_closte() {
		return defined('CLOSTE_APP_ID');
	}

	public static function is_hosting_pagely() {
		return class_exists('\PagelyCachePurge');
	}

	public static function get_hosting_provider() {
		if (self::is_hosting_flywheel()) {
			return 'Flywheel';
		} elseif (self::is_hosting_cloudways()) {
			return 'Cloudways';
		} elseif (self::is_hosting_wp_engine()) {
			return 'WP Engine';
		} elseif (self::is_hosting_siteground()) {
			return 'SiteGround';
		} elseif (self::is_hosting_godaddy_wpaas()) {
			return 'GoDaddy WPaas';
		} elseif (self::is_hosting_gridpane()) {
			return 'GridPane';
		} elseif (self::is_hosting_kinsta()) {
			return 'Kinsta';
		} elseif (self::is_hosting_closte()) {
			return 'Closte';
		} elseif (self::is_hosting_pagely()) {
			return 'Pagely';
		} else {
			return 'unknown';
		}
	}

// https://github.com/wp-cli/wp-cli/blob/c3bd5bd76abf024f9d492579539646e0d263a05a/php/utils.php#L257
	public static function get_wpconfig_path() {
		static $path;

		if (null === $path) {
			$path = false;

			if (getenv('WP_CONFIG_PATH') && file_exists(getenv('WP_CONFIG_PATH'))) {
				$path = getenv('WP_CONFIG_PATH');
			} elseif (file_exists(ABSPATH . 'wp-config.php')) {
				$path = ABSPATH . 'wp-config.php';
			} elseif (file_exists(dirname(ABSPATH) . '/wp-config.php') && !file_exists(dirname(ABSPATH) . '/wp-settings.php')) {
				$path = dirname(ABSPATH) . '/wp-config.php';
			}

			if ($path) {
				$path = realpath($path);
			}
		}

		return $path;
	}

	public static function disable_yoast_seo_facebook_social( $option ) {
		$option['opengraph'] = false;
		return $option;
	}

	public static function disable_litespeed_js_inline_after_dom( $option ) {
		return 0;
	}

	public static function wp_optimize_minify_default_exclusions( $default_exclusions ) {
		// $default_exclusions[] = 'something/else.js';
		// $default_exclusions[] = 'something/else.css';
		return array_unique(array_merge($default_exclusions, self::get_pmw_script_identifiers()));
	}

// https://github.com/futtta/autoptimize/blob/37b13d4e19269bb2f50df123257de51afa37244f/classes/autoptimizeScripts.php#L387
	public static function autoptimize_filter_js_consider_minified() {
		$exclude_js[] = 'wpm.min.js';
		$exclude_js[] = 'wpm.min.js';

		$exclude_js[] = 'wpm-public.p1.min.js';
		$exclude_js[] = 'wpm-public__premium_only.p1.min.js';

		$exclude_js[] = 'wpm-public.p2.min.js';
		$exclude_js[] = 'wpm-public__premium_only.p2.min.js';

//        $exclude_js[] = 'jquery.js';
//        $exclude_js[] = 'jquery.min.js';
		return $exclude_js;
	}

// https://github.com/futtta/autoptimize/blob/37b13d4e19269bb2f50df123257de51afa37244f/classes/autoptimizeScripts.php#L285
	public static function autoptimize_filter_js_dontmove( $dontmove ) {
		$dontmove[] = 'wpm.js';
		$dontmove[] = 'wpm.min.js';

		$dontmove[] = 'wpm-public.p1.min.js';
		$dontmove[] = 'wpm-public__premium_only.p1.min.js';

		$dontmove[] = 'wpm-public.p2.min.js';
		$dontmove[] = 'wpm-public__premium_only.p2.min.js';

		$dontmove[] = 'jquery.js';
		$dontmove[] = 'jquery.min.js';
		return $dontmove;
	}

	public static function litespeed_optm_cssjs( $excludes ) {
		return $excludes;
	}

	public static function litespeed_optimize_js_excludes( $excludes ) {
		if (is_array($excludes)) {
			$excludes = array_unique(array_merge($excludes, self::get_pmw_script_identifiers()));
		}

		return $excludes;
	}

	public static function litespeed_cache_js_defer_exc( $excludes ) {
		if (is_array($excludes)) {
			$excludes = array_unique(array_merge($excludes, self::get_pmw_script_identifiers()));
		}
		return $excludes;
	}

	public static function sg_optimizer_js_exclude_combine_inline_content( $exclude_list ) {
		if (is_array($exclude_list)) {
			$exclude_list = array_unique(array_merge($exclude_list, self::get_pmw_script_identifiers()));
		}

//        foreach (self::get_pmw_script_identifiers() as $exclusion) {
//            $exclude_list[] = $exclusion;
//        }

		return $exclude_list;
	}

	public static function sg_optimizer_js_minify_exclude( $exclude_list ) {

		$exclude_list[] = 'wpm-front-end-scripts';
		$exclude_list[] = 'wpm-front-end-scripts-premium-only';
		$exclude_list[] = 'wpm';
		$exclude_list[] = 'wpm-admin';
		$exclude_list[] = 'wpm-premium-only';
		$exclude_list[] = 'wpm-facebook';
		$exclude_list[] = 'wpm-script-blocker-warning';
		$exclude_list[] = 'wpm-admin-helpers';
		$exclude_list[] = 'wpm-admin-tabs';
		$exclude_list[] = 'wpm-selectWoo';
		$exclude_list[] = 'wpm-google-ads';
		$exclude_list[] = 'wpm-ga-ua-eec';
		$exclude_list[] = 'wpm-ga4-eec';
		$exclude_list[] = 'polyfill-io';

		$exclude_list[] = 'jquery';
		$exclude_list[] = 'jquery-core';
		$exclude_list[] = 'jquery-migrate';

		return $exclude_list;
	}

	public static function sgo_javascript_combine_exclude_move_after( $exclude_list ) {

		if (is_array($exclude_list)) {
			$exclude_list = array_unique(array_merge($exclude_list, self::get_pmw_script_identifiers()));
		}

		return $exclude_list;
	}

	public static function add_wp_rocket_exclusions( $exclusions ) {
		if (is_array($exclusions)) {
			$exclusions = array_unique(array_merge($exclusions, self::get_pmw_script_identifiers()));
		}

		return $exclusions;
	}


// works for WP Rocket >= 3.9
	public static function exclude_inline_scripts_from_wp_rocket_using_options() {
		$options = get_option('wp_rocket_settings');

		// if no options array could be retrieved.
		if (!is_array($options)) {
			return;
		}

		$update_options = false;

		$js_to_exclude = self::get_pmw_script_identifiers();

		foreach ($js_to_exclude as $string) {

			// add exclusions for inline js
//            if (array_key_exists('exclude_inline_js', $options) && is_array($options['exclude_inline_js']) && !in_array($string, $options['exclude_inline_js'])) {
//
//                array_push($options['exclude_inline_js'], $string);
//                $update_options = true;
//            }

			// add exclusions for js
//            if (array_key_exists('exclude_js', $options) && is_array($options['exclude_js']) && !in_array($string, $options['exclude_js'])) {
//
//                array_push($options['exclude_js'], $string);
//                $update_options = true;
//            }

			// remove scripts from delay_js_scripts
			if (array_key_exists('delay_js_scripts', $options) && is_array($options['delay_js_scripts']) && in_array($string, $options['delay_js_scripts'])) {

				unset($options['delay_js_scripts'][array_search($string, $options['delay_js_scripts'])]);
				$update_options = true;
			}

			// exclude_defer_js
//            if (array_key_exists('exclude_defer_js', $options) && is_array($options['exclude_defer_js']) && !in_array($string, $options['exclude_defer_js'])) {
//
//                array_push($options['exclude_defer_js'], $string);
//                $update_options = true;
//            }

			// exclude_delay_js
//            if (array_key_exists('delay_js_exclusions', $options) && is_array($options['delay_js_exclusions']) && !in_array($string, $options['delay_js_exclusions'])) {
//
//                array_push($options['delay_js_exclusions'], $string);
//                $update_options = true;
//            }
		}

		if (true === $update_options) {
			update_option('wp_rocket_settings', $options);
		}
	}

	public static function third_party_plugin_tweaks() {

		/**
		 * WooCommerce Google Ads Dynamic Remarketing
		 */

		self::disable_woocommerce_google_ads_dynamic_remarketing();

		/**
		 * SiteGround Optimizer
		 */

		if (self::is_sg_optimizer_active()) {

			/**
			 * The function wpmFunctionExists needs to be excluded from combination from SGO.
			 * Otherwise, it won't work on pages which include WPM shortcodes.
			 * */

			add_filter('sgo_javascript_combine_excluded_inline_content', function ( $excluded_scripts ) {
				$excluded_scripts[] = 'wpmFunctionExists';
				return $excluded_scripts;
			});

			/**
			 * SGO's defer feature doesn't queue jQuery correctly on some pages,
			 * leading to errors "jQuery not defined" errors on several pages
			 * and thus breaking tracking in those cases.
			 *
			 * Therefore, we need to exclude jquery-core from deferring.
			 * */

			add_filter('sgo_js_async_exclude', function ( $excludes ) {
				$excludes[] = 'jquery-core';
				return $excludes;
			});
		}

		/**
		 * Litespeed
		 */

		if (self::is_litespeed_active()) {
			add_filter('litespeed_optimize_js_excludes', function ( $excludes ) {
				if (is_array($excludes)) {
					$excludes[] = 'wpmFunctionExists';
				}

				return $excludes;
			});

			do_action('litespeed_nonce', 'ajax-nonce');
			do_action('litespeed_nonce', 'wp_rest');
			do_action('litespeed_nonce', 'nonce-pmw-ajax');
		}

		/**
		 * WooFunnels
		 */

		if (self::is_woofunnels_active()) {
			// We need to check so early that is_admin() is not working yet
			$_server = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			// Only run if REQUEST_URI is available and only if we are not on the WooFunnels settings page
			if (isset($_server['REQUEST_URI']) && strpos($_server['REQUEST_URI'], 'woofunnels-admin') === false) {
				self::disable_woofunnels_features();
			}
		}

		/**
		 * Woo Product Feed
		 */

		if (self::is_woo_product_feed_active()) {
			// We need to check so early that is_admin() is not working yet
			$_server = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			// Only run if REQUEST_URI is available and only if we are not on the Woo Product Feed settings page
			if (
				isset($_server['REQUEST_URI']) &&
				(
					strpos($_server['REQUEST_URI'], 'woosea_manage_settings') === false &&
					strpos($_server['REQUEST_URI'], 'woosea_elite_manage_settings') === false
				)
			) {
				self::disable_woo_product_feed_features();
			}
		}

		/**
		 * Google Listing and Ads
		 *
		 * Disable gtag if Google Ads is active in PMW
		 */

		if (self::is_pmw_google_ads_active()) {
			add_filter('woocommerce_gla_disable_gtag_tracking', '__return_true');
		}

		/**
		 * Facebook for WooCommerce
		 */

		if (self::is_pmw_facebook_active()) {
			add_filter('facebook_for_woocommerce_integration_pixel_enabled', '__return_false');
		}

		/**
		 * Pinterest for WooCommerce
		 */

		if (self::is_pmw_pinterest_active()) {
			add_filter('woocommerce_pinterest_disable_tracking', '__return_true');
		}

		/**
		 * Disable the WooCommerce Google Analytics Integration if Google Analytics is active in PMW
		 *
		 * The WooCommerce Google Analytics Integration now is updated to use gtag.js for GA4. If PMW users want to use PMW for GA3 and the WooCommerce Google Analytics Integration for GA4 then we can't disable the WooCommerce Google Analytics Integration.
		 *
		 * We only disable the WooCommerce Google Analytics Integration if both, GA3 and GA4 are active in PMW.
		 */

		if (Options::are_ga3_and_ga4_enabled()) {
			add_filter('woocommerce_ga_disable_tracking', '__return_true');
		}

		/**
		 * Disable WP Rocket lazy load for the PMW lazy load script
		 */

		if (self::is_wp_rocket_active() && Options::is_lazy_load_pmw_active()) {

			add_filter('rocket_delay_js_exclusions', [__CLASS__, 'exclude_pmw_lazy_from_wp_rocket']);
			add_filter('rocket_defer_inline_exclusions', [__CLASS__, 'exclude_pmw_lazy_from_wp_rocket']);
			add_filter('rocket_exclude_defer_js', [__CLASS__, 'exclude_pmw_lazy_from_wp_rocket']);
			add_filter('rocket_exclude_js', [__CLASS__, 'exclude_pmw_lazy_from_wp_rocket']);
			add_filter('rocket_minify_excluded_external_js', [__CLASS__, 'exclude_pmw_lazy_from_wp_rocket']);
			add_filter('rocket_excluded_inline_js_content', [__CLASS__, 'exclude_pmw_lazy_from_wp_rocket']);
		}
	}

	public static function exclude_pmw_lazy_from_wp_rocket( $excluded_attributes ) {
		$excluded_attributes[] = 'pmw-lazy__premium_only';
		$excluded_attributes[] = 'wpmDataLayer';
		return $excluded_attributes;
	}

	private static function disable_woocommerce_google_ads_dynamic_remarketing() {

		if (self::is_pmw_google_ads_dynamic_remarketing_active()) {
			// make sure to disable the WGDR plugin in case we use dynamic remarketing in this plugin
			add_filter('wgdr_third_party_cookie_prevention', '__return_true');
		}
	}

	private static function disable_woofunnels_features() {

		add_filter('option_bwf_gen_config', function ( $options ) {

			// Disable Facebook events output
			if (self::is_pmw_facebook_active()) {
				$options['fb_pixel_key'] = '';
			}

			// Disable Google Analytics events output
			if (self::is_pmw_google_analytics_active()) {
				$options['ga_key'] = '';
			}

			// Disable Google Ads events output
			if (self::is_pmw_google_ads_active()) {
				$options['gad_key'] = '';
			}

			// Disable Pinterest events output
			if (self::is_pmw_pinterest_active()) {
				$options['pint_key'] = '';
			}

			// Disable TikTok events output
			if (self::is_pmw_tiktok_active()) {
				$options['tiktok_pixel'] = '';
			}

			// Disable Snapchat events output
			if (self::is_pmw_snapchat_active()) {
				$options['snapchat_pixel'] = '';
			}

			return $options;
		});
	}

	private static function disable_woo_product_feed_features() {

		// Disable Facebook events output
		if (self::is_pmw_facebook_active()) {
			add_filter('option_add_facebook_pixel', function () {
				return 'no';
			});

			add_filter('option_add_facebook_capi', function () {
				return 'no';
			});
		}

		// Disable Google Ads events output
		if (self::is_pmw_google_ads_active()) {
			add_filter('option_add_remarketing', function () {
				return 'no';
			});
		}
	}

	public static function is_pmw_tiktok_active() {
		return Options::get_options_obj()->tiktok->pixel_id;
	}

	public static function is_pmw_google_ads_active() {
		return Options::get_options_obj()->google->ads->conversion_id;
	}

	public static function is_pmw_google_analytics_active() {
		return Options::get_options_obj()->google->analytics->universal->property_id || Options::get_options_obj()->google->analytics->ga4->measurement_id;
	}

	public static function is_pmw_snapchat_active() {
		return Options::get_options_obj()->snapchat->pixel_id;
	}

	public static function is_pmw_pinterest_active() {
		return Options::get_options_obj()->pinterest->pixel_id;
	}

	public static function is_pmw_facebook_active() {
		return Options::get_options_obj()->facebook->pixel_id;
	}

	public static function is_pmw_google_ads_dynamic_remarketing_active() {
		return !empty(Options::get_options_obj()->google->ads->dynamic_remarketing);
	}

	public static function enable_compatibility_mode() {

		self::compatibility_mode_yoast_seo();

		self::compatibility_mode_prevent_third_party_js_optimization();
	}

	protected static function compatibility_mode_prevent_third_party_js_optimization() {

		if (self::is_wp_rocket_active()) {
			self::disable_wp_rocket_js_optimization();
		}

		if (self::is_flying_press_active()) {
			self::disable_flying_press_js_optimization();
		}

		if (self::is_optimocha_active()) {
			self::disable_optimocha_js_optimization();
		}

		if (self::is_wp_optimize_active()) {
			self::disable_wp_optimize_js_optimization();
		}

		if (self::is_async_javascript_active()) {
			self::disable_async_javascript_js_optimization();
		}

		if (self::is_sg_optimizer_active()) {
			self::disable_sg_optimizer_js_optimization();
		}

		if (self::is_litespeed_active()) {
			self::disable_litespeed_js_optimization();
		}

		if (self::is_autoptimize_active()) {
			self::disable_autoptimze_js_optimization();
		}
	}

	protected static function disable_sg_optimizer_js_optimization() {

		add_filter('sgo_javascript_combine_excluded_inline_content', [__CLASS__, 'sg_optimizer_js_exclude_combine_inline_content']);
		add_filter('sgo_javascript_combine_exclude', [__CLASS__, 'sgo_javascript_combine_exclude_move_after']);
		add_filter('sgo_javascript_combine_exclude_move_after', [__CLASS__, 'sgo_javascript_combine_exclude_move_after']);
		add_filter('sgo_js_minify_exclude', [__CLASS__, 'sg_optimizer_js_minify_exclude']);
		add_filter('sgo_js_async_exclude', [__CLASS__, 'sgo_javascript_combine_exclude_move_after']);
	}

	protected static function disable_litespeed_js_optimization() {
		add_filter('litespeed_optimize_js_excludes', [__CLASS__, 'litespeed_optimize_js_excludes']);
		add_filter('litespeed_optm_js_defer_exc', [__CLASS__, 'litespeed_cache_js_defer_exc']);
		add_filter('litespeed_optm_cssjs', [__CLASS__, 'litespeed_optm_cssjs']);
		add_filter('option_litespeed.conf.optm-js_inline_defer', [__CLASS__, 'disable_litespeed_js_inline_after_dom']);
	}

	protected static function disable_autoptimze_js_optimization() {
		add_filter('autoptimize_filter_js_consider_minified', [__CLASS__, 'autoptimize_filter_js_consider_minified']);
		add_filter('autoptimize_filter_js_dontmove', [__CLASS__, 'autoptimize_filter_js_dontmove']);
	}

	protected static function disable_wp_optimize_js_optimization() {
		// add_filter('wpo_minify_inline_js', '__return_false');
		add_filter('wp-optimize-minify-default-exclusions', [__CLASS__, 'wp_optimize_minify_default_exclusions']);
	}

	protected static function disable_async_javascript_js_optimization() {
		add_filter('option_aj_plugin_exclusions', function ( $options ) {

			if (!is_array($options)) {
				$options = [];
			}

			return array_unique(array_merge($options, [
				'woocommerce-google-adwords-conversion-tracking-tag',
				'woopt-pixel-manager-pro',
				'woocommerce-pixel-manager',
				'woocommerce-pixel-manager-pro',
			]));
		});
	}

	protected static function disable_optimocha_js_optimization() {
		add_filter('option_sbp_options', function ( $options ) {

			if (isset($options['js_exclude'])) {
				$options['js_exclude'] = $options['js_exclude'] . PHP_EOL . implode(PHP_EOL, self::get_pmw_script_identifiers());
				$js_include            = explode(PHP_EOL, $options['js_include']);
				$js_include            = array_filter($js_include, function ( $string ) {
					foreach (self::get_pmw_script_identifiers() as $value) {
						if (strpos($string, $value) !== false) {
							return false;
						}
					}

					return true;
				});
				$options['js_include'] = implode(PHP_EOL, $js_include);
			}

			return $options;
		});
	}

	protected static function disable_flying_press_js_optimization() {
		add_filter('pre_update_option_FLYING_PRESS_CONFIG', function ( $options ) {

			if (isset($options['js_defer_excludes'])) {
				$options['js_defer_excludes'] = array_unique(array_merge($options['js_defer_excludes'], self::get_pmw_script_identifiers()));
			}

			return $options;
		});

		add_filter('option_FLYING_PRESS_CONFIG', function ( $options ) {

			if (isset($options['js_defer_excludes'])) {
				$options['js_defer_excludes'] = array_unique(array_merge($options['js_defer_excludes'], self::get_pmw_script_identifiers()));
			}
			return $options;
		});

		// 		Make sure to never delay JS until interaction
//		if (self::is_flying_press_active()) {
//			add_filter('option_FLYING_PRESS_CONFIG', function ( $options ) {
//				if (isset($options['js_interaction'])) {
//					$options['js_interaction'] = false;
//				}
//				return $options;
//			});
//		}
	}

	protected static function disable_wp_rocket_js_optimization() {
		// for testing you need to clear the WP Rocket cache, only then the filters run
		self::exclude_inline_scripts_from_wp_rocket_using_options();
		add_filter('rocket_delay_js_exclusions', [__CLASS__, 'add_wp_rocket_exclusions']);
		add_filter('rocket_defer_inline_exclusions', [__CLASS__, 'add_wp_rocket_exclusions']);
		add_filter('rocket_exclude_defer_js', [__CLASS__, 'add_wp_rocket_exclusions']);
		add_filter('rocket_exclude_js', [__CLASS__, 'add_wp_rocket_exclusions']);
		add_filter('rocket_minify_excluded_external_js', [__CLASS__, 'add_wp_rocket_exclusions']);
		add_filter('rocket_excluded_inline_js_content', [__CLASS__, 'add_wp_rocket_exclusions']);
	}

	public static function compatibility_mode_yoast_seo() {
		if (self::is_yoast_seo_active() && isset(Options::get_options_obj()->facebook->microdata) && Options::get_options_obj()->facebook->microdata) {
			add_filter('option_wpseo_social', [__CLASS__, 'disable_yoast_seo_facebook_social']);
		}
	}

	private static function get_pmw_script_identifiers() {
		return [
			'optimize.js',
			'googleoptimize.com/optimize.js',
			'jquery',
			'jQuery',
			'jQuery.min.js',
			'jquery.js',
			'jquery.min.js',
			'wpm',
			'wpm-js',
			'wpmDataLayer',
			'window.wpmDataLayer',
			'wpm.js',
			'wpm.min.js',
			'wpm__premium_only.js',
			'wpm__premium_only.min.js',
			'wpm-public.p1.min.js',
			'wpm-public__premium_only.p1.min.js',
			'polyfill-io',
			'polyfill.min.js',
			//            'facebook.js',
			//            'facebook.min.js',
			//            'facebook__premium_only.js',
			//            'facebook__premium_only.min.js',
			//            'google-ads.js',
			//            'google-ads.min.js',
			//            'google-ga-4-eec__premium_only.js',
			//            'google-ga-4-eec__premium_only.min.js',
			//            'google-ga-us-eec__premium_only.js',
			//            'google-ga-us-eec__premium_only.min.js',
			//            'google__premium_only.js',
			//            'google__premium_only.min.js',
			'window.dataLayer',
			//            '/gtag/js',
			'gtag',
			//            '/gtag/js',
			//            'gtag(',
			'gtm.js',
			//            '/gtm-',
			//            'GTM-',
			//            'fbq(',
			'fbq',
			'fbevents.js',
			//            'twq(',
			'twq',
			//            'e.twq',
			'static.ads-twitter.com/uwt.js',
			'platform.twitter.com/widgets.js',
			'uetq',
			'ttq',
			'events.js',
			'snaptr',
			'scevent.min.js',
		];
	}

	public static function is_curl_active() {
		return function_exists('curl_version');
	}


	/**
	 * Check if the URL redirects
	 *
	 * @param $url
	 * @return bool
	 */
	public static function does_url_redirect( $url ) {

		// Get the response from the URL and don't follow redirects
		$response = wp_remote_get($url, [
			'timeout'     => 4,
			'sslverify'   => false,
			'redirection' => 0,
		]);

		// If $repsonse is an error, then return false
		if (is_wp_error($response)) {
			return false;
		}

		$response_code = wp_remote_retrieve_response_code($response);

		// If $response_code is a redirect code (3xx), then it's a redirect and return true, otherwise return false
		return ( $response_code >= 300 && $response_code < 400 );
	}

	// https://stackoverflow.com/questions/8429342/php-get-headers-set-temporary-stream-context
	protected static function get_headers_with_stream_context( $url, $context, $assoc = 0 ) {

		$fp = @fopen($url, 'r', null, $context);

		if (!is_bool($fp)) {

			$metaData = stream_get_meta_data($fp);
			fclose($fp);

			$headerLines = $metaData['wrapper_data'];

			if (!$assoc) {
				return $headerLines;
			}

			$headers = [];
			foreach ($headerLines as $line) {
				if (strpos($line, 'HTTP') === 0) {
					$headers[0] = $line;
					continue;
				}

				list($key, $value) = explode(': ', $line);
				$headers[$key] = $value;
			}

			return $headers;
		} else {
			return [];
		}
	}

// https://github.com/woocommerce/woocommerce/wiki/wc_get_orders-and-WC_Order_Query#usage
	public static function get_last_order_id() {

		$orders = wc_get_orders([
			'limit'     => 1,
			'orderby'   => 'date',
			'order'     => 'DESC',
			'return'    => 'ids',
			'post_type' => 'shop_order'
		]);

//		error_log(reset($orders));

		return reset($orders);
	}

	public static function get_last_order_url() {
		$last_order_id = self::get_last_order_id();
		$last_order    = wc_get_order($last_order_id);

		if ($last_order) {
			return $last_order->get_checkout_order_received_url();
		} else {
			return '';
		}
	}

	public static function does_one_order_exist() {
		if (self::get_last_order_id()) {
			return true;
		} else {
			return false;
		}
	}

	public static function get_wp_memory_limit() {

		$memory = wc_let_to_num(WP_MEMORY_LIMIT);

		if (function_exists('memory_get_usage')) {
			$system_memory = wc_let_to_num(@ini_get('memory_limit'));
			$memory        = max($memory, $system_memory);
		}

		return size_format($memory);
	}

	public static function is_wp_memory_limit_set() {

		if (WP_MEMORY_LIMIT) {
			return true;
		} else {
			return false;
		}
	}

	public static function is_below_memory_limit( $memory_limit ) {

		$memory_limit = wc_let_to_num($memory_limit);

		$actual_memory_limit = wc_let_to_num(WP_MEMORY_LIMIT);
	}

	public static function is_memory_limit_higher_than( $memory_limit ) {

		$memory_limit = wc_let_to_num($memory_limit);

		$actual_memory_limit = wc_let_to_num(WP_MEMORY_LIMIT);

		if ($actual_memory_limit > $memory_limit) {
			return true;
		} else {
			return false;
		}
	}
}

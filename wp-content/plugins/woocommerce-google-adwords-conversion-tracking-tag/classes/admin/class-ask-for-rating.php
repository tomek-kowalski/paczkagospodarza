<?php

namespace WCPM\Classes\Admin;

use WCPM\Classes\Helpers;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

class Ask_For_Rating {

	private $option_name = PMW_DB_RATINGS;

	private static $instance;

	public static function get_instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {

//	    $options = get_option($this->option_name);
//	    $options['conversions_count'] = 8;
//	    $options['rating_threshold'] = 10;
//	    unset($options['conversion_count']);
//	    $options['rating_done'] = false;
//	    update_option($this->option_name,$options);

		// ask for a rating in a plugin notice
		add_action('admin_enqueue_scripts', [$this, 'wpm_rating_script']);
		add_action('wp_ajax_wpm_dismissed_notice_handler', [$this, 'ajax_rating_notice_handler']);
		add_action('admin_notices', [$this, 'ask_for_rating_notice']);
	}

	public function wpm_rating_script() {
		wp_enqueue_script(
			'wpm-ask-for-rating',
			PMW_PLUGIN_DIR_PATH . 'js/admin/ask-for-rating.js',
			['jquery'],
			PMW_CURRENT_VERSION,
			true
		);

		wp_localize_script(
			'wpm-ask-for-rating',
			'ajax_var', [
			'url'   => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		]);
	}

	// server side php ajax handler for the admin rating notice
	public function ajax_rating_notice_handler() {

		if (!current_user_can('manage_options')) {
			wp_die();
		}

		$_post = Helpers::get_input_vars(INPUT_POST);

		// Verify nonce
		if (!isset($_post['nonce']) || !wp_verify_nonce($_post['nonce'], 'ajax-nonce')) {
			wp_die();
		}

		$set = $_post['set'];

		$options = get_option($this->option_name);

		if ('rating_done' === $set) {

			$options['rating_done'] = true;
			update_option($this->option_name, $options);

		} elseif ('later' === $set) {

			$options['rating_threshold'] = $this->get_next_threshold($options['conversions_count']);
			update_option($this->option_name, $options);
		}

		wp_die(); // this is required to terminate immediately and return a proper response
	}

	private function show_admin_notifications() {

		$show_admin_notifications = apply_filters_deprecated('wooptpm_show_admin_notifications', [true], '1.13.0', 'pmw_show_admin_notifications');
		$show_admin_notifications = apply_filters_deprecated('wpm_show_admin_notifications', [$show_admin_notifications], '1.31.2', 'pmw_show_admin_notifications');

		// Allow users to disable admin notifications for the plugin
		return apply_filters('pmw_show_admin_notifications', $show_admin_notifications);
	}

	public function ask_for_rating_notice() {

		if (current_user_can('administrator') && $this->show_admin_notifications()) {

			$wpm_ratings = get_option($this->option_name);

			if (isset($wpm_ratings['conversions_count'])) {

				$conversions_count = $wpm_ratings['conversions_count'];

				// in rare cases this option has not been set
				// in those cases we set it to avoid further errors
				if (!isset($wpm_ratings['rating_done'])) {
					$wpm_ratings['rating_done'] = false;
					update_option($this->option_name, $wpm_ratings);
				}

				// in rare cases this option has not been set
				// in those cases we set it to avoid further errors
				if (!isset($wpm_ratings['rating_threshold'])) {
//					$wpm_ratings['rating_threshold'] = 10;
					$wpm_ratings['rating_threshold'] = 2;
					update_option($this->option_name, $wpm_ratings);
				}

				// If $wpm_ratings['rating_done'] is true, return
				if (true === $wpm_ratings['rating_done']) {
					return;
				}

				if (
					( $conversions_count > $wpm_ratings['rating_threshold'] )
					|| ( defined('WPM_ALWAYS_AKS_FOR_RATING') && true === WPM_ALWAYS_AKS_FOR_RATING )
				) {
					$this->ask_for_rating_notices($conversions_count);
				}
			} else {

				// set default settings for wpm_ratings
				update_option($this->option_name, $this->get_default_settings());
			}
		}
	}

	private function get_next_threshold( $conversions_count ) {
		return $conversions_count * 10;
	}

	private function get_default_settings() {
		return [
			'conversions_count' => 1,
			'rating_threshold'  => 10,
			'rating_done'       => false,
		];
	}

	// show an admin notice to ask for a plugin rating
	public function ask_for_rating_notices( $conversions_count ) {
		?>
		<div class="notice notice-success wpm-rating-success-notice" style="display: none">
			<div style="color:#02830b; margin-top:10px">

				<span>
						<?php
						printf(
						/* translators: %d: the amount of purchase conversions that have been measured */
							esc_html__('Hey, I noticed that you tracked more than %d purchase conversions with the Pixel Manager for WooCommerce plugin - that\'s awesome! Could you please do me a BIG favour and give it a 5-star rating on WordPress? It will help to spread the word and boost our motivation.', 'woocommerce-google-adwords-conversion-tracking-tag'),
							esc_html__($conversions_count)
						);
						?>

				</span>
				<br>
				<div style="margin-top:5px;">

					<span>- Aleksandar (Lead developer)</span>
				</div>
			</div>
			<div style="">

				<ul style="list-style-type: disc ;padding-left:20px;">
					<li>
						<a id="wpm-rate-it" href="#" style="font-weight: bold;">
							<?php esc_html_e('Ok, you deserve it', 'woocommerce-google-adwords-conversion-tracking-tag'); ?>
						</a>
					</li>
					<li>
						<a id="wpm-maybe-later" href="#">
							<?php esc_html_e('Nope, maybe later', 'woocommerce-google-adwords-conversion-tracking-tag'); ?>
						</a>
					</li>
					<li>

						<div style=" margin-bottom: 10px; display: flex; justify-content: space-between">
							<div style="white-space:normal;">
								<a id="wpm-already-did" href="#">
									<?php esc_html_e('I already did', 'woocommerce-google-adwords-conversion-tracking-tag'); ?>
								</a>
							</div>
							<div
								style="white-space:normal; bottom:0; right: 0; margin-bottom: 0; margin-right: 5px;align-self: flex-end;">
								<a href="<?php echo esc_url(( new Documentation() )->get_link('the_dismiss_button_doesnt_work_why')); ?>"
								   target="_blank">
									<?php esc_html_e('If the dismiss button is not working, here\'s why >>', 'woocommerce-google-adwords-conversion-tracking-tag'); ?>
								</a>
							</div>
						</div>
					</li>
				</ul>
			</div>

		</div>
		<?php
	}
}

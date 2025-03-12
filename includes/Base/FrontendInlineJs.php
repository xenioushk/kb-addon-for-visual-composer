<?php

namespace KAFWPB\Base;

/**
 * Class for plucin frontend inline js.
 *
 * @package KAFWPB
 * @since: 1.1.0
 * @auther: Mahbub Alam Khan
 */
class FrontendInlineJs {


	/**
	 * Register the methods.
	 */
	public function register() {
		add_action( 'wp_head', [ $this, 'set_inline_js' ] );
	}

	/**
	 * Set the inline js.
	 */
	public function set_inline_js() {
		ob_start();
		?>
<style type="text/css">
.bkb-counter-container {
    margin: 48px 0;
}

.bkb_counter_icon {
    font-size: 54px;
}

.bkb_counter_value {
    font-size: 32px;
    line-height: 24px;
    display: block;
    margin: 12px 0 0 0;
    font-weight: bold;
}

.bkb_counter_title {
    font-size: 14px;
    line-height: 48px;
    text-transform: uppercase;
}
</style>


		<?php
		echo ob_get_clean(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

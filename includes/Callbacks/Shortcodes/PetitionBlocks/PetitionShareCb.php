<?php
namespace KAFWPB\Callbacks\Shortcodes\PetitionBlocks;

/**
 * Petition Share Layout
 *
 * @since: 1.0.0
 * @author: Mahbub Alam Khan
 * @package BwlPetitionsManager
 */
class PetitionShareCb {

	public $socialButtons;
	public $postTitle;
	public $postUrl;

	public function getTheLayout( $atts ) {

		$atts = shortcode_atts([
			'id'                  => '',
			'small_icon'          => 1,
			'hide_title'          => 0,
			'share_title'         => esc_html__( 'Share it', 'bwl_ptmn' ),
			'title_tag'           => 'h2',
			'title_align'         => 'center',
			'title_tag_color'     => '#2C2C2C',
			'share_sub_title'     => esc_html__( 'We will appreciate your support.', 'bwl_ptmn' ),
			'sub_title_tag'       => 'h3',
			'sub_title_align'     => 'center',
			'sub_title_tag_color' => '#DD4F43',
			'bptm_extra_class'    => '',
		], $atts);

		extract( $atts );

		// If there is no Id, shortcode returns empty string.
		if ( $id == '' ) {
			// Now we will try to get the ID of the post from global variable.
			global $post;
			if ( ! empty( $post->ID ) ) {
				$id = $post->ID;
			} else {
				return '';
			}
		}

		$this->postTitle     = str_replace( ' ', '+', get_the_title( $id ) );
		$this->postUrl       = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$this->socialButtons = $this->setTheSocialButtons();

		$petition_share_btn_html = "<div class='petition-share'>{$this->getTheSocialButtons()}</div>";

		// Initialize heading & sub heading string.

		$title_string = '';

		if ( $hide_title == 0 ) {

			$bwl_ptmn_share_title     = trim( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'share_title', true ) );
			$bwl_ptmn_share_sub_title = trim( get_post_meta( $id, BWL_PETITIONS_CMB_PREFIX . 'share_sub_title', true ) );

			$share_title     = ( $bwl_ptmn_share_title == '' ) ? $share_title : $bwl_ptmn_share_title;
			$share_sub_title = ( $bwl_ptmn_share_sub_title == '' ) ? $share_sub_title : $bwl_ptmn_share_sub_title;

			// Generate Dyanmic Heading & Sub-heading Tag.
			$title_tag_style     = ' style="color:' . $title_tag_color . '; text-align:' . $title_align . ';"';
			$sub_title_tag_style = ' style="color:' . $sub_title_tag_color . '; text-align:' . $sub_title_align . ';"';

			// About content section.
			$title_string .= '<div class="col-sm-12 headline-container">';
			$title_string .= "<$title_tag {$title_tag_style} class='title'>$share_title</$title_tag>";
			$title_string .= "<$sub_title_tag {$sub_title_tag_style} class='sub-title'>$share_sub_title</$sub_title_tag>";
			$title_string .= '</div>';
		}

		// Added Extra Class Section For Custom Templating
		$bptm_extra_class = empty( $bptm_extra_class ) ? '' : " {$bptm_extra_class}";

		$output = "<div class='row petition-share{$bptm_extra_class}'>";

		// display heading & sub heading.
		$output .= $title_string;
		$output .= "<div class='col-sm-12 text-center'>$petition_share_btn_html</div>";

		$output .= '</div>';

		return $output;
	}

	/**
	 * Setup the social icons.
     *
	 * @since: 1.0
	 * @author: Mahbub Alam Khan
	 * @created: 01.06.2016
	 * @updated: 03.08.2024
	 */
	private function setTheSocialButtons() {
		return [
			'twitter' => [
				'link'  => "https://twitter.com/share?url={$this->postUrl}&text={$this->postTitle}",
				'title' => esc_attr( 'Tweet It', 'bwl_ptmn' ),
			],
			'facebook' => [
				'link'  => "http://www.facebook.com/sharer.php?u={$this->postUrl}",
				'title' => esc_attr( 'Share at Facebook', 'bwl_ptmn' ),
			],
			'pinterest' => [
				'link'  => "http://pinterest.com/pin/create/button/?url={$this->postUrl}",
				'title' => esc_attr( 'Share at Pinterest', 'bwl_ptmn' ),
			],
			'linkedin' => [
				'link'  => "http://www.linkedin.com/shareArticle?mini=true&url={$this->postUrl}",
				'title' => esc_attr( 'Share at LinkedIn', 'bwl_ptmn' ),
			],
			'tumblr' => [
				'link'  => "http://www.tumblr.com/share/link?url={$this->postUrl}&name={$this->postTitle}",
				'title' => esc_attr( 'Share at Tumblr', 'bwl_ptmn' ),
			],
			'envelope-o' => [
				'link'  => "mailto:?subject={$this->postTitle}&body={$this->postUrl}",
				'title' => esc_attr( 'Share via Email', 'bwl_ptmn' ),
			],
		];
	}

	/**
	 * Genereate the social buttons layout
     *
	 * @since: 1.0.0
	 * @author: Mahbub Alam Khan
	 * @created: 01.06.2016
	 * @updated: 03.08.2024
	 */
	private function getTheSocialButtons() {
		$btnLayout = '';

		if ( empty( $this->socialButtons ) ) { return $btnLayout;
		}

		foreach ( $this->socialButtons as $btnKey => $btnValue ) {
			$btnLayout .= "<a class='btn btn-social-icon btn-{$btnKey} petition_share' href='{$btnValue['link']}'title='{$btnValue['title']}'>
                                  <i class='fa fa-{$btnKey}'></i>
                            </a>";
		}

		return $btnLayout;
	}
}

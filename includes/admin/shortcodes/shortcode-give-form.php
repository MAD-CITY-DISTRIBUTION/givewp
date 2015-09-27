<?php
/**
 * The [give_form] Shortcode Generator class
 *
 * @package     Give
 * @subpackage  Admin
 * @copyright   Copyright (c) 2015, WordImpress
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

defined( 'ABSPATH' ) or exit;

class Give_Shortcode_Donation_Form extends Give_Shortcode_Generator {

	/**
	 * Class constructor
	 */
	public function __construct() {

		$this->shortcode['title']   = __( 'Donation Form', 'give' );
		$this->shortcode['label']   = __( 'Donation Form', 'give' );
		$this->shortcode['require'] = array( 'id' );
		$this->shortcode['alert']   = __( 'You must first select a Form!', 'give' );

		parent::__construct( 'give_form' );
	}

	/**
	 * Define the shortcode attribute fields
	 *
	 * @return array
	 */
	public function define_fields() {

		return array(
			array(
				'type'        => 'post',
				'query_args'  => array(
					'post_type' => 'give_forms',
				),
				'name'        => 'id',
				'tooltip'     => __( 'Select a Donation Form', 'give' ),
				'placeholder' => sprintf( '– %s –', __( 'Select a Form', 'give' ) ),
			),
			array(
				'type' => 'container',
				'html' => sprintf( '<p style="font-weight: 600 !important; margin-top: 1em;">%s</p>', __( 'Optional form settings', 'give' ) ),
			),
			array(
				'type'    => 'listbox',
				'name'    => 'show_title',
				'label'   => __( 'Show Title:', 'give' ),
				'tooltip' => __( 'Do you want to display the form title?', 'give' ),
				'options' => array(
					'true'  => __( 'Show', 'give' ),
					'false' => __( 'Hide', 'give' ),
				),
			),
			array(
				'type'    => 'listbox',
				'name'    => 'show_goal',
				'label'   => __( 'Show Goal:', 'give' ),
				'tooltip' => __( 'Do you want to display the donation goal?', 'give' ),
				'options' => array(
					'true'  => __( 'Show', 'give' ),
					'false' => __( 'Hide', 'give' ),
				),
			),
			array(
				'type'    => 'listbox',
				'name'    => 'show_content',
				'label'   => __( 'Display Content:', 'give' ),
				'tooltip' => __( 'Do you want to display the form content?', 'give' ),
				'options' => array(
					'true'  => __( 'Show', 'give' ),
					'false' => __( 'Hide', 'give' ),
				),
			),
			array(
				'type'    => 'listbox',
				'name'    => 'display_style',
				'label'   => __( 'Payment Fields:', 'give' ),
				'tooltip' => __( 'How would you like to display payment information?', 'give' ),
				'options' => array(
					'onpage' => __( 'Show on Page', 'give' ),
					'reveal' => __( 'Reveal Upon Click', 'give' ),
					'modal'  => __( 'Modal Window Upon Click', 'give' ),
				),
			),
			array(
				'type'    => 'listbox',
				'name'    => 'float_labels',
				'label'   => __( 'Floating Labels:', 'give' ),
				'tooltip' => __( 'Would you like to enable floating labels?', 'give' ),
				'options' => array(
					'enabled'  => __( 'Enabled', 'give' ),
					'disabled' => __( 'Disabled', 'give' ),
				),
			),
		);
	}
}

new Give_Shortcode_Donation_Form;

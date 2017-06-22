<?php

namespace Tribe\Project\Post_Meta;

use Tribe\Libs\ACF;

/**
 * Class Sample_Post_Meta
 * @package Tribe\Project\Post_Meta
 *
 * @author Chris Flannagan
 *
 * A sample class for creating post meta fields in square-one with Advanced Custom Fields
 */
class Sample_Post_Meta extends ACF\ACF_Meta_Group {

	/**
	 * Name your post meta group and keys
	 */
	const NAME = 'sample_post_meta';
	const META_KEYS = [
		'sample_text_field'  => self::NAME . '_sample_text_field',
		'sample_radio_field' => self::NAME . '_sample_radio_field',
	];

	/**
	 * Sample options for a selection type field
	 */
	const SAMPLE_OPTIONS = [ 0, 1, 2, 3, 4, 5 ];

	/**
	 * @return array
	 *
	 * Return all meta keys in this group of post meta
	 */
	public function get_keys(): array {
		return static::META_KEYS;
	}

	/**
	 * @param int $post_id
	 * @param string $key
	 *
	 * @return mixed
	 *
	 * Get the value of a post meta field.  This functions allows room for custom returns based on parameters.
	 */
	public function get_value( $post_id, $key ) {

		// isset faster than in_array
		if ( isset( static::META_KEYS[ $key ] ) ) {
			return get_field( static::META_KEYS[ $key ], $post_id );
		}

		return '';

	}

	/**
	 * @return array
	 *
	 * Create a new ACF Group to contain post meta fields
	 */
	public function get_group_config() {

		$group = new ACF\Group( static::NAME );

		$group->set( 'title', __( 'Sample Post Meta', 'tribe' ) );
		$group->set( 'position', 'normal' );
		$group->set_post_types( $this->post_types );

		/**
		 * Field parameter is the index of meta key for field in const META_KEYS
		 */
		$group->add_field( $this->get_text_field( 'sample_text_field' ) );
		$group->add_field( $this->get_radio_field( 'sample_radio_field' ) );

		return $group->get_attributes();

	}

	/**
	 * @param string $key_index
	 *
	 * @return ACF\Field
	 *
	 * Generate a text input post meta field
	 */
	private function get_text_field( string $key_index ) {

		$field = new ACF\Field( static::META_KEYS[ $key_index ] );

		$field->set_attributes( [
			'label'  => __( 'A Sample Text Field', 'tribe' ),
			'name'   => static::META_KEYS[ $key_index ],
			'type'   => 'text',
		] );

		return $field;

	}

	/**
	 * @param string $key_index
	 *
	 * @return ACF\Field
	 *
	 * Create a radio button post meta field
	 */
	private function get_radio_field( string $key_index ) {

		$field = new ACF\Field( static::META_KEYS[ $key_index ] );

		$field->set_attributes( [
			'label'   => __( 'A Sample Radio Field', 'tribe' ),
			'name'    => static::META_KEYS[ $key_index ],
			'type'    => 'radio',
			'layout'  => 'horizontal',
			'choices' => static::SAMPLE_OPTIONS,
		] );

		return $field;

	}

	public static function instance() {
		return tribe_project()->container()[ 'post_meta.' . static::NAME ];
	}
}
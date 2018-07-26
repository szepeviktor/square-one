<?php

namespace Tribe\Project\Components_Docs;

use Tribe\Project\Components_Docs\Templates\Preview_Wrapper;
use Tribe\Project\Templates\Components\Component;

class Component_Item extends Item {

	/**
	 * @var string $item_class
	 */
	protected $item_class;

	/**
	 * @var \ReflectionClass $reflection
	 */
	protected $reflection;

	public function __construct( string $item_class ) {
		if ( ! class_exists( $item_class ) ) {
			throw new \InvalidArgumentException( 'Provided component class does not exist.' );
		}

		$this->item_class = $item_class;
		$this->reflection = new \ReflectionClass( $item_class );
	}

	public function get_slug(): string {
		return strtolower( $this->reflection->getShortName() );
	}

	public function get_label(): string {
		$short_name = $this->reflection->getShortName();
		return ucwords( str_replace( '_', ' ', $short_name ) );
	}

	public function get_constants(): array {
		$constants = $this->reflection->getConstants();
		unset( $constants['TEMPLATE_NAME'] );

		/**
		 * @var Component $item
		 */
		$item     = $this->item_class::factory( [] );
		$defaults = $item->get_data();
		$items    = [];

		foreach ( $constants as $constant ) {
			$exists = isset( $defaults[ $constant ] );

			if ( ! $exists ) {
				$items[ $constant ] = '';
				continue;
			}

			$items[ $constant ] = $defaults[ $constant ];
		}

		return $items;
	}

	public function get_sales_docs(): string {
		$short_name = $this->reflection->getShortName();
		$path       = $this->get_home_path() . 'docs/sales/components';
		$docs_name  = sprintf( '%s/%s.md', $path, strtolower( $short_name ) );

		if ( ! file_exists( $docs_name ) ) {
			return '';
		}

		$contents  = file_get_contents( $docs_name );
		$parsedown = new Parsedown();
		$rendered  = $parsedown->text( $contents );

		return $rendered;
	}

	public function get_dev_docs(): string {
		$short_name = $this->reflection->getShortName();
		$path       = $this->get_home_path() . 'docs/theme/components';
		$docs_name  = sprintf( '%s/%s.md', $path, strtolower( $short_name ) );

		if ( ! file_exists( $docs_name ) ) {
			return '';
		}

		$contents  = file_get_contents( $docs_name );
		$parsedown = new Parsedown();
		$rendered  = $parsedown->text( $contents );

		return $rendered;
	}

	public function get_twig_src(): string {
		$twig_template = sprintf( '%s/%s', get_template_directory(), $this->item_class::TEMPLATE_NAME );

		if ( ! file_exists( $twig_template ) ) {
			return '';
		}

		return file_get_contents( $twig_template );
	}

	public function get_rendered_template( $options = [] ): string {
		/**
		 * @var Component $template
		 */
		$template = $this->item_class::factory( $options );
		$rendered = $template->render();

		$wrapper_options = [
			Preview_Wrapper::RENDERED => $this->cleanup_html( $rendered ),
		];

		$wrapper = Preview_Wrapper::factory( $wrapper_options );

		return $wrapper->render();
	}

	public function get_class_name(): string {
		return $this->item_class;
	}
}
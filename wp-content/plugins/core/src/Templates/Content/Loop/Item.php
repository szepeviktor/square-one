<?php

namespace Tribe\Project\Templates\Content\Loop;

use Tribe\Project\Post_Meta\Primary_Category;
use Tribe\Project\Post_Types\Article\Article;
use Tribe\Project\Taxonomies\Category\Category;
use Tribe\Project\Twig\Twig_Template;
use Tribe\Project\Theme\Image_Sizes;
use Tribe\Libs\Post_Type\Post_Object;
use Tribe\Project\Twig\Stringable_Callable;

class Item extends Twig_Template {
	protected $time_formats = [
		'c',
		'F j, Y',
	];

	public function get_data(): array {
		$data[ 'post' ] = [
			'post_type'      => get_post_type(),
			'title'          => get_the_title(),
			'content'        => new Stringable_Callable( [ $this, 'defer_get_content' ] ),
			'excerpt'        => apply_filters( 'the_excerpt', get_the_excerpt() ),
			'permalink'      => get_the_permalink(),
			'featured_image' => $this->get_featured_image(),
			'time'           => $this->get_time(),
			'author'         => $this->get_author(),
		];

		return $data;
	}

	public function defer_get_content() {
		return apply_filters( 'the_content', get_the_content() );
	}

	protected function get_featured_image() {
		$options = [
			'as_bg'         => true,
			'echo'          => false,
			'wrapper_class' => 'item__image',
			'shim'          => trailingslashit( get_stylesheet_directory_uri() ) . 'img/theme/shims/16x9.png',
			'src_size'      => Image_Sizes::CORE_FULL,
			'srcset_sizes'  => [
				Image_Sizes::CORE_FULL,
				Image_Sizes::CORE_MOBILE,
				Image_Sizes::SOCIAL_SHARE,
			],
		];

		return the_tribe_image( get_post_thumbnail_id(), $options );
	}

	protected function get_time() {
		$times = [];
		foreach ( $this->time_formats as $format ) {
			$times[ $format ] = get_the_time( $format );
		}

		return $times;
	}

	protected function get_author() {
		return [
			'name' => get_the_author(),
			'url'  => get_author_posts_url( get_the_author_meta( 'ID' ) ),
		];
	}
}

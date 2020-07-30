<?php

namespace jeyofdev\wp\yoga\ahana\walker;

use \Walker;



/**
 * Core walker class to output an unordered list of taxonomy radio input elements.
 *
 * @see Walker
 * @see wp_category_checklist()
 * @see wp_terms_checklist()
 */
class TaxonomyRadioChecklistWalker extends Walker {
	public $db_fields = array(
		'parent' => 'parent',
		'id'     => 'term_id',
	);

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker:start_lvl()
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Depth of taxonomy. Used for tab indentation.
	 * @param array  $args   An array of arguments. @see wp_terms_checklist()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent<ul class='children'>\n";
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param int    $depth  Depth of taxonomy. Used for tab indentation.
	 * @param array  $args   An array of arguments. @see wp_terms_checklist()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string $output   Used to append additional content (passed by reference).
	 * @param object $term     The current term object.
	 * @param int    $depth    Depth of the term in reference to parents. Default 0.
	 * @param array  $args     An array of arguments. @see wp_terms_checklist()
	 * @param int    $id       ID of the current term.
	 */
	public function start_el( &$output, $term, $depth = 0, $args = array(), $id = 0 ) {
        if ( empty( $args['taxonomy'] ) ) {
			$taxonomy = $term->taxonomy;
		} else {
			$taxonomy = $args['taxonomy'];
		}

		$name = 'tax_input[' . $taxonomy . ']';

		$args['popular_cats'] = empty( $args['popular_cats'] ) ? array() : $args['popular_cats'];
		$class                = in_array( $term->term_id, $args['popular_cats'] ) ? ' class="popular-category"' : '';

		$args['selected_cats'] = empty( $args['selected_cats'] ) ? array() : $args['selected_cats'];

		if ( ! empty( $args['list_only'] ) ) {
			$aria_checked = 'false';
			$inner_class  = $term->slug;

			if ( in_array( $term->term_id, $args['selected_cats'] ) ) {
				$inner_class .= ' selected';
				$aria_checked = 'true';
			}

			$output .= "\n" . '<li' . $class . '>' .
				'<div class="' . $inner_class . '" data-term-id=' . $term->term_id .
				' tabindex="0" role="radio" aria-checked="' . $aria_checked . '">' .
				/** This filter is documented in wp-includes/category-template.php */
				esc_html( apply_filters( 'the_category', $term->name, '', '' ) ) . '</div>';
		} else {
			$output .= "\n<li id='{$taxonomy}-{$term->term_id}'$class>" .
				'<label class="selectit"><input value="' . $term->term_id . '" type="radio" name="' . $name . '[]" id="in-' . $taxonomy . '-' . $term->term_id . '"' .
				checked( in_array( $term->term_id, $args['selected_cats'] ), true, false ) .
				disabled( empty( $args['disabled'] ), false, false ) . ' /> ' .
				/** This filter is documented in wp-includes/category-template.php */
				esc_html( apply_filters( 'the_category', $term->name, '', '' ) ) . '</label>';
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @param string $output   Used to append additional content (passed by reference).
	 * @param object $term     The current term object.
	 * @param int    $depth    Depth of the term in reference to parents. Default 0.
	 * @param array  $args     An array of arguments. @see wp_terms_checklist()
	 */
	public function end_el( &$output, $term, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
}

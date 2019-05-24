<?php
/*
Plugin Name: TablePress Extension: Pagination Length Change "All" entry
Plugin URI: https://tablepress.org/extensions/length-change-all-entry/
Description: Custom Extension for TablePress to add a Pagination Length Change "All" entry
Version: 1.2
Author: Tobias Bäthge
Author URI: https://tobias.baethge.com/
*/

add_filter( 'tablepress_datatables_parameters', 'tablepress_pagination_length_change_all_entry', 10, 4 );

/**
 * Add an "All" entry to the Length Change menu, while taking into account the desired number of entries.
 *
 * @since 1.0.0
 *
 * @param array  $parameters DataTables parameters.
 * @param string $table_id   Table ID.
 * @param string $html_id    HTML ID of the table.
 * @param array  $js_options JS options for DataTables.
 * @return array Extended DataTables parameters.
 */
function tablepress_pagination_length_change_all_entry( $parameters, $table_id, $html_id, $js_options ) {
	if ( $js_options['datatables_paginate'] && $js_options['datatables_lengthchange'] ) {
		$length_menu = array( 10, 25, 50, 100 );
		if ( ! in_array( $js_options['datatables_paginate_entries'], $length_menu, true ) ) {
			$length_menu[] = absint( $js_options['datatables_paginate_entries'] );
			sort( $length_menu, SORT_NUMERIC );
		}
		$length_menu_keys = $length_menu_values = array_values( $length_menu );
		$length_menu_keys[] = -1;
		$length_menu_values[] = '"All"';
		$parameters['lengthMenu'] = '"lengthMenu":[[' . implode( ',', $length_menu_keys ) . '],[' . implode( ',', $length_menu_values ) . ']]';
	}
	return $parameters;
}

<?php

class Pcode_Apf_Cpt_Custom_Code_Css extends Pcode_AdminPageFramework_PostType
{
    public function setUp()
    {	$labels = array(
			"name" => __( 'CSS', 'presscode' ),
			"singular_name" => __( 'CSS', 'presscode' ),
			"add_new_item" => 'Add New',
			"edit_item" => 'Edit',
			"not_found" => "No code found",
			"not_found_in_trash" => "No code found in trash",
			"all_items" => __( 'CSS', 'presscode' ));

		$args = array(
			"label" => __( 'CSS', 'presscode' ),
			"labels" => $labels,
			"description" => "",
			"public" => false,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => false,
			"rest_base" => "",
			"has_archive" => false,
			"show_in_menu" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"rewrite" => array( "slug" => "pcode_custom_css", "with_front" => true ),
			"query_var" => true,
			"supports" => array( "title", "revisions" ));

        $this->setArguments($args);

    }

}


new Pcode_Apf_Cpt_Custom_Code_Css('pcode_custom_css');

?>
<?php

class Pcode_Apf_Cpt_Custom_Code_Js extends Pcode_AdminPageFramework_PostType
{
    public function setUp()
    {	$labels = array(
			"name" => __( 'JavaScript', 'presscode' ),
			"singular_name" => __( 'JavaScript', 'presscode' ),
			"add_new_item" => 'Add New',
			"edit_item" => 'Edit',
			"not_found" => "No code found",
			"not_found_in_trash" => "No code found in trash",
			"all_items" => __( 'JavaScript', 'presscode' ));

		$args = array(
			"label" => __( 'JavaScript', 'presscode' ),
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
			"rewrite" => array( "slug" => "pcode_custom_js", "with_front" => true ),
			"query_var" => true,
			"supports" => array( "title", "revisions" ));

        $this->setArguments($args);

    }

}


new Pcode_Apf_Cpt_Custom_Code_Js('pcode_custom_js');

?>
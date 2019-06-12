<?php
/*
Plugin Name: Pods tools
Plugin URI: https://github.com/modaresimr/pods-tools
Description: save custom string in title and content in pods
Version: 1.0.0
Author: Ali Modaresi
Author URI: https://github.com/modaresimr/
GitHub Plugin URI: https://github.com/modaresimr/pods-tools
*/

add_action( 'pods_api_post_save_pod_item_user_dictionary', 'my_custom_pods_update_terms_on_save', 10, 3 );

/** 
 * Update post terms on save for another associated taxonomy. 
 * 
 * @param array   $pieces      List of data. 
 * @param boolean $is_new_item Whether the item is new. 
 * @param int     $id          Item ID. 
 */ 
function my_custom_pods_update_terms_on_save( $pieces, $is_new_item, $id ) { 
	var_dump($pieces);
	var_dump($pieces['fields']);
	//(var_export($pieces['fields'],true));
	die();
    // Get the value of a single select Relationship field. 
    //$term = (int) $pieces['fields']['my_relationship_field']['value']; 

    // Set $term to null to avoid errors if no value set. 
    //if ( empty( $term ) ) { 
      //  $term = null; 
    //} 

    // Set the term for an associated taxonomy with $term. 
    //wp_set_object_terms( $id, $term, 'my_other_taxonomy', false ); 
}

add_action( 'pods_api_post_save_pod_item', 'my_title_content_pods_update_terms_on_save', 10, 3 );

/** 
 * Update post terms on save for another associated taxonomy. 
 * 
 * @param array   $pieces      List of data. 
 * @param boolean $is_new_item Whether the item is new. 
 * @param int     $id          Item ID. 
 */ 
function my_title_content_pods_update_terms_on_save( $pieces, $is_new_item, $id ) { 
	//var_dump($pieces);
	//var_dump($pieces['fields']);
	//(var_export($pieces['fields'],true));
	//die();
	
   if ( ! wp_is_post_revision( $id ) ) { 
        // Avoid recursion loops on saving. 
        pods_no_conflict_on( 'post' ); 
		// Get the value of a single select Relationship field. 
		$title = (int) $pieces['fields']['post_title2']['value']; 
		$content = (int) $pieces['fields']['post_content2']['value']; 
		$content=$result;
		// Set $term to null to avoid errors if no value set. 
		if ( empty( $title ) ) { 
			$title = null; 
		} 
		if ( empty( $content ) ) { 
			$content = null; 
		} 
		$post_data = array( 
            'ID'          => $id, 
            'post_title' => $title, 
			'post_content' => $content, 
        ); 

        wp_update_post( $post_data );
        pods_no_conflict_off( 'post' ); 

		// Set the term for an associated taxonomy with $term. 
		
   }
}
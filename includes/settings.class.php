<?php

/**
 * array(
                'label'         =>  'Au Pair First Name',
                'type'          =>  'text', 
                'name'          =>  'post_title',
                'id'            =>  '',
                'class'         =>  '',
                'placeholder'   =>  '', 
                'value'         =>  ''
            ),
*/
public static function render_form_fields( $array ){

        if( is_array( $array ) ){

            $content = "";

            foreach( $array as $key => $val ){
                if( $val['type'] == 'text' || $val['type'] == 'email' || $val['type'] == 'number'){
                    
                    $content .= "<div class='form-field'><label for='".$val['name']."'>".$val['label']."</label>";
                    $content .= "<input type='".$val['type']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' value='".$val['value']."' placeholder='".$val['placeholder']."' /></div>";
                
                } else if ( $val['type'] == 'hidden' ){
                    $content .= "<input type='".$val['type']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' value='".$val['value']."' placeholder='".$val['placeholder']."' />";
                } else if ( $val['type'] == 'textarea' ){
                
                    $content .= "<div class='form-field'><label for='".$val['name']."'>".$val['label']."</label>";
                    $content .= "<textarea name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' placeholder='".$val['placeholder']."'>".$val['value']."</textarea></div>";
                
                } else if ( $val['type'] == 'radio' ){
                
                    $content .= "<div class='form-field'>";
                    $content .= "<input type='".$val['radio']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' /><label for='".$val['name']."'>".$val['label']."</label></div>";
                
                } else if ( $val['type'] == 'select' ){
                
                    $content .= "<div class='form-field'>";
                    $content .= "<select name='' id='' >";
                    if( is_array( $val['options'] ) ){
                        foreach( $val['options']  as $key => $val ){
                            $content .= "<option value='$key'>".$val."</option>";
                        }
                    }
                    $content .= "</select>";
                
                } else if ( $val['type'] == 'submit' ) {

                    $content .= "<input type='".$val['type']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' value='".$val['value']."' />";

                } else {

                    $content .= "<div class='form-field'><label for='".$val['name']."'>".$val['label']."</label>";
                    $content .= "<input type='".$val['type']."' name='".$val['name']."' id='".$val['id']."' class='".$val['class']."' value='".$val['value']."' placeholder='".$val['placeholder']."' /></div>";

                }
            }

            return $content;

        } else {
            return false;
        }

    }

    public static function process_form_data( $post_data ){
        if( is_array( $post_data ) && !empty( $post_data ) ){

            $my_post = array(
              'post_title'    => wp_strip_all_tags( $post_data['post_title'] ),
              'post_content'  => $post_data['post_content'],
              'post_status'   => 'publish',
              'post_author'   => get_current_user_id(),
              'post_type'     => $post_data['post_type']
            );
             
            $post_id = wp_insert_post( $my_post );

            foreach( $post_data as $key => $val ){
                if( strpos($key, 'submit_') === false && strpos($key, 'post_') === false ){
                    update_post_meta( $post_id, $key, $val );   
                }
            }

        }
    }
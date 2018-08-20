<?php
   /*
   Plugin Name: Our Metabox
   Plugin URI: http://faisalkhanforex.freesite.host/
   description: You can use any where any page post this tiny slider
   Version: 8.0
   Author: Faisal Khan
   Author URI: http://faisalkhanforex.com/
   License: GPLv2 or later
   Text Domain: our-metabox
   Domain Path: /languages/
   */

   class ourmetabox{
        public function __construct(){

            add_action('plugins_loaded', array($this, 'omb_load_textdomain'));
            add_action('admin_menu', array($this, 'omb_add_metabox'));
            add_action('save_post', array($this, 'omb_save_location'));

        }

        private function is_secure($nonse_field,$action,$post_id){
            $nonse = isset($_POST[$nonse_field])? $_POST[$nonse_field]:'';

            if($nonse == ''){
                return false;
            }

            if(!wp_verify_nonce( $nonse, $action )){
                return false;
            }

            if(!current_user_can('edit_post', $post_id)){
                return false;
            }

            if(wp_is_post_autosave( $post_id )){
                return false;
            }

            if(wp_is_post_revision( $post_id )){
                return false;
            }

            return true;
        }

        public function omb_add_metabox(){
            add_meta_box( 'omb_post_location', __('Location', 'our-metabox'), array($this, 'omb_display_post_location'), 'post' );
        }

        public function omb_display_post_location($post){
            $location = get_post_meta($post->ID, 'omb_location', true);
            $country = get_post_meta($post->ID, 'omb_country', true);
            $omb_is_favurote = get_post_meta($post->ID, 'omb_is_favurote', true);
            $checked = $omb_is_favurote == 1? 'checked': '';
            $save_color = get_post_meta($post->ID, 'omb_clr', true);
            $save_radio = get_post_meta($post->ID, 'omb_color', true);
            $omb_list_country = get_post_meta($post->ID, 'omb_slec', true);
            
            

            $label1 = __('Location', 'our-metabox');
            $label2 = __('Country', 'our-metabox');
            $label3 = __('Is Favuote', 'our-metabox');
            $label4 = __('Color', 'our-metabox');
            $label5 = __('Radio', 'our-metabox');
            $label6 = __('Country List', 'our-metabox');

            $colors = array('red','blue','yellow','black','green');
            $countres = array(
                __('None', 'our-metabox'),
                __('India', 'our-metabox'),
                __('Bangladesh', 'our-metabox'),
                __('Srelanka', 'our-metabox'),
                __('Vutan', 'our-metabox'),
                __('Maldiev', 'our-metabox'),
                __('Nepal', 'our-metabox'),
                __('Pakistan', 'our-metabox'),
                __('Afganistan', 'our-metabox')
            );

            wp_nonce_field('omb_location', 'omb_location_field');

            $metabox_html = '
               <p>
                    <label for="omb_location">'.$label1.'</label>
                    <input type="text" name="omb_location" id="omb_location" value="'.$location.'"/>
               </p>
               <p>
                    <label for="omb_country">'.$label2.'</label>
                    <input type="text" name="omb_country" id="omb_country" value="'.$country.'"/>
               </p>
               <p>
                    <label for="omb_is_favurote">'.$label3.'</label>
                    <input type="checkbox" name="omb_is_favurote" id="omb_is_favurote" value="1" '.$checked.'/>
               </p>'; 
            /* Group Checkbox Field Start */
            $metabox_html .= '<p>  
                <label>'.$label4.': </label>';
                    foreach($colors as $color){
                        $b_color = ucwords($color);
                        $checked = in_array($color,$save_color) ? 'checked': '';
                        $metabox_html .= '<label for="omb_clr_'.$color.'">'.$b_color.'</label>
                        <input type="checkbox" name="omb_clr[]" id="omb_clr_'.$color.'" value="'.$color.'" '.$checked.'/>
                        ';   
                    }
                    
            $metabox_html .= '</p>';
            /* Group Checkbox Field End */

            /* Radio Field Start */
            $metabox_html .= '<p>
                <label>'.$label5.': </label>';
                foreach($colors as $color){
                    $b_color = ucwords($color);
                    $checked = ($color == $save_radio)? "checked = 'checked'" : '';
                    $metabox_html .= '<label for="omb_color_'.$color.'">'.$b_color.'</label>
                    <input type="radio" name="omb_color" id="omb_color_'.$color.'" value="'.$color.'" '.$checked.'/>
                    ';   
                }
            $metabox_html .= '</p>';
            /* Radio Field End */

            /* Select Field Start */
            $metabox_html .= '<label>'.$label6.': </label>
                <select name="omb_slec" id="omb_slec">';
                foreach($countres as $countrye){
                    $selected = '';
                    if($countrye == $omb_list_country) $selected = 'selected';
                    $metabox_html .= '<option value="'.$countrye.'" '.$selected.' >'.$countrye.'</option>';
                }
            $metabox_html .= '</select>';
            /* Select Field End */

            echo $metabox_html;
        }

        public function omb_save_location($post_id){
            if(!$this->is_secure('omb_location_field', 'omb_location', $post_id)){
                return $post_id;
            }
            $location = isset($_POST['omb_location'])? $_POST['omb_location']:'';
            $country = isset($_POST['omb_country'])? $_POST['omb_country']:'';
            $omb_is_favurote = isset($_POST['omb_is_favurote'])? $_POST['omb_is_favurote']: 0;
            $colors = isset($_POST['omb_clr'])? $_POST['omb_clr']: array();
            $save_radio = isset($_POST['omb_color'])? $_POST['omb_color']: '';
            $omb_list_country = isset($_POST['omb_slec'])? $_POST['omb_slec']: '';
            if($location == '' || $country == ''){
                return $post_id;
            }

            $location = sanitize_text_field($location);
            $country = sanitize_text_field($country);
            
            update_post_meta($post_id,'omb_location', $location);
            update_post_meta($post_id,'omb_country', $country);
            update_post_meta($post_id,'omb_is_favurote', $omb_is_favurote);
            update_post_meta($post_id,'omb_clr', $colors);
            update_post_meta($post_id,'omb_color', $save_radio);
            update_post_meta($post_id,'omb_slec', $omb_list_country);
        }

        public function omb_load_textdomain(){
            load_plugin_textdomain( 'our-metabox',false,dirname(__FILE__)."/languages" );
        }
   }
   new ourmetabox();
<?php

namespace ShippingAppointments\Includes;

use ShippingAppointments\Traits\Settings as SettingsFields;

class Settings {

    use SettingsFields;

    private $plugin_slug;
    private $textdomain;
    private $options;
    private $settings;

    public function __construct( $plugin_slug ) {

        $this->plugin_slug  = $plugin_slug;
        $this->textdomain   = str_replace('_', '-', $plugin_slug);

    }


    /**
     * Initialise settings
     * @return void
     */
    public function init() {
        $this->settings = $this->getSettings();
        $this->options = $this->getOptions();
        $this->registerSettings();
    }


    public function addSettingsMenu(){
        $page = add_submenu_page( 'shipping-appointments','Shipping Appointments Settings', 'Settings', 'manage_options' , 'shipping-appointments-settings',  array( $this, 'settingsPage' ) );
    }


    /**
     * Add settings link to plugin list table
     * @param  array $links Existing links
     * @return array 		Modified links
     */
    public function addSettingsLink( $links, $plugin_file, $plugin_data, $context ) {

//        echo $plugin_file;
        if( $plugin_file === 'shipping-appointments/shipping-appointments.php' ) {

            $settings_link = array( '<a href="admin.php?page=' . $this->plugin_slug . '-settings">' . __( 'Settings', $this->textdomain ) . '</a>' );
            $links         = array_merge( $links, $settings_link );
        }
        return $links;
    }




    /**
     * Options getter
     * @return array Options, either saved or default ones.
     */
    public function getOptions() {
        $options = get_option($this->plugin_slug);

        if ( !$options && is_array( $this->settings ) ) {
            $options = Array();
            foreach( $this->settings as $section => $data ) {
                foreach( $data['fields'] as $field ) {
                    $options[ $field['id'] ] = $field['default'];
                }
            }

            add_option( $this->plugin_slug, $options );
        }

        return $options;
    }

    /**
     * Register plugin settings
     * @return void
     */
    public function registerSettings() {
        if( is_array( $this->settings ) ) {

            register_setting( $this->plugin_slug, $this->plugin_slug, array( $this, 'validateFields' ) );

            foreach( $this->settings as $section => $data ) {

                // Add section to page
                add_settings_section( $section, $data['title'], array( $this, 'settingsSection' ), $this->plugin_slug );

                foreach( $data['fields'] as $field ) {

                    // Add field to page
                    add_settings_field( $field['id'], $field['label'], array( $this, 'displayField' ), $this->plugin_slug, $section, array( 'field' => $field ) );
                }
            }
        }
    }

    public function settingsSection( $section ) {
        $html = '<p class="settings-container--description"> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
        echo $html;
    }

    /**
     * Generate HTML for displaying fields
     * @param  array $args Field data
     * @return void
     */
    public function displayField( $args ) {

        $field = $args['field'];

        $html = '';

        $option_name = $this->plugin_slug ."[". $field['id']. "]";

        $data = (isset($this->options[$field['id']])) ? $this->options[$field['id']] : '';

        switch( $field['type'] ) {

            case 'text':
            case 'password':
            case 'number':
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value="' . $data . '"/>' . "\n";
                break;

            case 'text_secret':
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="text" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '" value=""/>' . "\n";
                break;

            case 'textarea':
                $html .= '<textarea id="' . esc_attr( $field['id'] ) . '" rows="5" cols="50" name="' . esc_attr( $option_name ) . '" placeholder="' . esc_attr( $field['placeholder'] ) . '">' . $data . '</textarea><br/>'. "\n";
                break;

            case 'checkbox':
                $checked = '';
                if( $data && 'on' == $data ){
                    $checked = 'checked="checked"';
                }
                $html .= '<input id="' . esc_attr( $field['id'] ) . '" type="' . $field['type'] . '" name="' . esc_attr( $option_name ) . '" ' . $checked . '/>' . "\n";
                break;

            case 'checkbox_multi':
                foreach( $field['options'] as $k => $v ) {
                    $checked = false;
                    if( is_array($data) && in_array( $k, $data ) ) {
                        $checked = true;
                    }
                    $html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="checkbox" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '[]" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
                }
                break;

            case 'radio':
                foreach( $field['options'] as $k => $v ) {
                    $checked = false;
                    if( $k == $data ) {
                        $checked = true;
                    }
                    $html .= '<label for="' . esc_attr( $field['id'] . '_' . $k ) . '"><input type="radio" ' . checked( $checked, true, false ) . ' name="' . esc_attr( $option_name ) . '" value="' . esc_attr( $k ) . '" id="' . esc_attr( $field['id'] . '_' . $k ) . '" /> ' . $v . '</label> ';
                }
                break;

            case 'select':
                $html .= '<select name="' . esc_attr( $option_name ) . '" id="' . esc_attr( $field['id'] ) . '">';
                foreach( $field['options'] as $k => $v ) {
                    $selected = false;
                    if( $k == $data ) {
                        $selected = true;
                    }
                    $html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '">' . $v . '</option>';
                }
                $html .= '</select> ';
                break;

            case 'select_multi':
                $html .= '<select name="' . esc_attr( $option_name ) . '[]" id="' . esc_attr( $field['id'] ) . '" multiple="multiple">';
                foreach( $field['options'] as $k => $v ) {
                    $selected = false;
                    if( in_array( $k, $data ) ) {
                        $selected = true;
                    }
                    $html .= '<option ' . selected( $selected, true, false ) . ' value="' . esc_attr( $k ) . '" />' . $v . '</label> ';
                }
                $html .= '</select> ';
                break;

        }

        switch( $field['type'] ) {

            case 'checkbox_multi':
            case 'radio':
            case 'select_multi':
                $html .= '<br/><span class="description">' . $field['description'] . '</span>';
                break;

            default:
                $html .= '<label for="' . esc_attr( $field['id'] ) . '"><span class="description">' . $field['description'] . '</span></label>' . "\n";
                break;
        }

        echo $html;
    }

    /**
     * Validate individual settings field
     * @param  array $data Inputted value
     * @return array       Validated value
     */
    public function validateFields( $data ) {
        // $data array contains values to be saved:
        // either sanitize/modify $data or return false
        // to prevent the new options to be saved

        // Sanitize fields, eg. cast number field to integer
        // $data['number_field'] = (int) $data['number_field'];

        // Validate fields, eg. don't save options if the password field is empty
        // if ( $data['password_field'] == '' ) {
        // 	add_settings_error( $this->plugin_slug, 'no-password', __('A password is required.', $this->textdomain), 'error' );
        // 	return false;
        // }

        return $data;
    }

    /**
     * Load settings page content
     * @return void
     */
    public function settingsPage() {
        // Build page HTML output
        // If you don't need tabbed navigation just strip out everything between the <!-- Tab navigation --> tags.
        ?>
        <div class="wrap" id="<?php echo $this->plugin_slug; ?>">

            <div class="settings-header">
                <h1><?php echo $this->getSettingsPageTitle(); ?></h1>
                <p><?php echo $this->getSettingsPageDescription(); ?></p>
            </div>

            <div class="nav-tab-wrapper settings-tabs hide-if-no-js">
                <?php
                foreach( $this->settings as $section => $data ) {
                    echo '<a href="#' . $section . '" class="nav-tab">' . $data['title'] . '</a>';
                }
                ?>
            </div>
            <?php $this->addScript(); ?>

            <form action="options.php" method="POST">
                <?php settings_fields( $this->plugin_slug ); ?>
                <div class="settings-container">
                    <?php do_settings_sections( $this->plugin_slug ); ?>
                </div>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    /**
     * Print jQuery script for tabbed navigation
     * @return void
     */
    private function addScript() {
        // Very simple jQuery logic for the tabbed navigation.
        // Delete this function if you don't need it.
        // If you have other JS assets you may merge this there.
        ?>
        <script>
            jQuery(document).ready(function($) {
                var headings = jQuery('.settings-container > h2, .settings-container > h3');
                var paragraphs  = jQuery('.settings-container > p');
                var tables = jQuery('.settings-container > table');
                var triggers = jQuery('.settings-tabs a');

                triggers.each(function(i){
                    triggers.eq(i).on('click', function(e){
                        e.preventDefault();
                        triggers.removeClass('nav-tab-active');
                        headings.hide();
                        paragraphs.hide();
                        tables.hide();

                        triggers.eq(i).addClass('nav-tab-active');
                        headings.eq(i).show();
                        paragraphs.eq(i).show();
                        tables.eq(i).show();
                    });
                })

                triggers.eq(0).click();
            });
        </script>
        <?php
    }
}


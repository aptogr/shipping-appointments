<?php


namespace ShippingAppointments\Traits;

Trait Settings {


    /**
     * Build settings fields
     * @return array Fields to be displayed on settings page
     */
    public function getSettings(){

        $settings['easy'] = array(
            'title'					=> __( 'Standard', $this->textdomain ),
            'description'			=> __( 'These are fairly standard form input fields.', $this->textdomain ),
            'fields'				=> array(
                array(
                    'id' 			=> 'text_field',
                    'label'			=> __( 'Some Text' , $this->textdomain ),
                    'description'	=> __( 'This is a standard text field.', $this->textdomain ),
                    'type'			=> 'text',
                    'default'		=> '',
                    'placeholder'	=> __( 'Placeholder text', $this->textdomain )
                ),
                array(
                    'id' 			=> 'password_field',
                    'label'			=> __( 'A Password' , $this->textdomain ),
                    'description'	=> __( 'This is a standard password field.', $this->textdomain ),
                    'type'			=> 'password',
                    'default'		=> '',
                    'placeholder'	=> __( 'Placeholder text', $this->textdomain )
                ),
                array(
                    'id' 			=> 'secret_text_field',
                    'label'			=> __( 'Some Secret Text' , $this->textdomain ),
                    'description'	=> __( 'This is a secret text field - any data saved here will not be displayed after the page has reloaded, but it will be saved.', $this->textdomain ),
                    'type'			=> 'text_secret',
                    'default'		=> '',
                    'placeholder'	=> __( 'Placeholder text', $this->textdomain )
                ),
                array(
                    'id' 			=> 'text_block',
                    'label'			=> __( 'A Text Block' , $this->textdomain ),
                    'description'	=> __( 'This is a standard text area.', $this->textdomain ),
                    'type'			=> 'textarea',
                    'default'		=> '',
                    'placeholder'	=> __( 'Placeholder text for this textarea', $this->textdomain )
                ),
                array(
                    'id' 			=> 'single_checkbox',
                    'label'			=> __( 'An Option', $this->textdomain ),
                    'description'	=> __( 'A standard checkbox - if you save this option as checked then it will store the option as \'on\', otherwise it will be an empty string.', $this->textdomain ),
                    'type'			=> 'checkbox',
                    'default'		=> 'on'
                ),
                array(
                    'id' 			=> 'select_box',
                    'label'			=> __( 'A Select Box', $this->textdomain ),
                    'description'	=> __( 'A standard select box.', $this->textdomain ),
                    'type'			=> 'select',
                    'options'		=> array( 'drupal' => 'Drupal', 'joomla' => 'Joomla', 'wordpress' => 'WordPress' ),
                    'default'		=> 'wordpress'
                ),
                array(
                    'id' 			=> 'radio_buttons',
                    'label'			=> __( 'Some Options', $this->textdomain ),
                    'description'	=> __( 'A standard set of radio buttons.', $this->textdomain ),
                    'type'			=> 'radio',
                    'options'		=> array( 'superman' => 'Superman', 'batman' => 'Batman', 'ironman' => 'Iron Man' ),
                    'default'		=> 'batman'
                )
            )
        );

        $settings['extra'] = array(
            'title'					=> __( 'Extra', $this->textdomain ),
            'description'			=> __( 'These are some extra input fields that maybe aren\'t as common as the others.', $this->textdomain ),
            'fields'				=> array(
                array(
                    'id' 			=> 'multiple_checkboxes',
                    'label'			=> __( 'Some Items', $this->textdomain ),
                    'description'	=> __( 'You can select multiple items and they will be stored as an array.', $this->textdomain ),
                    'type'			=> 'checkbox_multi',
                    'options'		=> array( 'square' => 'Square', 'circle' => 'Circle', 'rectangle' => 'Rectangle', 'triangle' => 'Triangle' ),
                    'default'		=> array( 'circle', 'triangle' )
                ),
                array(
                    'id' 			=> 'number_field',
                    'label'			=> __( 'A Number' , $this->textdomain ),
                    'description'	=> __( 'This is a standard number field - if this field contains anything other than numbers then the form will not be submitted.', $this->textdomain ),
                    'type'			=> 'number',
                    'default'		=> '',
                    'placeholder'	=> __( '42', $this->textdomain )
                ),
                array(
                    'id' 			=> 'multi_select_box',
                    'label'			=> __( 'A Multi-Select Box', $this->textdomain ),
                    'description'	=> __( 'A standard multi-select box - the saved data is stored as an array.', $this->textdomain ),
                    'type'			=> 'select_multi',
                    'options'		=> array( 'linux' => 'Linux', 'mac' => 'Mac', 'windows' => 'Windows' ),
                    'default'		=> array( 'linux' )
                )
            )
        );

        $settings = apply_filters( 'plugin_settings_fields', $settings );

        return $settings;

    }


    public function getSettingsPageTitle(){

        return 'Plugin Settings Page';

    }

    public function getSettingsPageDescription(){

        return 'Some infos about my plugin.';

    }

}

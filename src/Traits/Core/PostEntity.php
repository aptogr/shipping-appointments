<?php


namespace ShippingAppointments\Traits\Core;

Trait PostEntity {

    protected $ID;
    protected $post;
    protected $author;
    private $metaSlugs;
    private $postMeta;

    public function setProperties(){

        $this->author = get_user_by('ID', $this->post->post_author );

        foreach ( $this->metaSlugs as $property => $metaKey ){

            if( property_exists( $this, $property ) ){

                if( isset( $this->postMeta[ $metaKey ] ) ){

                    $value = $this->postMeta[$metaKey][0];

                    if ( @unserialize( $value ) !== false ){

                        $this->$property = unserialize( $value );

                    }
                    else {

                        $this->$property = $value;

                    }

                }
            }

        }

    }

}

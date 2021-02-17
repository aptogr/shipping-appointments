<?php


namespace ShippingAppointments\Traits\Core;

use WP_Post;
use WP_User;

Trait PostEntity {

	/**
	 * @var $ID int
	 */
	public $ID;

	/**
	 * @var $post WP_Post
	 */
	public $post;

	/**
	 * @var $author WP_User
	 */
	public $author;

	/**
	 * @var $metaSlugs array
	 */
	public $metaSlugs;

	/**
	 * @var $postMeta array
	 */
	public $postMeta;

    public function setProperties(){

        $this->author = get_user_by('ID', $this->post->post_author );

        foreach ( $this->metaSlugs as $property => $metaKey ){

            if( property_exists( $this, $property ) ){

                if( isset( $this->postMeta[ $metaKey ] ) ){

                    if( count( $this->postMeta[$metaKey] ) > 1 ){

                        $value = $this->postMeta[$metaKey];

                    }
                    else {

                        $value = $this->postMeta[$metaKey][0];

                    }

//                    var_dump($this->postMeta[$metaKey]);
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

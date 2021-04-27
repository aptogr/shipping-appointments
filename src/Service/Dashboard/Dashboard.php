<?php

namespace ShippingAppointments\Service\Dashboard;

use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\PostType\AppointmentPost;
use ShippingAppointments\Service\PostType\ShippingCompanyPost;
use WP_Post;

class Dashboard {

    public function isDashboardPage(){

        if( is_post_type_archive( ShippingCompanyPost::POST_TYPE_NAME )
            || is_singular( ShippingCompanyPost::POST_TYPE_NAME )
            || is_post_type_archive( AppointmentPost::POST_TYPE_NAME )
            || is_singular( AppointmentPost::POST_TYPE_NAME )
        ){

            return true;

        }
        else {

            global $post;

            if( $post instanceof WP_Post ){

                if( $post->post_name === 'dashboard' ){
                    return true;
                }

                if ($post->post_parent)	{
                    $ancestors=get_post_ancestors($post->ID);
                    $root=count($ancestors)-1;
                    $parent = $ancestors[$root];
                }
                else {
                    $parent = $post->ID;
                }

                $slug = get_post_field( 'post_name', $parent );

                return $slug === 'dashboard';

            }
            else {
                return false;
            }

        }

    }




}

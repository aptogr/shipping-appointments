<?php


namespace ShippingAppointments\Service\Dashboard\Access;


class DashboardEncryption {

    const SECRET_KEY    = 'H+MbQeThWmZq4t6w';
    const SECRET_IV     = 's6v9y$B&';

    public function encrypt( $string ){

       return $this->encrypt_decrypt( 'encrypt', $string );

    }

    public function decrypt( $string ){

        return $this->encrypt_decrypt( 'decrypt', $string );

    }


    private function encrypt_decrypt( $action, $string ){
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'H+MbQeThWmZq4t6w';
        $secret_iv = 's6v9y$B&';
        // hash
        $key = hash('sha256', $secret_key);
        // iv - encrypt method AES-256-CBC expects 16 bytes
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

}

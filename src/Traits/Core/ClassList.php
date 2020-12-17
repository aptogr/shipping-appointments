<?php

namespace ShippingAppointments\Traits\Core;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

Trait ClassList {


	/**
	 * The directory path of the folder where we will look
	 * for the classes defined inside it
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string   $folderDirPath   Path of folder to look into.
	 */
	protected $folderDirPath;



	/**
	 * An array of classes with their namespaces that belong
	 * inside the folder set in the $folderDirPath
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array   $classes   Array of classes.
	 */
	protected $classes;



	public function setClasses(){

		$this->classes = array();

		$allFiles = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $this->folderDirPath ) );
		$phpFiles = new RegexIterator( $allFiles, '/\.php$/' );

		foreach ( $phpFiles as $phpFile ) {

			$content    = file_get_contents( $phpFile->getRealPath() );
			$tokens     = token_get_all( $content );
			$namespace  = '';

			for ( $index = 0; isset( $tokens[$index] ); $index++ ) {

				if ( !isset( $tokens[ $index ][0] ) ) {
					continue;
				}

				if ( T_NAMESPACE === $tokens[$index][0] ) {

					$index += 2; // Skip namespace keyword and whitespace

					while ( isset( $tokens[ $index ]) && is_array( $tokens[ $index ] ) ) {

						$namespace .= $tokens[$index++][1];

					}

				}
				if ( T_CLASS === $tokens[ $index ][0] && T_WHITESPACE === $tokens[ $index + 1 ][0] && T_STRING === $tokens[ $index + 2 ][0] ) {

					$index += 2; // Skip class keyword and whitespace
					$this->classes[] = $namespace.'\\'.$tokens[ $index ][1];

					# break if you have one class per file (psr-4 compliant)
					# otherwise you'll need to handle class constants (Foo::class)
					break;

				}
			}

		}

	}

}

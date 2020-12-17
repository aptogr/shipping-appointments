<?php

namespace ShippingAppointments\Traits\Core;

use ShippingAppointments\Includes\Loader;

Trait Plugin {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $pluginName    The string used to uniquely identify this plugin.
     */
    protected $pluginName;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;


    /**
     * The plugin directory path
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $pluginDirPath    The directory path of the plugin.
     */
    protected $pluginDirPath;


    /**
     * The plugin directory url
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $pluginDirUrl    The directory path of the url.
     */
    protected $pluginDirUrl;


    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function getPluginName() {

        return $this->pluginName;

    }



    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Loader    Orchestrates the hooks of the plugin.
     */
    public function getLoader() {

        return $this->loader;

    }



    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function getVersion() {

        return $this->version;

    }


    /**
     * Retrieve the plugin directory path.
     *
     * @since     1.0.0
     * @return    string    The path of the plugin.
     */
    public function getPluginDirPath() {

        return $this->pluginDirPath;

    }


    /**
     * Retrieve the plugin directory url.
     *
     * @since     1.0.0
     * @return    string    The url of the plugin.
     */
    public function getPluginDirUrl() {

        return $this->pluginDirUrl;

    }

}

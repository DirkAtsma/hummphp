<?php

/**
 * This file implement the Humm PHP entry point.
 *
 * Every user request to a Humm PHP managed site
 * end here and then Humm PHP initiates boot strap.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

/**
 * Register our classes autoload.
 */
\spl_autoload_register(function($class)
{
  require __DIR__.\DIRECTORY_SEPARATOR.\str_replace(
         '\\', \DIRECTORY_SEPARATOR, $class).'.php';
});

 /**
 * Initiates the system boot strap.
 */
\Humm\System\Classes\BootStrap::init(__DIR__);
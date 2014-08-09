<?php

/**
 * This file implement the FileNames system class.
 *
 * Humm PHP use this class to define not localizables,
 * case sensitive file names of Humm PHP.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System FileNames class implementation.
 *
 * Define certain not localizables, case sensitive directory
 * names of the sytem and also the user sites file names.
 */
class FileNames extends Unclonable
{
  /**
   * Define the configurations files name.
   */
  const CONFIG_FILE_NAME = 'Config.php';

  /**
   * Define the system version file name.
   */
  const VERSION_FILE_NAME = 'Version.php';

  /**
   * Define the system I18n functions file name.
   */
  const I18N_FUNCTIONS_FILE_NAME = 'I18nFunctions.php';

  /**
   * Define an index PHP file: like Humm PHP entry point file name.
   */
  const PHP_INDEX_FILE_NAME = 'index.php';
}
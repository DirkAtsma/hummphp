<?php

/**
 * This file implement the BootStrap system class.
 *
 * Humm PHP use this class in their unique entry
 * point (index.php) to prepare the user response.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System BootStrap class implementation.
 *
 * This is a system internal Humm PHP class and do not
 * contain useful stuff from the site point of view.
 */
class BootStrap extends Unclonable
{
  /**
   * Initialize the Humm PHP boot strap.
   *
   * This method is the responsible to initialize all other
   * neccesary Humm PHP system classes in the right order
   * and finally provide the appropiate user response.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   * @param string $dir Humm PHP root directory path.
   */
  public static function init($dir)
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      DirPaths::init($dir);
      // After DirPaths
      ErrorHandler::init();
      UserSites::init();
      HummVersion::init();
      UrlArguments::init();
      ClientSession::init();
      Configuration::init();
      // After Configuration
      Languages::init();
      // After Languages
      Localization::init();
      HummPlugins::init();
      // After HummPlugins
      Requeriments::init();
      Database::init();
      ViewsHandler::init();
    }
    exit(0);
  }
}
<?php

/**
 * This file implement the FilePaths system class.
 *
 * This class is used internally by Humm PHP and also
 * can be used by site classes, views and plugins to
 * retrieve Humm PHP related file paths.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System FilePaths class implementation.
 *
 * Although this class is internally used by other
 * Humm PHP system classes, contain stuff which can
 * also be useful from the user site point of view.
 */
class FilePaths extends Unclonable
{
  /**
   * Define a MO file extension.
   */
  const MO_FILE_EXTENSION = 'mo';

  /**
   * Define a PHP file extension.
   */
  const PHP_FILE_EXTENSION = 'php';

  /**
   * Define a MO file dotted extension.
   */
  const MO_FILE_DOT_EXTENSION = '.mo';

  /**
   * Define a PHP file dotted extension.
   */
  const PHP_FILE_DOT_EXTENSION = '.php';

  /**
   * Retrieve the system configuration file path.
   *
   * @static
   * @return string System configuration file path.
   */
  public static function systemConfig()
  {
    return DirPaths::systemConfig().FileNames::CONFIG_FILE_NAME;
  }

  /**
   * Retrieve the system text domain or MO file path.
   *
   * @static
   * @return string System text domain or MO file path.
   */
  public static function systemTextDomain()
  {
    $langCode = Languages::getCurrentLanguage();
    return DirPaths::systemLocale().
           $langCode.
           \DIRECTORY_SEPARATOR.
           $langCode.
           self::MO_FILE_DOT_EXTENSION;
  }

  /**
   * Retrieve the system version file path.
   *
   * @static
   * @return string System version file path.
   */
  public static function systemVersion()
  {
    return DirPaths::version().FileNames::VERSION_FILE_NAME;
  }

  /**
   * Retrieve the current site configuration file path.
   *
   * @static
   * @return string Current site configuration file path.
   */
  public static function siteConfig()
  {
    return DirPaths::siteConfig().FileNames::CONFIG_FILE_NAME;
  }

  /**
   * Retrieve the current site text domain or MO file path.
   *
   * @static
   * @return string Current site text domain or MO file path.
   */
  public static function siteTextDomain()
  {
    $langCode = Languages::getCurrentLanguage();
    return DirPaths::siteLocale().
           $langCode.
           \DIRECTORY_SEPARATOR.
           $langCode.
           self::MO_FILE_DOT_EXTENSION;
  }

  /**
   * Retrieve the system I18n functions file path.
   *
   * @static
   * @return string System I18n functions file path.
   */
  public static function systemI18nFunctions()
  {
    return DirPaths::systemProcedural().FileNames::I18N_FUNCTIONS_FILE_NAME;
  }

  /**
   * Retrieve a plugin text domain or MO file path.
   *
   * @static
   * @return string Plugin text domain or MO file path.
   */
  public static function pluginTextDomain($pluginDir)
  {
    $langCode = Languages::getCurrentLanguage();
    return DirPaths::pluginLocale($pluginDir).
           $langCode.
           \DIRECTORY_SEPARATOR.
           $langCode.
           self::MO_FILE_DOT_EXTENSION;
  }
}
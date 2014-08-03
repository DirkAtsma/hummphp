<?php

/**
 * This file implement the DirPaths system class.
 *
 * Humm PHP use this class to discover and use absolute
 * paths of well know directories.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System DirPaths class implementation.
 *
 * This class can be used by user site classes, views
 * and plugins to retrieve well know directory paths.
 */
class DirPaths extends Unclonable
{
  /**
   * Define the root directory name.
   */
  const HUMM_DIR_NAME = 'Humm';

  /**
   * Define the sites directory name.
   */
  const SITES_DIR_NAME = 'Sites';

  /**
   * Define the system directory name.
   */
  const SYSTEM_DIR_NAME = 'System';

  /**
   * Define the config directory name.
   */
  const CONFIG_DIR_NAME = 'Config';

  /**
   * Define the locale directory name.
   */
  const LOCALE_DIR_NAME = 'Locale';

  /**
   * Define the plugins directory name.
   */
  const PLUGINS_DIR_NAME = 'Plugins';

  /**
   * Define the version directory name.
   */
  const VERSION_DIR_NAME = 'Version';

  /**
   * Define the procedural directory name.
   */
  const PROCEDURAL_DIR_NAME = 'Procedural';

  /**
   * Define the views directory name.
   */
  const VIEWS_DIR_NAME = 'Views';

  /**
   * Define the helpers name.
   */
  const VIEWS_FILES_DIR_NAME = 'Files';

  /**
   * Define the helpers name.
   */
  const VIEWS_HELPERS_DIR_NAME = 'Helpers';

  /**
   * Define the styles directory name.
   */
  const VIEWS_STYLES_DIR_NAME = 'Styles';

  /**
   * Define the scripts directory name.
   */
  const VIEWS_SCRIPTS_DIR_NAME = 'Scripts';

  /**
   * Define the images directory name.
   */
  const VIEWS_IMAGES_DIR_NAME = 'Images';

  /**
   * Store the Humm PHP root directory path.
   *
   * @var string
   */
  private static $rootDir = null;

  /**
   * Store the Humm PHP root directory path.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   * @param string $rootDir Humm PHP root absolute directory path.
   * @param string Humm PHP directory path.
   */
  public static function init($rootDir)
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      self::$rootDir = $rootDir;
    }
  }

  /**
   * Retrieve the root directory path.
   *
   * @static
   * @return string Root absolute directory path.
   */
  public static function root()
  {
    return self::$rootDir.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the root/humm directory path.
   *
   * @static
   * @return string Root/humm absolute directory path.
   */
  public static function humm()
  {
    return self::root().self::HUMM_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the version directory path.
   *
   * @static
   * @return string Version absolute directory path.
   */
  public static function version()
  {
    return self::system().self::VERSION_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a Humm PHP plugins directory path.
   *
   * @static
   * @return string Humm PHP plugins absolute directory path.
   */
  public static function plugins()
  {
    return self::humm().self::PLUGINS_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a plugin locale directory path.
   *
   * @static
   * @return string Plugin locale absolute directory path.
   */
  public static function pluginLocale($pluginDir)
  {
    return $pluginDir.self::LOCALE_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system directory path.
   *
   * @static
   * @return string System absolute directory path.
   */
  public static function system()
  {
    return self::humm().self::SYSTEM_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system config directory path.
   *
   * @static
   * @return string System config absolute directory path.
   */
  public static function systemConfig()
  {
    return self::system().self::CONFIG_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system locale directory path.
   *
   * @static
   * @return string System locale absolute directory path.
   */
  public static function systemLocale()
  {
    return self::system().self::LOCALE_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system procedural directory path.
   *
   * @static
   * @return string System procedural absolute directory path.
   */
  public static function systemProcedural()
  {
    return self::system().self::PROCEDURAL_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system views directory path.
   *
   * @static
   * @return string System views absolute directory path.
   */
  public static function systemViews()
  {
    return self::system().self::VIEWS_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system files directory path.
   *
   * @static
   * @return string System files absolute directory path.
   */
  public static function systemViewsFiles()
  {
    return self::systemViews().
     self::VIEWS_FILES_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system helpers directory path.
   *
   * @static
   * @return string System helpers absolute directory path.
   */
  public static function systemViewsHelpers()
  {
    return self::systemViews().
     self::VIEWS_HELPERS_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system images directory path.
   *
   * @static
   * @return string System images absolute directory path.
   */
  public static function systemViewsImages()
  {
    return self::systemViews().
     self::VIEWS_IMAGES_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system styles directory path.
   *
   * @static
   * @return string System styles absolute directory path.
   */
  public static function systemViewsStyles()
  {
    return self::systemViews().
     self::VIEWS_STYLES_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the system scripts directory path.
   *
   * @static
   * @return string System scripts absolute directory path.
   */
  public static function systemViewsScripts()
  {
    return self::systemViews().
     self::VIEWS_SCRIPTS_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site config directory path.
   *
   * @static
   * @return string Site config absolute directory path.
   */
  public static function siteConfig()
  {
    return self::site().self::CONFIG_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site locale directory path.
   *
   * @static
   * @return string Site locale absolute directory path.
   */
  public static function siteLocale()
  {
    return self::site().self::LOCALE_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the site procedural directory path.
   *
   * @static
   * @return string site procedural absolute directory path.
   */
  public static function siteProcedural()
  {
    return self::site().self::PROCEDURAL_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the site directory path.
   *
   * @static
   * @return string Site absolute directory path.
   */
  public static function site()
  {
    return self::humm().self::SITES_DIR_NAME.\DIRECTORY_SEPARATOR.
     UserSites::siteDirName().\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a user site directory path.
   *
   * @static
   * @return string User site absolute directory path.
   */
  public static function siteViews()
  {
    return self::site().self::VIEWS_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site files directory path.
   *
   * @static
   * @return string Site files absolute directory path.
   */
  public static function siteViewsFiles()
  {
    return self::siteViews().self::VIEWS_FILES_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site helpers directory path.
   *
   * @static
   * @return string Site helpers absolute directory path.
   */
  public static function siteViewsHelpers()
  {
    return self::siteViews().self::VIEWS_HELPERS_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site images directory path.
   *
   * @static
   * @return string Site images absolute directory path.
   */
  public static function siteViewsImages()
  {
    return self::siteViews().self::VIEWS_IMAGES_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site scripts directory path.
   *
   * @static
   * @return string Site scripts absolute directory path.
   */
  public static function siteViewsScripts()
  {
    return self::siteViews().self::VIEWS_SCRIPTS_DIR_NAME.\DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve a site styles directory path.
   *
   * @static
   * @return string Site styles absolute directory path.
   */
  public static function siteViewsStyles()
  {
    return self::siteViews().self::VIEWS_STYLES_DIR_NAME.\DIRECTORY_SEPARATOR;
  }
}
<?php

/**
 * This file implement the UrlPaths system class.
 *
 * This class is intended to offer a convenient way
 * to deal with system and user site URLs.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System UrlPaths class implementation.
 *
 * Provide stuff to work with system and user site URLs like
 * what is the root URL for the Humm PHP place and others.
 *
 */
class UrlPaths extends Unclonable
{
  /**
   * Define the Humm PHP script entry point file name.
   */
  const INDEX_FILE_NAME = 'index.php';

  /**
   * Root URL in which Humm PHP reside.
   *
   * @var string
   */
  private static $root = null;

  /**
   * Retrieve the root URL in which Humm PHP reside.
   *
   * We can use this method to get the root URL (which
   * corresponde with the site home) and conform other
   * site URLs from the root URL.
   *
   * @static
   * @return string Root URL for the Humm copy.
   */
  public static function root()
  {
    if (self::$root === null) {
      self::$root = ServerInfo::url().
      \str_replace
      (
        self::INDEX_FILE_NAME,
        StrUtils::EMPTY_STRING,
        ServerInfo::script()
      );
    }
    return self::$root;
  }

  /**
   * Retrieve the current request URL.
   *
   * @static
   * @return string Current request URL.
   */
  public static function current()
  {
    return ServerInfo::url().ServerInfo::uri();
  }

  /**
   * Get an absolute Humm PHP URL from a relative path.
   *
   * @static
   * @param string $relativePath URL path to be appended to the root URL.
   * @param string $end URL part to be appended to the final URL.
   * @return string Absolute URL pointing to the provided path.
   */
  public static function path($relativePath)
  {
    return self::root().$relativePath;
  }

  /**
   * Retrieve the URL for the system directory.
   *
   * @return string URL for the system directory.
   */
  public static function system()
  {
    return self::path(DirNames::HUMM_DIR_NAME.StrUtils::URL_SEPARATOR.
            DirNames::SYSTEM_DIR_NAME.StrUtils::URL_SEPARATOR);
  }

  /**
   * Retrieve the URL for the system config directory.
   *
   * @return string URL for the system config directory.
   */
  public static function systemConfig()
  {
    return self::system().
            DirNames::CONFIG_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system locale directory.
   *
   * @return string URL for the system locale directory.
   */
  public static function systemLocale()
  {
    return self::system().
            DirNames::LOCALE_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system classes directory.
   *
   * @return string URL for the system classes directory.
   */
  public static function systemClasses()
  {
    return self::system().
            DirNames::CLASSES_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system version directory.
   *
   * @return string URL for the system version directory.
   */
  public static function systemVersion()
  {
    return self::system().
            DirNames::VERSION_DIR_NAME_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system procedural directory.
   *
   * @return string URL for the system procedural directory.
   */
  public static function systemProcedural()
  {
    return self::system().
            DirNames::PROCEDURAL_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system views directory.
   *
   * @return string URL for the system views directory.
   */
  public static function systemViews()
  {
    return self::system().DirNames::VIEWS_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system views files directory.
   *
   * @return string URL for the system views files directory.
   */
  public static function systemViewsFiles()
  {
    return self::systemViews().
            DirNames::VIEWS_FILES_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system views helpers directory.
   *
   * @return string URL for the system views helpers directory.
   */
  public static function systemViewsHelpers()
  {
    return self::systemViews().
            DirNames::VIEWS_HELPERS_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system views images directory.
   *
   * @return string URL for the system views images directory.
   */
  public static function systemViewsImages()
  {
    return self::systemViews().
            DirNames::VIEWS_IMAGES_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system views styles directory.
   *
   * @return string URL for the system views styles directory.
   */
  public static function systemViewsStyles()
  {
    return self::systemViews().
            DirNames::VIEWS_STYLES_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the system views scripts directory.
   *
   * @return string URL for the system views scripts directory.
   */
  public static function systemViewsScripts()
  {
    return self::systemViews().
            DirNames::VIEWS_SCRIPTS_DIR_NAME.StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the URL for the site classes directory.
   *
   * @return string URL for the site classes directory.
   */
  public static function siteClasses()
  {
    return self::path(UserSites::classesUrlPath());
  }

  /**
   * Retrieve the URL for the site procedural directory.
   *
   * @return string URL for the site procedural directory.
   */
  public static function siteProcedural()
  {
    return self::path(UserSites::proceduralUrlPath());
  }

  /**
   * Retrieve the URL for the site config directory.
   *
   * @return string URL for the site config directory.
   */
  public static function siteConfig()
  {
    return self::path(UserSites::configUrlPath());
  }

  /**
   * Retrieve the URL for the site views directory.
   *
   * @return string URL for the site views directory.
   */
  public static function siteViews()
  {
    return self::path(UserSites::viewsUrlPath());
  }

  /**
   * Retrieve the URL for the site views files directory.
   *
   * @return string URL for the site views files directory.
   */
  public static function siteViewsFiles()
  {
    return self::path(UserSites::viewsFilesUrlPath());
  }

  /**
   * Retrieve the URL for the site views images directory.
   *
   * @return string URL for the site views images directory.
   */
  public static function siteViewsImages()
  {
    return self::path(UserSites::viewsImagesUrlPath());
  }

  /**
   * Retrieve the URL for the site views styles directory.
   *
   * @return string URL for the site views styles directory.
   */
  public static function siteViewsStyles()
  {
    return self::path(UserSites::viewsStylesUrlPath());
  }

  /**
   * Retrieve the URL for the site views scripts directory.
   *
   * @return string URL for the site views scripts directory.
   */
  public static function siteViewsScripts()
  {
    return self::path(UserSites::viewsScriptsUrlPath());
  }
}
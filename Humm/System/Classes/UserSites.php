<?php

/**
 * This file implement the UserSites system class.
 *
 * This class made possible the Humm PHP multisites
 * support, discovering and preparing the appropiate
 * information about the site currently used.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System UserSites class implementation.
 *
 * Altough this class is mainly for internal use by other
 * Humm PHP system classes, contain public methos which may
 * can be useful too for site classes, views and plugins.
 */
class UserSites extends Unclonable
{
  /**
   * Define the Humm PHP main site directory name.
   */
  const MAIN_SITE_DIR = 'Main';

  /**
   * Define an specific view class of the current site.
   */
  const VIEW_CLASS = 'Humm\Sites\%s\Classes\%s%s';

  /**
   * Define the optional site shared view class.
   */
  const SHARED_VIEW_CLASS = 'Humm\Sites\%s\Classes\SharedView';

  /**
   * Define the current site views URL relative path.
   */
  const VIEWS_URL_PATH = 'Humm/Sites/%s/Views/';

  /**
   * Define the current site views files URL relative path.
   */
  const VIEWS_FILES_URL_PATH = 'Humm/Sites/%s/Views/Files/';

  /**
   * Define the current site views images URL relative path.
   */
  const VIEWS_IMAGES_URL_PATH = 'Humm/Sites/%s/Views/Images/';

  /**
   * Define the current site views styles URL relative path.
   */
  const VIEWS_STYLES_URL_PATH = 'Humm/Sites/%s/Views/Styles/';

  /**
   * Define the current site views scripts URL relative path.
   */
  const VIEWS_SCRIPTS_URL_PATH = 'Humm/Sites/%s/Views/Scripts/';

  /**
   * Define the current site procedural directory URL relative path.
   */
  const PROCEDURAL_URL_PATH = 'Humm/Sites/%s/Procedural/';

  /**
   * Define the current site classes directory URL relative path.
   */
  const CLASSES_URL_PATH = 'Humm/Sites/%s/Classes/';

  /**
   * Define the current site config directory URL relative path.
   */
  const CONFIG_URL_PATH = 'Humm/Sites/%s/Config/';

  /**
   * Define the current site locale directory URL relative path.
   */
  const LOCALE_URL_PATH = 'Humm/Sites/%s/Locale/';

  /**
   * Store the current site directory name.
   *
   * @var string
   */
  private static $dirName = null;

  /**
   * Initialize some class members.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      self::$dirName = self::siteDirFromUrl();
      if (!self::siteDirExists(self::$dirName)) {
        self::$dirName = self::MAIN_SITE_DIR;
      }
    }
  }

  /**
   * Retrieve the current site directory name.
   *
   * @static
   * @return string Current site directory name.
   */
  public static function siteDirName()
  {
    return self::$dirName;
  }

  /**
   * Retrieve the current site config directory URL relative path.
   *
   * @static
   * @return string Current site config directory URL relative path.
   */
  public static function configUrlPath()
  {
    return \sprintf(self::CONFIG_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve the current site locale directory URL relative path.
   *
   * @static
   * @return string Current site locale directory URL relative path.
   */
  public static function localeUrlPath()
  {
    return \sprintf(self::LOCALE_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve the current site classes directory URL relative path.
   *
   * @static
   * @return string Current site classes directory URL relative path.
   */
  public static function classesUrlPath()
  {
    return \sprintf(self::CLASSES_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve the current site procedural directory URL relative path.
   *
   * @static
   * @return string Current site procedural directory URL relative path.
   */
  public static function proceduralUrlPath()
  {
    return \sprintf(self::PROCEDURAL_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve the current site views URL relative path.
   *
   * @static
   * @return string Current site views URL relative path.
   */
  public static function viewsUrlPath()
  {
    return \sprintf(self::VIEWS_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve the current site views files URL relative path.
   *
   * @static
   * @return string Current site views files URL relative path.
   */
  public static function viewsFilesUrlPath()
  {
    return \sprintf(self::VIEWS_FILES_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve the current site views images URL relative path.
   *
   * @static
   * @return string Current site views images URL relative path.
   */
  public static function viewsImagesUrlPath()
  {
    return \sprintf(self::VIEWS_IMAGES_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve the current site views styles URL relative path.
   *
   * @static
   * @return string Current site views styles URL relative path.
   */
  public static function viewsStylesUrlPath()
  {
    return \sprintf(self::VIEWS_STYLES_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve the current site views scripts URL relative path.
   *
   * @static
   * @return string Current site views scripts URL relative path.
   */
  public static function viewsScriptsUrlPath()
  {
    return \sprintf(self::VIEWS_SCRIPTS_URL_PATH, self::$dirName);
  }

  /**
   * Retrieve a current site view class name.
   *
   * @static
   * @param string $viewName Site view name.
   * @return string Current site view class name.
   */
  public static function viewClassName($viewName)
  {
    return \sprintf(self::VIEW_CLASS, self::$dirName,
            $viewName, ViewsHandler::VIEW_CLASS_SUFFIX);
  }

  /**
   * Get the optional site shared view class name.
   *
   * @static
   * @return string Optional site shared view class name.
   */
  public static function sharedViewClassName()
  {
    return \sprintf(self::SHARED_VIEW_CLASS, self::$dirName);
  }

  /**
   * Retrieve the expected user site from the server URL.
   *
   * Note this function can determine the right site directory
   * from the server URL including possible subdomains.
   *
   * For example, from an URL like this:
   *
   * http://www.mysite.com/
   *
   * The site directory are Mysite (note the capitalization convention).
   *
   * Another URL like this this:
   *
   * http://www.subdomain.mysite.com/
   *
   * The site directory are SubdomainMysite.
   *
   * @static
   * @return string The found site directory name.
   */
  private static function siteDirFromUrl()
  {
    $matches = array();
    $siteDir = StrUtils::EMPTY_STRING;
    $serverUrl = self::sanitizedServerUrl();
    \preg_match_all('#(.+)\.(.+)#', $serverUrl, $matches);
    if (isset($matches[1]) && isset($matches[1][0])) {
      foreach( \explode(StrUtils::DOT, $matches[1][0]) as $domainPart ) {
        $siteDir .= \ucfirst($domainPart);
      }
    }
    return $siteDir;
  }

  /**
   * Sanitize the server URL removing protocol and www.
   *
   * @static
   * @return string Sanitized server URL.
   */
  private static function sanitizedServerUrl()
  {
    return \str_replace
    (
      array('http://', 'https://', 'www.'),
      StrUtils::EMPTY_STRING,
      ServerInfo::url()
    );
  }

  /**
   * Find if a site directory name exists.
   *
   * @static
   * @param string $siteDirName Site directory name
   * @return boolean True if directory exists, False if not
   */
  private static function siteDirExists($siteDirName)
  {
    return !StrUtils::isTrimEmpty($siteDirName) &&
             \is_dir(DirPaths::humm().DirNames::SITES_DIR_NAME.
              \DIRECTORY_SEPARATOR.$siteDirName);
  }
}
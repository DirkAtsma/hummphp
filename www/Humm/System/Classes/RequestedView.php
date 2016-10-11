<?php

/**
 * This file implement the RequestedView system class.
 *
 * This class is the responsible to find the requested
 * site view and offer information about it.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2016 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System RequestedView class implementation.
 *
 * Just a helper to the ViewsHandler system class which find
 * the appropiate requested site view and offer information
 * and more about it.
 *
 */
class RequestedView extends Unclonable
{
  /**
   * Define the default view name for site home.
   */
  const SITE_HOME_VIEW = 'Home';

  /**
   * Define a fall out view when missing the site home view.
   */
  const SYSTEM_HOME_VIEW = 'SystemHome';

  /**
   * Store all availables views directory paths.
   *
   * @var array
   */
  private static $viewsDirs = null;

  /**
   * Get the appropiate view to be displayed.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   * @return string User requested view.
   */
  public static function getViewName(HtmlTemplate $template)
  {
    // Fallback for missing site home view
    $view = self::SYSTEM_HOME_VIEW;

    if (self::isMainView(UrlArguments::get(0)) &&
     $template->viewFileExists(UrlArguments::get(0))) {
       $view = UrlArguments::get(0);

    } else if (self::isMainView(self::SITE_HOME_VIEW) &&
     $template->viewFileExists(self::SITE_HOME_VIEW)) {
       $view = self::SITE_HOME_VIEW;
    }

    // Views file names must be capitalized by convention
    return \ucfirst($view);
  }


  /**
   * Find if a view is a main view or not.
   *
   * Main views corresponded with URL arguments. On the
   * contrary we count also with views helpers, which are
   * also views but do not corresponde with URL arguments
   * and are intended to use as views helpers.
   *
   * @static
   * @param string $viewName The view name to be checked.
   * @return boolean True if the view is a main view, False if not.
   */
  private static function isMainView($viewName)
  {
    // By convention views files must be first capitalized.
    return in_array(\ucfirst($viewName), self::getMainViewsDirs());
  }

  /**
   * Retrieve the directory paths in which views can resides.
   *
   * @static
   * @return array Directory paths for all possible main views.
   */
  private static function getMainViewsDirs()
  {
    if (self::$viewsDirs == null) {
      // Order matter here:
      // 1º Shared sites
      // 2º Site specific
      // 3º System specific
      self::$viewsDirs = \array_unique(\array_merge(
        self::getDirectoryViews(DirPaths::sitesSharedViews()),
        self::getDirectoryViews(DirPaths::siteViews()),
        self::getDirectoryViews(DirPaths::systemViews())
      ));
    }
    return self::$viewsDirs;
  }

  /**
   * Get the views files of the specified directory.
   *
   * @static
   * @param string $dirPath Directory in which views resides.
   * @return array Directory views file paths.
   */
  private static function getDirectoryViews($dirPath)
  {
    $views = array();
    if (\file_exists($dirPath)) {
      foreach (new \DirectoryIterator($dirPath) as $fileInfo) {
        if (self::isMainViewFile($fileInfo)) {
          $views[] = self::getMainViewName($fileInfo);
        }
      }
    }
    return $views;
  }

  /**
   * Find if a file can be considered a view file.
   *
   * In fact all PHP files in a views directory are
   * considered valid views, but not others like HTML
   * files or others.
   *
   * @static
   * @param SplFileInfo $fileInfo File information.
   * @return boolean True if a file is considered a view.
   */
  private static function isMainViewFile(\SplFileInfo $fileInfo)
  {
    return $fileInfo->isFile() &&
      ($fileInfo->getExtension() === FileExts::PHP);
  }

  /**
   * Extract the view name from a view file path.
   *
   * @static
   * @param SplFileInfo $fileInfo File information.
   * @return string View name.
   */
  private static function getMainViewName(\SplFileInfo $fileInfo)
  {
    return \str_replace(
      FileExts::DOT_PHP,
      StrUtils::EMPTY_STRING,
      $fileInfo->getBasename()
    );
  }
}

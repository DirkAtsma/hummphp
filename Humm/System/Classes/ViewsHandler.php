<?php

/**
 * This file implement the ViewsHandler system class.
 *
 * This class is the responsible to looking for the user request
 * and finally to provide the appropiate user response.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System ViewsHandler class implementation.
 *
 * Part of the system boot strap this system class looking
 * for the appropiate view to be shown to user in response
 * to their request. This class do not contain useful stuff
 * from the user site point of view.
 *
 */
class ViewsHandler extends Unclonable
{
  /**
   * Define the default view name for site home.
   */
  const SITE_HOME_VIEW = 'Home';

  /**
   * Define the suffix which use all HummView classes.
   */
  const VIEW_CLASS_SUFFIX = 'View';

  /**
   * Define a fall out view when missing the site home view.
   */
  const SYSTEM_HOME_VIEW = 'SystemHome';

  /**
   * Define the base class which all other views must inherit from.
   */
  const HUMM_VIEW_BASE_CLASS = 'HummView';

  /**
   * Define the system classes PHP namespace.
   */
  const SYSTEM_CLASS_NAMESPACE = 'Humm\System\Classes\\';

  /**
   * Define the sites shared classes PHP namespace.
   */
  const SITES_SHARED_CLASS_NAMESPACE = 'Humm\Sites\Shared\Classes\\';

  /**
   * Store all availables views directory paths.
   *
   * @var array
   */
  private static $viewsDirs = null;

  /**
   * Start the output buffer and display the requested view.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      self::startBuffer();
      self::displayView();
    }
  }

  /**
   * Start the output buffer and filter it by plugins.
   *
   * @static
   */
  private static function startBuffer()
  {
    \ob_start(function($buffer) {
      return HummPlugins::applySimpleFilter(
        PluginFilters::BUFFER_OUTPUT, $buffer);
    });
  }

  /**
   * Display the requested view to the user.
   *
   * @static
   */
  private static function displayView()
  {
    $template = new HtmlTemplate();
    self::setViewTemplatePaths($template);
    self::setDefaultTemplateVars($template);
    self::setOptionalSiteSharedView($template);
    $viewName = self::getRequestedView($template);
    self::setTemplateViewVars($template, $viewName);
    self::filterTemplate($template);
    self::addPluginsViews($template);
    $template->displayView($viewName);
  }

  /**
   * Set the appropiate view to be displayed.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   * @return string User requested view.
   */
  private static function getRequestedView(HtmlTemplate $template)
  {
    // Fallback for non home site views
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
   * Put the current view and view class into the template.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   * @param string $viewName Current view name.
   */
  private static function setTemplateViewVars(
   HtmlTemplate $template, $viewName)
  {
    $template->viewName = $viewName;
    $template->viewClass = self::getViewClassInstance($viewName, $template);
  }

  /**
   * Set the default view variables.
   *
   * The default variables offers easy access for useful stuff
   * like site URLs, URL arguments, current language, etc.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  private static function setDefaultTemplateVars(HtmlTemplate $template)
  {
    self::setDefaultSiteTemplateVars($template);
    self::setDefaultSystemTemplateVars($template);
  }

  /**
   * Set the default site view variables.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  private static function setDefaultSiteTemplateVars(HtmlTemplate $template)
  {
    // Previous views code will fail if this variables are renamed
    $template->hummVersion = \HUMM_VERSION_STRING;
    $template->hummRelease = \HUMM_VERSION_RELEASE;

    $template->requestUri = UrlPaths::current();
    $template->siteLanguage = Languages::getCurrentLanguage();
    $template->siteLanguages = Languages::getLanguages();
    $template->siteLanguageDir = Languages::getLanguageDirection();

    $template->siteUrl = UrlPaths::root();
    $template->viewsUrl = UrlPaths::siteViews();
    $template->viewsFilesUrl = UrlPaths::siteViewsFiles();
    $template->viewsImagesUrl = UrlPaths::siteViewsImages();
    $template->viewsStylesUrl = UrlPaths::siteViewsStyles();
    $template->viewsScriptsUrl = UrlPaths::siteViewsScripts();

    $template->sharedViewsUrl = UrlPaths::sitesSharedViews();
    $template->sharedViewsFilesUrl = UrlPaths::sitesSharedViewsFiles();
    $template->sharedViewsImagesUrl = UrlPaths::sitesSharedViewsImages();
    $template->sharedViewsStylesUrl = UrlPaths::sitesSharedViewsStyles();
    $template->sharedViewsScriptsUrl = UrlPaths::sitesSharedViewsScripts();
  }

  /**
   * Set the default system view variables.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  private static function setDefaultSystemTemplateVars(HtmlTemplate $template)
  {
    // Used by the system Home view
    $template->systemViewsUrl = UrlPaths::systemViews();
    $template->systemViewsImagesUrl = UrlPaths::systemViewsImages();
    $template->systemViewsStylesUrl = UrlPaths::systemViewsStyles();
    $template->systemViewsScriptsUrl = UrlPaths::systemViewsScripts();
  }

  /**
   * Set the directory paths in which views resides.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  private static function setViewTemplatePaths(HtmlTemplate $template)
  {
    $template->addViewsDirPaths(array(
      // Order matter here
      DirPaths::sitesSharedViews(),
      DirPaths::sitesSharedViewsHelpers(),
      DirPaths::siteViews(),
      DirPaths::siteViewsHelpers(),
      DirPaths::systemViews(),
      DirPaths::systemViewsHelpers()
    ));
  }

  /**
   * Let the plugins to filter the view HTML template.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  private static function filterTemplate(HtmlTemplate $template)
  {
    HummPlugins::applySimpleFilter(
     PluginFilters::VIEW_TEMPLATE, $template);
  }

  /**
   * Add plugins directories to the template paths.
   *
   * In fac we add the plugins views and helpers directories to the
   * template pahts, so the views and helpers stored in these directories
   * are automatically available to use in the site template.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  private static function addPluginsViews(HtmlTemplate $template)
  {
    foreach (HummPlugins::getPlugins() as $plugin) {
      $template->addViewsDirPath($plugin->viewsDir());
      $template->addViewsDirPath($plugin->viewsHelpersDir());
    }
  }

  /**
   * Get the optional view associated class.
   *
   * Views associated classes are optional but useful in order
   * to intereact with the view HTML template adding variables.
   *
   * System and also user sites can put availables views classes
   * by placing a class with the appropiate name into the system
   * or sites classes directories.
   *
   * All views associated classes must be named using the view
   * name (capitalized) and the "View" preffix. For example, the
   * view class which a Home view can implement must be named "HomeView",
   * the class for a possible "Contact" view can be "ContactView", etc.
   *
   * Also all the views associated classes must derive from the
   * system "HummView" class in order to be considered valid.
   *
   * @static
   * @param string $viewName View name to retrieve their associate class.
   * @param HtmlTemplate $template Reference to an HTML template object.
   * @return HummView
   */
  private static function getViewClassInstance(
   $viewName, HtmlTemplate $template)
  {
    $result = null;

    $sharedClass = self::SITES_SHARED_CLASS_NAMESPACE.
                    $viewName.self::VIEW_CLASS_SUFFIX;

    $siteClass = UserSites::viewClassName($viewName);

    $systemClass = self::SYSTEM_CLASS_NAMESPACE.
                    $viewName.self::VIEW_CLASS_SUFFIX;

    // Order matter here
    if (self::isValidViewClass($sharedClass)) {
      $result = new $sharedClass($template);
    } else if (self::isValidViewClass($siteClass)) {
      $result = new $siteClass($template);
    } else if (self::isValidViewClass($systemClass)) {
      $result = new $systemClass($template);
    }

    return $result;
  }

  /**
   * Setup the optional site shared view class.
   *
   * Every site can have a shared site view class, mainly in order
   * to setup the template with variables shared across views.
   *
   * @static
   * @param HtmlTemplate $template Reference to an HTML template object.
   */
  private static function setOptionalSiteSharedView(HtmlTemplate $template)
  {
    $class = UserSites::sharedViewClassName();
    if (self::isValidViewClass($class)) {
      $template->sharedView = new $class($template);
    }
  }

  /**
   * Determine if a class is a valid view class.
   *
   * @static
   * @param string $className Class name to check.
   * @return boolean True if class is a valid view class, False if not
   */
  private static function isValidViewClass($className)
  {
    return self::viewClassExists($className) &&
      self::isValidViewSubclass($className);
  }

  /**
   * Find if the specified view class exists.
   *
   * @static
   * @param string $viewClass Class name to be checked.
   * @return boolean True if the class exists, False if not.
   */
  private static function viewClassExists($viewClass)
  {
    $expectedPath = \str_replace(
      StrUtils::PHP_NS_SEPARATOR,
      \DIRECTORY_SEPARATOR,
      $viewClass
    ).FileExts::DOT_PHP;

    return \file_exists($expectedPath) &&
            \class_exists($viewClass);
  }

  /**
   * Find if a class is derived from the views base class.
   *
   * @static
   * @param string $className Class name to be checked.
   * @return boolean True if the class parent is a HummView, False if not.
   */
  private static function isValidViewSubclass($className)
  {
    return \is_subclass_of($className, __NAMESPACE__.
     StrUtils::PHP_NS_SEPARATOR.self::HUMM_VIEW_BASE_CLASS);
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
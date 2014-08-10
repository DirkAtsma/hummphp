<?php

/**
 * This file implement the HummPlugins system class.
 *
 * This is the system and site plugins manager class,
 * which is responsible to load the plugins and execute
 * the available plugin actions and filters.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System HummPlugins class implementation.
 *
 * Manage the available plugins and provide useful
 * methods to execute actions, filters and more.
 */
class HummPlugins extends Unclonable
{
  /**
   * Define the output buffer plugin filter ID.
   *
   * This filter is executed from OutputBuffer::filter()
   * and provide as the filter content with the response
   * buffer to be filtered before sent to the user.
   *
   * A plugin cannot print anything under this filter
   * execution, but can filter the content or do other
   * taks but never print anything.
   *
   * Like in any other filter, the plugin must return
   * theh filter arguments content, filtered or not, in
   * order to maintain the chain.
   */
  const FILTER_OUTPUT_BUFFER = 1001;

  /**
   * Define the view template plugin filter ID.
   *
   * Executed from ViewsHandler::filterTemplate() this
   * filter provide as the filter content with an HtmlTemplate
   * object instance which can be filtered.
   *
   * This means that the plugin can update or setup
   * new HtmlTemplate variables to put it availables into
   * the HtmlTemplate associated view.
   *
   * Like in any other filter, the plugin must return
   * theh filter arguments content, filtered or not, in
   * order to maintain the chain.
   */
  const FILTER_VIEW_TEMPLATE = 1002;

  /**
   * Define the database SQL plugin filter ID.
   *
   * Executed from PDOExtended::translateSQL() this filter
   * provide as the filter content with an SQL statement just
   * before are executed agains the database.
   *
   * This means that the plugin can filter the SQL statement
   * in some way, although this filter is mainly intended to
   * provide a way to translate SQL statements into specific
   * database drivers statements.
   *
   * Like in any other filter, the plugin must return
   * theh filter arguments content, filtered or not, in
   * order to maintain the chain.
   */
  const FILTER_DATABASE_SQL = 10003;

  /**
   * Define the plugins loaded plugin action ID.
   *
   * Executed from HummPlugins::loadPlugins() (this class)
   * this action tell the plugins that all the available
   * plugins has been loaded.
   *
   * A plugin can use this action to make some needed taks
   * which are doing in an early system boot strap state,
   * before the output buffer are started.
   */
  const ACTION_PLUGINS_LOADED = 2001;

  /**
   * Define the script shutdown plugin action ID.
   *
   * Executed from ErrorHandler::onShutdown() this action
   * inform the plugins when the PHP script shutdown occur,
   * after the appropiate user response are sent.
   *
   * A plugin can use this action to make some needed taks
   * which are doing in an final system boot strap state,
   * after the output buffer has been flush.
   */
  const ACTION_SCRIPT_SHUTDOWN = 2002;

  /**
   * Define the check requeriments plugin action ID.
   *
   * Executed from Requeriments::pluginsCheck() this action
   * allows the plugins to check their own requriments and
   * trigger an error if the requeriments are not supplied.
   *
   * The plugins can react to this action calling one or more
   * times the PHP \trigger_error() function providing the
   * appropiate check requeriments errors information:
   *
   * Do not print anything to the buffer output: just use the
   * \trigger_error() action and let the system to inform the
   * user about the plugin check requeriments errors.
   *
   */
  const ACTION_CHECK_REQUERIMENTS = 2003;

  /**
   * Define the connected database plugin action ID.
   *
   * Executed from Requeriments::pluginsCheck() this action
   * allows the plugins to check their own requriments and
   * trigger an error if the requeriments are not supplied.
   *
   * The plugins can react to this action calling one or more
   * times the PHP \trigger_error() function providing the
   * appropiate check requeriments errors information:
   *
   * Do not print anything to the buffer output: just use the
   * \trigger_error() action and let the system to inform the
   * user about the plugin check requeriments errors.
   *
   */
  const ACTION_CONNECTED_DATABASE = 2004;

  /**
   * Define the plugins lower priority.
   */
  const PLUGIN_PRIORITY_LOWER = 3001;

  /**
   * Define the plugins low priority.
   */
  const PLUGIN_PRIORITY_LOW = 3002;

  /**
   * Define the plugins normal priority.
   */
  const PLUGIN_PRIORITY_NORMAL = 3003;

  /**
   * Define the plugins higher priority.
   */
  const PLUGIN_PRIORITY_HIGHER = 3004;

  /**
   * Define the plugins highest priority.
   */
  const PLUGIN_PRIORITY_HIGHEST = 3005;

  /**
   * Define the plugins critical priority.
   */
  const PLUGIN_PRIORITY_CRITICAL = 3006;

  /**
   * Define the plugins base class name.
   */
  const PLUGIN_BASE_CLASS = 'HummPlugin';

  /**
   * Define the plugins execute action method.
   */
  const PLUGIN_EXEC_ACTION = 'execAction';

  /**
   * Define the plugins apply filter method.
   */
  const PLUGIN_APPLY_FILTER = 'applyFilter';

  /**
   * Define the plugins get priority method.
   */
  const PLUGIN_GET_PRIORITY = 'getPriority';

  /**
   * Define the active plugins separator.
   */
  const ACTIVE_PLUGINS_SEPARATOR = ',';

  /**
   * List of HummPlugin objects.
   *
   * @var array
   */
  private static $plugins = array();

  /**
   * Load the available system and site plugins.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      if (!StrUtils::isTrimEmpty(\HUMM_ACTIVE_PLUGINS)) {
        self::loadPlugins();
      }
    }
  }

  /**
   * Retrieve the loaded plugins as HummPlugin class objects.
   *
   * @static
   * @return array Loaded HummPlugin class objects.
   */
  public static function getPlugins()
  {
    return self::$plugins;
  }

  /**
   * Apply a simple filter over the plugins.
   *
   * A simple filter is a filter which is composed only
   * with a filter ID and their content. So instead create
   * the appropiate FilterArguments object and prepare it,
   * let this method to apply simple filters like that.
   *
   * @static
   * @param int $filterID Filter ID to be applied.
   * @param mixed $content Content to be filter it.
   * @return mixed Filtered or untouched filter argument content.
   */
  public static function applySimpleFilter($filterID, $content)
  {
    return self::applyFilter(new FilterArguments(array
    (
      FilterArguments::FILTER =>  $filterID,
      FilterArguments::CONTENT => $content
    )));
  }

  /**
   * Execute a simple action over the plugins.
   *
   * A simple action is an action which is composed only
   * by their ID and do not need any other argument. So instead
   * create the appropiate ActionArguments object and prepare it,
   * let this method to execute simple actions like that.
   *
   * @static
   * @param int $actionID Action ID to be called.
   */
  public static function execSimpleAction($actionID)
  {
    HummPlugins::execAction(new ActionArguments(array
    (
      ActionArguments::ACTION => $actionID
    )));
  }

  /**
   * Apply certain filter over the plugins.
   *
   * The contents to be filter are always stored into the
   * $arguments->content property. We pass to the plugin this
   * value in order to be filtered and always return such value
   * filtered or untouched.
   *
   * The value of the filter content depend of the filter and in
   * fact are a mixed value: an string, an array, and object, etc.
   *
   * @static
   * @param FilterArguments $arguments Plugin filter arguments.
   * @return mixed Filtered or untouched filter argument content.
   */
  public static function applyFilter(FilterArguments $arguments)
  {
    foreach (self::$plugins as $plugin) {
      if (\method_exists($plugin, self::PLUGIN_APPLY_FILTER)) {
        $arguments->content = \call_user_func
        (
          array($plugin, self::PLUGIN_APPLY_FILTER),
          $arguments
        );
      }
    }
    return $arguments->content;
  }

  /**
   * Execute certain action over the plugins.
   *
   * Thanks to this method we can tell the plugins about various
   * system actions in the way that the plugins can react and do
   * some tasks when the appropiate action occur.
   *
   * @static
   * @param ActionArguments $arguments Plugin action arguments.
   */
  public static function execAction(ActionArguments $arguments)
  {
    foreach (self::$plugins as $plugin) {
      if (\method_exists($plugin, self::PLUGIN_EXEC_ACTION)) {
        \call_user_func
        (
          array($plugin, self::PLUGIN_EXEC_ACTION),
          $arguments
        );
      }
    }
  }

  /**
   * Load and instantiate all available plugins.
   *
   * @static
   */
  private static function loadPlugins()
  {
    foreach (self::getPluginDirs() as $pluginDir) {
      $pluginClass = self::getPluginClass($pluginDir);
      if (self::isValidPluginClass($pluginClass)) {
        self::$plugins[] = new $pluginClass;
      }
    }
    // Notify the plugins
    self::execSimpleAction(self::ACTION_PLUGINS_LOADED);
  }

  /**
   * Retrieve all paths in which plugins can reside.
   *
   * @static
   * @return array Plugins directories paths.
   */
  private static function getPluginDirs()
  {
    $result = array();
    $pluginsDir = DirPaths::plugins();
    if (\file_exists($pluginsDir)) {
      foreach (new \DirectoryIterator($pluginsDir) as $fileInfo) {
        if (self::pluginIsActive($fileInfo) &&
         self::pluginFileExists($fileInfo)) {
           $result[] = $fileInfo->getPathName();
        }
      }
    }
    return $result;
  }

  /**
   * Find if a plugin is currently active or not.
   *
   * @static
   * @param SplFileInfo $fileInfo Object with file information.
   * @return boolean True if the plugin is active, False if not.
   */
  private static function pluginIsActive(\SplFileInfo $fileInfo)
  {
    return \in_array
    (
      $fileInfo->getBasename(),
      \explode(self::ACTIVE_PLUGINS_SEPARATOR, \HUMM_ACTIVE_PLUGINS)
    );
  }

  /**
   * Find if the specified file info have an existing plugin file.
   *
   * @static
   * @param SplFileInfo $fileInfo Object with file information.
   * @return boolean True if the plugin file exists, False if not.
   */
  private static function pluginFileExists(\SplFileInfo $fileInfo)
  {
    return !$fileInfo->isDot() && $fileInfo->isDir() && \file_exists
    (
      $fileInfo->getPathName().
      \DIRECTORY_SEPARATOR.
      $fileInfo->getBasename().
      FileExts::PHP_FILE_DOT_EXT
    );
  }

  /**
   * Retrieve the appropiate plugin class from their directory.
   *
   * @static
   * @param string $pluginDir Plugin directory path.
   * @return string Plugin class name.
   */
  private static function getPluginClass($pluginDir)
  {
    return \str_replace
    (
      array(DirPaths::root(), \DIRECTORY_SEPARATOR),
      array(StrUtils::EMPTY_STRING, StrUtils::PHP_NS_SEPARATOR),
      $pluginDir
    ).StrUtils::PHP_NS_SEPARATOR.\basename($pluginDir);
  }

  /**
   * Find if the specified class name is a valid plugin class.
   *
   * @static
   * @param string $className Plugin class name to be validated.
   * @return boolean True if the plugin class is valid, False if not.
   */
  private static function isValidPluginClass($className)
  {
    return \get_parent_class($className) ===
     __NAMESPACE__.StrUtils::PHP_NS_SEPARATOR.
      self::PLUGIN_BASE_CLASS;
  }
}
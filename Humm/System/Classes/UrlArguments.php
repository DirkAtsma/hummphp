<?php

/**
 * This file implement the UrlArguments system class.
 *
 * This class extract from the current URL the user request
 * arguments in order to provide the right response.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System UrlArguments class implementation.
 *
 * Humm PHP do not use any MOD REWRITE module, since
 * is desined to be completely server independent.
 *
 * However Humm PHP offers to the users friendly URLs
 * using arguments from the user request URL.
 *
 * Here are samples of Humm PHP managed sites URLs:
 *
 * http://www.yoursite.com/
 *
 * This URL have no arguments and therefore the
 * system shown to the user the default Home view.
 *
 * http://www.yoursite.com/?contact
 *
 * The above URL contain one argument from the system
 * point of view. The argument is "contact" and then
 * the system looking for a view named "Contact", and,
 * if found, display it to the user.
 *
 * http://www.yoursite.com/?search/page/10
 *
 * The above URL contains three arguments from the system
 * point of view. The first argument always determine the
 * view to shown the user so in this case the system try
 * to prepare a "Search" view to be displayed.
 *
 * The URL contains also two more arguments: "page" and
 * "10", which can therefore used by the "Search" view and
 * more propertly in the associated view class in order to
 * provide the right response to that URL request.
 *
 */
class UrlArguments extends Unclonable
{
  /**
   * Define the chars to be trimmed from the current URI.
   */
  const URI_TRIMMING_CHARS = '?/';

  /**
   * Request URL arguments.
   *
   * @var array
   */
  private static $arguments = null;

  /**
   * Parse the current URI to extract the arguments.
   *
   * @static
   * @staticvar int $init Prevent twice execution.
   */
  public static function init()
  {
    static $init = 0;
    if (!$init) {
      $init = 1;
      self::$arguments = array();
      $uri = self::uriSanitized();
      if (!StrUtils::isEmpty($uri)) {
        self::$arguments = \explode(
         StrUtils::URL_SEPARATOR, $uri);
      }
    }
  }

  /**
   * Retrieve the total arguments count.
   *
   * @static
   * @return int Arguments count.
   */
  public static function count()
  {
    return \count(self::$arguments);
  }

  /**
   * Retrieve all the arguments list.
   *
   * @static
   * @return array List of arguments.
   */
  public static function getAll()
  {
    return self::$arguments;
  }

  /**
   * Get an specific argument by their index.
   *
   * @static
   * @param int $index Argument index to be retrieved.
   * @return string URL argument or null if not found.
   */
  public static function get($index)
  {
    $result = null;
    if (isset(self::$arguments[$index])) {
      $result = self::$arguments[$index];
    }
    return $result;
  }

  /**
   * Sanitize the current URI for easy arguments extraction.
   *
   * @static
   * @return string Current URI well sanitized.
   */
  private static function uriSanitized()
  {
    return \trim
    (
      \str_replace
      (
        \basename(DirPaths::root()),
        StrUtils::EMPTY_STRING,
        ServerInfo::uri()
      ),
      self::URI_TRIMMING_CHARS
    );
  }
}
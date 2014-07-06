<?php

/**
 * This file implement the StrUtils system class.
 *
 * This class is intended to encapsulate string utils stuff
 * like constants and methods for string manipulation.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System OutputBuffer class implementation.
 *
 * This system class can be used both in system and
 * user sites for string manipulation.
 *
 */
class StrUtils extends Unclonable
{
  /**
   * Define a dot.
   */
  const DOT = '.';

  /**
   * Define an empty string.
   */
  const EMPTY_STRING = '';

  /**
   * Define an URL separator.
   */
  const URL_SEPARATOR = '/';

  /**
   * Define a PHP namespace separator.
   */
  const PHP_NAMESPACE_SEPARATOR = '\\';

  /**
   * Find if the specified string is empty.
   *
   * @static
   * @param string $string String to be evaluated.
   * @return boolean True if string is empty, False if not.
   */
  public static function isEmpty($string)
  {
    return \trim($string) === self::EMPTY_STRING;
  }
}
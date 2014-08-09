<?php

/**
 * This file implement the FileExts system class.
 *
 * Humm PHP use this class to define not localizables,
 * case sensitive file extensions of Humm PHP.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System FileExts class implementation.
 *
 * Define certain not localizables, case sensitive of the
 * sytem and also the user sites file extensions.
 */
class FileExts extends Unclonable
{
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
}
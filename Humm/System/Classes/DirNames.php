<?php

/**
 * This file implement the DirNames system class.
 *
 * Humm PHP use this class to define not localizables,
 * case sensitive directory names of Humm PHP.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System DirNames class implementation.
 *
 * Define certain not localizables, case sensitive
 * sytem and user sites directory names.
 */
class DirNames extends Unclonable
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
   * Define the system classes name.
   */
  const CLASSES_DIR_NAME = 'Classes';

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
}
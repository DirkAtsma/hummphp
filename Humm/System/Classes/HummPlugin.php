<?php

/**
 * This file implement the HummPlugin system class.
 *
 * Every system or site plugin class must derived from
 * this in order to be considerer a valid Humm PHP plugin.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System HummPlugin class implementation.
 *
 * This is the base class for Humm PHP plugins and contain
 * useful methods to be use by inherited classes.
 *
 * @abstract
 */
abstract class HummPlugin extends BaseClass
{
  /**
   * Construct an HummPlugin object.
   *
   */
  public function __construct()
  {
    // Automatically load plugin text domains
    Languages::loadTextDomain(
      FilePaths::pluginTextDomain($this->getClassDirPath())
    );
  }

  /**
   * Get the priority of a plugin.
   *
   * This method is intented to be overwriten in child classes
   * but we implement here to provide a default priority.
   *
   * @todo Plugins priority are not yet implemented
   * @return int The plugin priority.
   */
  public function getPriority()
  {
    return HummPlugins::PLUGIN_PRIORITY_LOWER;
  }

  /**
   * Retrieve the plugin directory URL.
   *
   * @return string Plugin directory URL.
   */
  public function pluginDirUrl()
  {
    return $this->getClassDirUrl();
  }

  /**
   * Retrieve the plugin directory path.
   *
   * @return string Plugin directory path.
   */
  public function pluginDirPath()
  {
    return $this->getClassDirPath();
  }

  /**
   * Retrieve the plugin views directory URL.
   *
   * @return string Plugin views directory URL.
   */
  public function pluginViewsDirUrl()
  {
    return $this->pluginDirUrl().
           DirNames::VIEWS_DIR_NAME.
           StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the plugin views directory path.
   *
   * @return string Plugin views directory path.
   */
  public function pluginViewsDirPath()
  {
    return $this->pluginDirPath().
           DirNames::VIEWS_DIR_NAME.
           \DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the plugin views files directory URL.
   *
   * @return string Plugin views files directory URL.
   */
  public function pluginViewsFilesDirUrl()
  {
    return $this->pluginViewsDirUrl().
           DirNames::VIEWS_FILES_DIR_NAME.
           StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the plugin views files directory path.
   *
   * @return string Plugin views files directory path.
   */
  public function pluginViewsFilesDirPath()
  {
    return $this->pluginViewsDirPath().
           DirNames::VIEWS_FILES_DIR_NAME.
           \DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the plugin views helpers directory URL.
   *
   * @return string Plugin views helpers directory URL.
   */
  public function pluginViewsHelpersDirUrl()
  {
    return $this->pluginViewsDirUrl().
           DirNames::VIEWS_HELPERS_DIR_NAME.
           StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the plugin views helpers directory path.
   *
   * @return string Plugin views helpers directory path.
   */
  public function pluginViewsHelpersDirPath()
  {
    return $this->pluginViewsDirPath().
           DirNames::VIEWS_HELPERS_DIR_NAME.
           \DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the plugin views styles directory URL.
   *
   * @return string Plugin views styles directory URL.
   */
  public function pluginViewsStylesDirUrl()
  {
    return $this->pluginViewsDirUrl().
           DirNames::VIEWS_STYLES_DIR_NAME.
           StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the plugin views styles directory path.
   *
   * @return string Plugin views styles directory path.
   */
  public function pluginViewsStylesDirPath()
  {
    return $this->pluginViewsDirPath().
           DirNames::VIEWS_STYLES_DIR_NAME.
           \DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the plugin views images directory URL.
   *
   * @return string Plugin views images directory URL.
   */
  public function pluginViewsImagesDirUrl()
  {
    return $this->pluginViewsDirUrl().
           DirNames::VIEWS_IMAGES_DIR_NAME.
           StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the plugin views images directory path.
   *
   * @return string Plugin views images directory path.
   */
  public function pluginViewsImagesDirPath()
  {
    return $this->pluginViewsDirPath().
           DirNames::VIEWS_IMAGES_DIR_NAME.
           \DIRECTORY_SEPARATOR;
  }

  /**
   * Retrieve the plugin views scripts directory URL.
   *
   * @return string Plugin views scripts directory URL.
   */
  public function pluginViewsScriptsDirUrl()
  {
    return $this->pluginViewsDirUrl().
           DirNames::VIEWS_SCRIPTS_DIR_NAME.
           StrUtils::URL_SEPARATOR;
  }

  /**
   * Retrieve the plugin views scripts directory path.
   *
   * @return string Plugin views scripts directory path.
   */
  public function pluginViewsScriptsDirPath()
  {
    return $this->pluginViewsDirPath().
           DirNames::VIEWS_SCRIPTS_DIR_NAME.
           \DIRECTORY_SEPARATOR;
  }
}
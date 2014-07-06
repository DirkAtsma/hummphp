<?php

/**
 * This file implement the Humm plugin Sample.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\Plugins\Sample;

use
  \Humm\System\Classes\HummPlugin,
  \Humm\System\Classes\HummPlugins,
  \Humm\System\Classes\FilterArguments,
  \Humm\System\Classes\ActionArguments;

class Sample extends HummPlugin
{
  public function execAction(ActionArguments $arguments)
  {
    switch ($arguments->action) {
      case HummPlugins::ACTION_PLUGINS_LOADED:
        break;
      case HummPlugins::ACTION_CHECK_REQUERIMENTS:
        break;
      case HummPlugins::ACTION_CONNECTED_DATABASE:
        break;
      case HummPlugins::ACTION_SCRIPT_SHUTDOWN:
        break;
    }
  }

  public function applyFilter(FilterArguments $arguments)
  {
    switch ($arguments->filter) {
      case HummPlugins::FILTER_DATABASE_SQL:
        break;
      case HummPlugins::FILTER_VIEW_TEMPLATE:
        break;
      case HummPlugins::FILTER_OUTPUT_BUFFER:
        break;
    }
    // Filtered or not
    return $arguments->content;
  }
}
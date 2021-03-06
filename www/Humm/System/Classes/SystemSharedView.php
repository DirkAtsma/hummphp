<?php

/**
 * This file implement the SystemSharedView system class.
 *
 * This class is the associated class for the system errors
 * view and can interact with such view providing view HTML
 * template variables and so on.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2016 Humm PHP - David Esperalta
 */

namespace Humm\System\Classes;

/**
 * System SystemSharedView class implementation.
 *
 * This class is automatically loaded before any other
 * system view must be displayed.
 *
 */
class SystemSharedView extends HummView
{
  const HUMM_SITE_URL = 'http://www.davidesperalta.com/?languageCode=%s';

  /**
   * Construct a SystemSharedView object.
   *
   * @param HtmlTemplate $template Template of the associated view.
   */
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
    $this->setDefaultTemplateVars();
  }

  private function setDefaultTemplateVars()
  {
    $this->template->hummPhpSiteUrl = \sprintf(
      self::HUMM_SITE_URL, Languages::getCurrentLanguage()
    );
  }
}

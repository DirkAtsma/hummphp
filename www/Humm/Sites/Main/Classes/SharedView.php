<?php

/**
 * This file implement the main site Shared view class.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.davidesperalta.com/
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2016 Humm PHP - David Esperalta
 */

namespace Humm\Sites\Main\Classes;

use
  \Humm\System\Classes\HummView,
  \Humm\System\Classes\HtmlTemplate;

/**
 * Implement the main site SharedView class.
 *
 * This class is instantiated by the Humm PHP system in whatever
 * required main site view, home view or any others, so basically
 * we can use the site's SharedView in order to setup shared stuff
 * like HTML template variables.
 *
 */
class SharedView extends HummView
{
  const HUMM_SITE_URL = 'http://www.davidesperalta.com/?languageCode=%s';

  /**
   * Construct the object and set some default template variables.
   *
   * @param HtmlTemplate $template Site view HTML template instance.
   */
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
    $this->setDefaultTemplateVars();
  }

  private function setDefaultTemplateVars()
  {
    $this->template->hummPhpSiteUrl = \sprintf(
      self::HUMM_SITE_URL,
      $this->template->siteLanguage
    );
  }
}

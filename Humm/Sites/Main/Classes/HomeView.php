<?php

/**
 * This file implement the main site Home view class.
 *
 * @author D. Esperalta <info@davidesperalta.com>
 * @link http://www.hummphp.com/ Humm PHP website
 * @license https://www.gnu.org/licenses/gpl.html
 * @copyright (C)2014, Humm PHP - David Esperalta
 */

namespace Humm\Sites\Main\Classes;

use
  \Humm\System\Classes\HummView,
  \Humm\System\Classes\UrlPaths,
  \Humm\System\Classes\UserInput,
  \Humm\System\Classes\Languages,
  \Humm\System\Classes\UserClient,
  \Humm\System\Classes\HtmlTemplate,
  \Humm\System\Classes\ClientSession;

/**
 * Main site HomeView class implementation.
 *
 * This class is instantiated automatically by the system
 * when the site home view is required.
 */
class HomeView extends HummView
{
  const LANGUAGE_URL = '%s?%s=%s';
  const REDIRECT_INPUT = 'redirectUrl';
  const LANGUAGE_INPUT = 'languageCode';

  /**
   * Construct the object and take care about some special requests.
   *
   * We use this class (in the site sample of Humm PHP) in order to
   * allow the user to change the interface language, or to try such
   * change using the user client established language.
   *
   * @param HtmlTemplate $template Site view template instance.
   */
  public function __construct(HtmlTemplate $template)
  {
    parent::__construct($template);
    $this->changeLanguageByUser();
    $this->changeLanguageByClient();
  }

  private function changeLanguageByUser()
  {
    if (UserInput::get(self::LANGUAGE_INPUT) !== null) {
      Languages::setCurrentLanguage(UserInput::get(self::LANGUAGE_INPUT));
      if (UserInput::get(self::REDIRECT_INPUT) != null) {
        UserClient::redirectTo(UserInput::get(self::REDIRECT_INPUT));
      } else {
        UserClient::redirectToHome();
      }
    }
  }

  private function changeLanguageByClient()
  {
    if ((UserInput::session(ClientSession::HUMM_LANGUAGE) === null) &&
     Languages::languageExists(UserClient::language()) &&
      (UserClient::language() !== $this->template->siteLanguage)) {

      Languages::setCurrentLanguage(UserClient::language());
      UserClient::redirectTo(\sprintf
      (
        self::LANGUAGE_URL,
        UrlPaths::root(),
        self::LANGUAGE_INPUT,
        UserClient::language()
      ));
    }
  }
}
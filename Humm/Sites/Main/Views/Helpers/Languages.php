
<?php if (!$this) { exit; } ?>

<form id="languageForm" name="languageForm" method="get" action="<?= $siteUrl ?>">

 <input type="hidden" name="redirectUrl" value="<?= $requestUri ?>" />

 <div>
  <select id="languageCode" name="languageCode"
   title="<?php e('Choose your language from this list') ?>">

   <?php foreach($siteLanguages as $code => $name) : ?>
    <?php if($siteLanguage === $code) : ?>
     <option value="<?= $code ?>" selected="selected"><?= $name ?></option>
    <?php else : ?>
     <option value="<?= $code ?>"><?= $name ?></option>
    <?php endif; ?>
   <?php endforeach; ?>

  </select>
  <input type="submit" value="<?php e('Change') ?>" id="languageButton"
   title="<?php e('Press this button to change the site language') ?>" />
 </div>
</form>

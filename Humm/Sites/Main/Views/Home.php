
<?php if (!$this) { exit; } ?>

<?php $this->displayView('PreHeader') ?>
<title><?php e('Humm PHP is ready!') ?></title>
<?php $this->displayView('PosHeader') ?>

<div id="contentsWrapper">
 <header id="pageHeader">
  <h1><a href="<?= $siteUrl ?>" title="<?php e('Click to refresh this page') ?>">Humm PHP</a></h1>
  <h2><a href="<?= $siteUrl ?>" title="<?php e('Click to refresh this page') ?>"><?php e('Lightweight framework') ?></a></h2>
 </header>

 <h3>
  <?php e('Ready to go!') ?>
 </h3>

 <?php $this->displayView('Languages') ?>

 <p>
  <?php e('Your Humm PHP copy are ready to go. You can start modifying this Home view and adding other views.') ?>
 </p>
 <p>
  <?php e('To get more information, obtain help and download the last Humm PHP release visit their website at:') ?>
 </p>
 <p>
  <a href="<?= $hummPhpSiteUrl ?>"
   title="<?php e('Visit the Humm PHP website') ?>">http://www.hummphp.com</a>
 </p>

 <footer id="pageFooter">
  <div id="poweredNote">
   <a href="<?= $hummPhpSiteUrl ?>"
    title="<?php e('Visit the Humm PHP website') ?>"><?php e('Powered by Humm PHP') ?>
     <span class="hummVersion"><?= $hummVersion ?></span></a>
  </div>
  <div id="copyrightNote">
   ©2014 Humm PHP - <a href="<?= $hummPhpSiteUrl ?>"
    title="<?php e('Visit the Humm PHP website') ?>">www.hummphp.com</a>
  </div>
 </footer>

</div>
<!-- /contentsWrapper -->

<?php $this->displayView('PreFooter') ?>
<?php $this->displayView('PosFooter') ?>


<?php if (!$this) { exit; } ?>

<?php $this->displayView('PreHeader') ?>
<title><?php e('Humm PHP is ready!') ?></title>
<?php $this->displayView('PosHeader') ?>

<div id="pageWrapper">

 <header>
  <h1><a href="<?= $siteUrl ?>" title="<?php e('Click to refresh this page') ?>">Humm PHP</a></h1>
  <h2><a href="<?= $siteUrl ?>" title="<?php e('Click to refresh this page') ?>"><?php e('Lightweight framework') ?></a></h2>
 </header>

 <section>
  <h1>
   <?php e('Ready to go!') ?>
  </h1>

  <?php $this->displayView('Languages') ?>

  <p>
   <?php e('Your Humm PHP copy are ready to go. You can start modifying this Home view and adding other views.') ?>
  </p>
  <p>
   <?php e('To get more information, obtain help and download the last Humm PHP release visit their website at:') ?>
  </p>
  <p>
   <a href="<?= $hummPhpSiteUrl ?>"
    title="<?php e('Visit the Humm PHP website') ?>">http://www.davidesperalta.com</a>
  </p>
 </section>

 <footer id="pageFooter">
  <div id="poweredNote">
   <a href="<?= $hummPhpSiteUrl ?>"
    title="<?php e('Visit the Humm PHP website') ?>"><?php e('Powered by Humm PHP') ?>
     <span class="hummVersion"><?= $hummVersion ?></span></a>
  </div>
  <div id="copyrightNote">
   ©2016 Humm PHP - <a href="<?= $hummPhpSiteUrl ?>"
    title="<?php e('Visit the Humm PHP website') ?>">www.davidesperalta.com</a>
  </div>
 </footer>

</div>
<!-- /pageWrapper -->

<?php $this->displayView('PreFooter') ?>
 <script type="text/javascript" src="<?= $viewsScriptsUrl ?>Home.js"></script>
<?php $this->displayView('PosFooter') ?>

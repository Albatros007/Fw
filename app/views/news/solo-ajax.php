<?php
use vendor\helpers\HTML;
?>

<div class="page-header">
    <h1>News - Solo</h1>
</div>

<div class="page-header">
  <h1><small><?= $news->title ?></small></h1>
</div>
        
<?= $news->text ?>
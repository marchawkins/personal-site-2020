<?php
/**
 * This snippet will only work if you pass a $note object to it. It is
 * used in grids, such as homepage, search results, etc. - basically
 * anywhere we have a repeating grid of note blocks. Example usage:
 * <?php snippet('note-block-single',['note' => $note]) ?>
 * This snippet would be used within a foreach, looping through all
 * notes returned by a query
 */
?>

<div class="">
  <?php if($feature_image = $note->feature_image()->toFile()):
    $imgSrc = $feature_image->thumb()->url();
  else:
    $imgSrc = "/assets/img/weblog-thumb-missing.gif";
  endif ?>
  <a class="block sm:flex" href="<?= $note->url() ?>" title="Read: <?php echo $note->title() ?>"><img src="<?php echo $imgSrc ?>" alt="<?php echo $note->title() ?>" width="300" class="object-cover h-48 sm:h-48 w-full"></a>
  <h2 class="text-base text-white font-title leading-tight mt-2"><a class="block hover:underline sm:flex" href="<?= $note->url() ?>" title="Read: <?php echo $note->title() ?>"><?php echo $note->title() ?></a></h2>
  <h3 class="text-xs text-gray-500"><?php echo $note->date()->toDate('l, M jS') ?></h3>
</div>
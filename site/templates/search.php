<?php
/**
 * Search template
 */
?>

<?php snippet('header') ?>

<main>
  <?php snippet('intro') ?>


  <div class="notes">
  <form>
    <input type="search" name="q" value="<?= html($query) ?>">
    <input type="submit" value="Search">
  </form>

  <div class="notes">
  <?php foreach ($results as $result): ?>
    <article class="note">
      <header class="note-header">
        <a href="<?= $result->url() ?>">
          <h2><?= $result->title() ?></h2>
          <time><?= $result->date()->toDate('d F Y') ?></time>
        </a>
      </header>
    </article>   
  <?php endforeach ?>
  </div>

</main>

<?php snippet('footer') ?>

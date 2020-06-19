<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`.
 * This template lists all all the subpages of the `notes` page with their title date sorted by date and links to each subpage.
 * Snippets like the header, footer and intro contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>

<?php snippet('header') ?>

<main>

  <div class="notes">
    <?php foreach ($notes = $page->children()->listed()->flip()->paginate(10) as $note): ?>
      <div class="note p-2 m-2 even:bg-gray-200">
      <a class="block sm:flex" href="<?= $note->url() ?>" title="Read: <?php echo $note->title() ?>">
        <span class="block text-5xl font-mono tracking-tighter text-gray-900 sm:inline-block"><?php echo $note->date()->toDate('Y') ?>_<?php echo $note->date()->toDate('m') ?>.<?php echo $note->date()->toDate('d') ?></span>
        <span class="block text-sm leading-tight sm:inline-block sm:mt-2 sm:ml-4">
          <span class="block text-xs uppercase text-gray-500"><?php echo $note->date()->toDate('l, M jS') ?></span>
          <h2 class="text-2xl font-medium leading-tight text-gray-900"><?php echo $note->title() ?></h2>
          <?php if($loc = $note->mymap()->yaml()): ?>
            <span class="hidden sm:block text-xs text-gray-700"><?php echo($loc['city']) ?></span>
          <?php endif ?>
        </span>
      </a>
    </div><!-- .note -->
    <?php /*
    <article class="note">
      <header class="note-header">
        <a href="<?= $note->url() ?>">
          <h2><?= $note->title() ?></h2>
          <time><?= $note->date()->toDate('d F Y') ?></time>
        </a>
      </header>
      <!-- <figure>
      <?php
          // the `cover()` method defined in the `album.php` page model can be used 
          // everywhere across the site for this type of page ?>
          <figcaption>
            <span>
              <span class="example-name"><?php echo $note->title() ?>: <?php echo $note->date()->toDate('Ymd') ?></span>
              <?php if($image = $note->image()): ?>
              <img src="<?= $image->url() ?>" alt="<?php echo $note->title() ?>"/>
              <?php endif ?>
            </span>
          </figcaption>
        </figure> -->
    </article>
    */ ?>
    <?php endforeach ?>
    
    <?php if ($notes->pagination()->hasPages()): ?>
<nav class="pagination">

  <?php if ($notes->pagination()->hasNextPage()): ?>
  <a class="next" href="<?= $notes->pagination()->nextPageURL() ?>">
    ‹ older posts
  </a>
  <?php endif ?>

  <?php if ($notes->pagination()->hasPrevPage()): ?>
  <a class="prev" href="<?= $notes->pagination()->prevPageURL() ?>">
    newer posts ›
  </a>
  <?php endif ?>

</nav>
<?php endif ?>
  </div>

</main>

<?php snippet('footer') ?>

<?php
/**
 * Search template
 */
?>

<?php snippet('header') ?>

<main class="flex-grow">
  <h1 class="text-center text-2xl font-title pt-2 sm:pt-0 sm:text-3xl">
    <?php if($query): ?>
      Notes containing &ldquo;<?php echo html($query) ?>&rdquo;
    <?php else : ?>
      Search
    <?php endif ?>
  </h1>

  <form class="search mx-4 sm:mx-auto pt-4 pb-6 max-w-md">
    <div class="flex items-center border-b border-b-2 border-black py-2">
      <input class="appearance-none bg-transparent border-none w-full text-gray-900 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Search notes" aria-label="Search term" name="q" value="<?php echo html($query) ?>"/>
      <input type="submit" value="Search" class="flex-shrink-0 bg-black hover:bg-gray-700 text-lg text-white py-1 px-2 rounded"/>
    </div>
  </form>
    
  <div class="notes">
  <?php foreach ($results as $note): ?>
    <div class="note p-2 m-2 even:bg-gray-400">
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
  <?php endforeach ?>
  </div><!-- .notes -->

</main>

<?php snippet('footer') ?>

<?php
/**
 * Search template
 */
?>

<?php snippet('header') ?>

<main class="flex-grow bg-black">

  <div class="container mx-auto">
    <h1 class="text-center text-2xl font-title text-white p-4 sm:text-3xl">
    <?php if($query): ?>
      Search results for &ldquo;<?php echo html($query) ?>&rdquo;
    <?php else : ?>
      Search
    <?php endif ?>
    </h1>
  
    <div class="max-w-sm mx-auto px-4 mb-8">
      <p class="font-mono text-terminal uppercase">Enter search term below:</p>
      <form class="flex">
        <input class="w-full p-2 text-terminal font-mono uppercase focus:outline-none border-terminal border-t border-b border-l bg-black" type="text" placeholder="" aria-label="Search term" name="q" id="queryField" value="<?php echo html($query) ?>"/>
        <input class="px-4 py-2 bg-terminal text-black font-mono uppercase hover:bg-white border-terminal border-t border-b border-r" type="submit" value="/find" />
      </form>
    </div>
    
    <?php if(!$query): ?>
      <script type="text/javascript">
        window.onload = function() {
          document.getElementById("queryField").focus();
        };
      </script>
    <?php endif ?>

    <div class="grid grid-cols-2 gap-4 px-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 sm:gap-4 sm:px-0">
      <?php foreach ($results as $note): ?>
        <?php snippet('note-block-single',['note' => $note]) ?>
      <?php endforeach ?>
    </div><!-- .grid -->

  </div><!-- .container -->
</main>

<?php snippet('footer') ?>

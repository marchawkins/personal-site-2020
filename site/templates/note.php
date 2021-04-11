<?php
/**
 * Templates render the content of your pages. 
 * They contain the markup together with some control structures like loops or if-statements.
 * This template is responsible for rendering all the subpages of the `notes` page.
 * The `$page` variable always refers to the currently active page. 
 * To fetch the content from each field we call the field name as a method on the `$page` object, e.g. `$page->title()`.
 * Snippets like the header and footer contain markup used in multiple templates. They also help to keep templates clean.
 * More about templates: https://getkirby.com/docs/guide/templates/basics
 */
?>
<?php global $user; ?>
<?php snippet('header') ?>

<main class="flex-grow bg-black">
  <article class="note mx-auto max-w-4xl">

        <div class="bg-white mb-4 tracking-wide" >
            <div class="p-4">
                <h1 class="px-2 font-normal text-4xl text-gray-800 text-center tracking-tight uppercase font-title leading-tight sm:leading-normal"><?php echo $page->title() ?></h1>
                
                <!-- main content -->
                <div class="note-content text-sm text-gray-700 mb-6">
                  <?php echo $page->text()->kirbytext();?>
                </div><!-- .note-content -->
                
                <!-- tags -->
                <div class="flex items-center justify-between mt-2 text-sm text-gray-500">
                 <?php if ($page->tags()->isNotEmpty()) : ?>
                    <div class="tags">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 mr-1 icon-tag inline-block">
                        <path class="primary" d="M2.59 13.41A1.98 1.98 0 0 1 2 12V7a5 5 0 0 1 5-5h4.99c.53 0 1.04.2 1.42.59l8 8a2 2 0 0 1 0 2.82l-8 8a2 2 0 0 1-2.82 0l-8-8zM7 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                        <path class="secondary" d="M12 18l6-6-4-4-6 6.01L12 18z"/>
                      </svg>
                      <?php 
                        $tagArray = array();
                        foreach($page->tags()->split(',') as $tag):
                          $tagArray[] = "<a href=\"". url('/weblog/', ['params' => ['tag' => $tag]])."\" title=\"More posts tagged '".html($tag)."'\">".html($tag)."</a>";
                        endforeach;
                        echo implode( ', ', $tagArray);
                      ?>
                    </div>
                  <?php endif ?>

                  <!-- commenting?
                  <a href="#" class="flex text-gray-700">
                    <svg fill="none" viewBox="0 0 24 24" class="w-6 h-6 text-blue-500" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                     </svg>
                   </a>
                   -->
                </div>

                <!-- author and date -->
                <div class="author flex items-center justify-between my-3">
                    <h4 class="text-sm tracking-tight font-normal text-gray-500">
                        Posted on <time class="note-date"><?= $page->date()->toDate('l, F jS, Y') ?>,</time>
                        <?php if($loc = $page->mymap()->yaml()): ?>
                          from <?php echo $loc['city'] ?>
                        <?php endif ?>
                    </h4>
                    <div class="user-logo">
                      <?php if($avatar = $kirby->user('marchawkins@gmail.com')->avatar()): ?>
                        <a href="/about" title="About the author"><img class="w-10 h-10 object-cover rounded-full mx-4  shadow" src="<?= $avatar->url() ?>" alt="Marc" class="h-6"/></a>
                      <?php endif ?>
                    </div><!-- .user-logo -->
                </div><!-- .author -->
                
            </div>
        </div>

  </article>
  
  <nav class="text-xl my-2">
    <ul class="flex justify-center">
      <li class="text-terminal font-mono uppercase"><a href="/weblog" title="Go back to the weblog">Back to weblog</a></li>
    </ul>
  </nav>

</main>

<?php snippet('footer') ?>

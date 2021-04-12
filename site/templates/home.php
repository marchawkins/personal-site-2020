<?php
/*
 Homepage template
<?php if($page->isHomePage()): ?>

 */
?>

<?php snippet('header') ?>

<main class="flex-grow">
  
  
  <div class="container mx-auto w-full sm:w-1/2 lg:w-1/3 text-terminal text-3xl font-mono uppercase">
    <ul class="mx-4 sm:mx-0">
      <li><a href="/weblog" class="cursor-text text-terminal hover:text-opacity-50" title="random notes and thoughts">weblog</a></li>
      <li><a href="" class="cursor-text text-terminal hover:text-opacity-50" title="pictures i've taken">photos</a></li>
      <li><a href="" class="cursor-text text-terminal hover:text-opacity-50" title="come in and stay awhile">guestbook</a></li>
      <li><a href="" class="cursor-text text-terminal hover:text-opacity-50" title="about my home office">office</a></li>
      <li><a href="/about" class="cursor-text text-terminal hover:text-opacity-50" title="about me and this website">about</a></li>
      <li><a href="" class="cursor-text text-terminal hover:text-opacity-50" title="free crap you don't need, and neither do i">downloads</a></li>
      <li><a href="/search" class="cursor-text text-terminal hover:text-opacity-50" title="search for something">search</a></li>
      <li>&nbsp;</li>
      <li><a href="#" class="cursor-not-allowed" title="w.o.p.r. offline">global thermonuclear war</a></li>
      <li><span class="relative float-left"><span class="terminal-cursor"></span>G</span></li>
    </ul>
  </div><!-- .container -->
</main>

<?php snippet('footer') ?>

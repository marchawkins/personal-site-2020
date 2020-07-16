<?php
/**
 * Snippets are a great way to store code snippets for reuse or to keep your templates clean.
 * in loops or simply to keep your templates clean.
 * This footer snippet is reused in all templates. In fetches information from the `site.txt` content file
 * and from the `about` page.
 * More about snippets: https://getkirby.com/docs/guide/templates/snippets
 */
?>

    <footer class="footer bg-black text-gray-600">
      <div class="container mx-auto p-6 text-center text-sm">
      <p>&copy; 1976 - <?= date('Y') ?> marc hawkins</p>

    <?php /*
      <?php if ($about = page('about')): ?>
      <nav class="social">
        <?php foreach ($about->social()->toStructure() as $social): ?>
        <a href="<?= $social->url() ?>"><?= $social->platform() ?></a>
        <?php endforeach ?>
      </nav>
      <?php endif ?>
    */ ?>

      </div><!-- .container -->
    </footer>

</body>
</html>

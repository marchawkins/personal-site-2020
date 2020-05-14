<?php
/**
 * Snippets are a great way to store code snippets for reuse or to keep your templates clean.
 * in loops or simply to keep your templates clean.
 * This footer snippet is reused in all templates. In fetches information from the `site.txt` content file
 * and from the `about` page.
 * More about snippets: https://getkirby.com/docs/guide/templates/snippets
 */
?>
<?= '<?xml version="1.0" encoding="utf-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($pages as $p): ?>
        <?php if (in_array($p->uri(), $ignore)) continue ?>
        <url>
            <loc><?= html($p->url()) ?></loc>
            <lastmod><?= $p->modified('c', 'date') ?></lastmod>
            <priority><?= ($p->isHomePage()) ? 1 : number_format(0.5 / $p->depth(), 1) ?></priority>
        </url>
    <?php endforeach ?>
</urlset>
<?php
// stop without videos
if(empty($videos)) return;
// set some defaults
if(!isset($width))    $width    = 400;
if(!isset($height))   $height   = 300;
if(!isset($preload))  $preload  = true;
if(!isset($controls)) $controls = true;
// build the html atts for the video element
$preload  = ($preload)  ? ' preload="preload"'   : '';
$controls = ($controls) ? ' controls="controls"' : '';
$poster_attr = ($poster) ? ' poster="'. $poster->url() .'"' : '';
?>

<video width="<?= $width ?>" height="<?= $height ?>" class="<?= $class ?>" <?= $preload . $controls . $poster_attr ?>>
<?php foreach($videos as $video): ?>
<?php if($video):?>
  <source src="<?= $video->url() ?>" type="<?= $video->mime() ?>" />
<?php endif ?>
<?php if($poster):?>
  <a href="<?= $video->url() ?>"> <img src="<?= $poster->url() ?>" alt="<?= $title ?>" /> </a>
<?php endif ?>
<?php endforeach ?>
<?php foreach($videos as $video): ?>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "VideoObject",
  "name": "<?= $title ?>",
  "description": "<?= $caption ?>",
  "thumbnailUrl": "<?= $poster->url() ?>",
  "contentUrl": "<?= $video->url() ?>",
  "uploadDate": "<?= $video->modified('%d/%m/%Y', 'strftime') ?>"
}
</script>
<?php endforeach ?>
</video>
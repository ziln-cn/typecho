<?php 
/**
 * 关于
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/header.php');
?>
<div class="container flex flex-wrap flex-1 px-0 sm:px-2 mx-auto mt-3 md:flex-no-wrap">
  <main class="flex-1 w-full" style="width: 0;">
    <div class="box sm:box mb-3 p-3">
		<div class="post_thumbnail-custom flex mb-3 h-32 sm:h-48 relative rounded-md overflow-auto">
			<img class="lazy w-full h-full rounded-md absolute object-cover object-center" 
			data-src="<?php echo Contents::getThumbnails($this)[0] ?>" 
			src="<?php echo Contents::getThumbnails($this)[0] ?>" 
			alt="<?php $this->title() ?>">
			<span class="article-headline-p w-full flex items-center justify-center text-white font-bold text-2xl tracking-wider m-auto flex-col z-10">
				<?php $this->title() ?>
				<font class="archiveTitle text-sm capitalize">- <?php $this->slug() ?> -</font>
			</span>
		</div>

		<section class="joe_detail__article">
        <?php _parseContent($this, $this->user->hasLogin()) ?>
    </section>
		
    </div>
  </main>

  <?php $this->need('layout/sidebar.php'); ?>
</div>

<?php $this->need('layout/footer.php'); ?>
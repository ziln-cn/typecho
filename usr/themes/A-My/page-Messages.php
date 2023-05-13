<?php 
/**
 * 留言
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$GLOBALS['page'] = 'page-messages';
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

		<!-- <section class="FriendWall">
    		<div class="Total"><i class="ri-message-3-line"></i> 留言墙</div>
    		<div class="row FriendWall-warpper flexbox py-3" style="margin-right: 0;margin-left: 0;">
			<?php Utils::getFriendWall(); ?>
    		</div>
    	</section> -->
    </div>

	<?php $this->need('layout/article_comments/comments.php'); ?>

  </main>

  <?php $this->need('layout/sidebar.php'); ?>
</div>

<?php $this->need('layout/footer.php'); ?>





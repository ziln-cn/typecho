<?php 
/**
 * 友链
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

		<style>
			.links_body .joe_tabs__head{
				justify-content: center;
			}
			.links_list{
				gap: .5rem;
    			grid-template-columns: repeat(2,minmax(0,1fr));
			}
            .links_list a{
                box-shadow: 0 1px 3px 0 rgb(0 0 0 / 10%), 0 1px 2px 0 rgb(0 0 0 / 6%);
				background: var(--tertiary-99);
			}
			
			@media (max-width:660px) {
				.links_list{
					grid-template-columns: repeat(1,minmax(0,1fr));
				}
			}
		</style>
		<section class="joe_detail__article">
			<h2 class="mb-2 inline-flex items-center">说明：</h2>
			<?php _parseContent($this, $this->user->hasLogin()) ?>
		</section>
		
		<section class="joe_detail__article">
			<h2 class="mt-3 inline-flex items-center">友链：</h2>
			<div id="links_list" class="links_list grid">
				<?php
					$txt = $this->options->friends;
					$string_arr = explode("\r\n", $txt);
					$long = count($string_arr);
					for ($i = 0; $i < $long; $i++) {
						$img = explode(",", $string_arr[$i])[0];
						$url = explode(",", $string_arr[$i])[1];
						$title = explode(",", $string_arr[$i])[2];
						$desc = explode(",", $string_arr[$i])[3];
					?>
					<div class="links_item rounded-md link_a" name="link_a">
						<a href="<?php echo $url ?>" class="flex p-2 rounded-md items-center" rel="external nofollow noreferrer" title="<?php echo $desc ?>" target="_blank">
							<img class="links-avatar rounded-md mr-3" alt="<?php echo $title ?>" src="<?php echo $img ?> " width="50" height="50">
							<div class="links-item-info">
								<b class="links-item-name ell"><?php echo $title ?></b>
								<span class="links-item-desc ell " title="<?php echo $desc ?>"><?php echo $desc ?></span>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</section>
    </div>

	<?php $this->need('layout/article_comments/comments.php'); ?>
  </main>

  <?php $this->need('layout/sidebar.php'); ?>
</div>


<?php $this->need('layout/footer.php'); ?>


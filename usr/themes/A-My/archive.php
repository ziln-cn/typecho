<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php 
$this->need('layout/header.php'); 
$this->need('libs/sticky.php');
?>

<div class="container flex flex-wrap flex-1 px-0 sm:px-2 mx-auto mt-3 md:flex-no-wrap">
	<main class="flex-1">
		<div class="box sm:box mb-3 p-3">
			<div class="post_thumbnail-custom flex h-32 sm:h-48 relative rounded-md overflow-auto">
				<img class="lazy w-full h-full rounded-md absolute object-cover object-center" 
					data-src="<?php 
					if (empty($this->options->ArchiveHeaderBgurl)) {
						echo 'https://irils.gitee.io/irils-cdn/Typecho-Theme/A-My/src/img/sj/' .rand(1, 20). '.jpg';
					} else {
						$this->options->ArchiveHeaderBgurl();
					}
					?>" 
					src="<?php $this->options->ArchiveHeaderBgurl() ?>" 
					alt="<?php $this->archiveTitle() ?>">
				<span class="article-headline-p w-full flex items-center justify-center text-white font-bold text-2xl tracking-wider m-auto flex-col z-10">
					<?php $this->archiveTitle([
						'category'  =>  _t(' %s <font class="archiveTitle text-sm">- Category -</font>'),
						'search'    =>  _t(' %s <font class="archiveTitle text-sm">- Search -</font>'),
						'tag'       =>  _t(' %s <font class="archiveTitle text-sm">- Tag -</font>'),
						'author'    =>  _t(' %s <font class="archiveTitle text-sm">- Author -</font>')
					], '', ''); ?>
				</span>
			</div>
		</div>

		<?php if ($this->have()): ?>
			<div class="post-list">
				<?php while($this->next()): ?>
					<?php if ($this->fields->article_type == "cross") { ?><!-- 动态样式 -->
						<?php $this->need('layout/article_type/cross.php');?>
					<?php } elseif ($this->fields->article_type == "photos") { ?><!-- 相册样式 -->
						<?php $this->need('layout/article_type/photos.php');?>
					<?php } elseif ($this->fields->article_type == "books") { ?><!-- 书单样式 -->
						<?php $this->need('layout/article_type/books.php');?>
					<?php } elseif ($this->fields->article_type == "movies") { ?><!-- 影单样式 -->
						<?php $this->need('layout/article_type/movies.php');?>
					<?php } else {?><!-- 默认样式（文章） -->
						<?php $this->need('layout/article_type/article.php');?>
					<?php }?><!-- 自定义类型样式结束 -->
				<?php endwhile; ?>
			</div>
			<div class="pagination">
				<?php if ($this->options->page_next_style=='默认分页'):?>
					<div class="box sm:box">
						<div class="page_nav w-full flex p-3">
							<div class="page_nav_number" style="flex: 1;">
								<span>第 <?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?> 页</span> / <span>共 <?php echo   ceil($this->getTotal() / $this->parameter->pageSize); ?> 页</span>
							</div>
							<div class="next">
							<?php $this->pageLink('上一页'); ?>
							<?php $this->pageLink('下一页','next'); ?>                      
							</div>
						</div>
					</div>
				<?php elseif($this->options->page_next_style=='Ajax翻页'): ?>
					<div class="page_next flex justify-center items-center"><?php $this->pageLink('查看更多','next'); ?></div>
				<?php endif; ?>
			</div>
		<?php else: ?>
			<div class="card box sm:box mb-3 p-3">
				<h2 style="font-weight: 700;line-height: 210px;color: #868e96;text-align: center;"><?php _e('没有找到内容'); ?></h2>
			</div>
		<?php endif; ?>
	</main>
	
	<?php $this->need('layout/sidebar.php'); ?>
</div>

<?php $this->need('layout/footer.php'); ?>

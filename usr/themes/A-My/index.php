<?php
/**
 * 这是一款简约的个人博客模板A-My的重构升级版(2.x)
 * 
 * @package 0A-My
 * @author 若志奕鑫
 * @version 2.1.6
 * @link https://www.rz.sb
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('layout/header.php');
 $this->need('libs/sticky.php');

 ?>

<div class="container flex flex-wrap flex-1 px-0 sm:px-2 mx-auto mt-3 md:flex-no-wrap">
	<main class="flex-1">
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
	</main>
	
	<?php $this->need('layout/sidebar.php'); ?>
</div>

<?php $this->need('layout/footer.php'); ?>


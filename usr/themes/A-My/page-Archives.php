<?php 
/**
 * 归档
 * 
 * @package custom 
 * 
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$GLOBALS['page'] = 'page-archives';
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
		<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>

		<section class="py-3">
			<h2 class="mb-2 inline-flex items-center"><iconpark-icon name="tag" class="iconpark mr-1" size="20px"></iconpark-icon> 标签</h2>
			<div class="tags">
				<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=5&limit=50')->to($tags); ?>
				<?php while($tags->next()): ?>
					<a href="<?php $tags->permalink(); ?>"  title="'<?php $tags->name(); ?>'" class="badge badge-muted"><?php $tags->name(); ?></a>
				<?php endwhile; ?>
			</div>
		</section>

		<section class="py-3">
			<h2 class="mb-2 inline-flex items-center"><iconpark-icon name="tag" class="iconpark mr-1" size="20px"></iconpark-icon> 文章日历图</h2>
			<div id="post-chart" role="img" aria-label="用于显示文章更新动态的日历图">
				<div class="loading text-center">
					<h4 class="text-primary">正在加载图表</h4>
				</div>
			</div>
		</section>

		<section class="py-3">
			<h2 class="mb-2 inline-flex items-center"><iconpark-icon name="tag" class="iconpark mr-1" size="20px"></iconpark-icon> 评论日历图</h2>
			<div id="comment-chart" role="img" aria-label="用于显示评论统计的日历图">
				<div class="loading text-center">
					<h4 class="text-primary">正在加载图表</h4>
				</div>
			</div>
		</section>
		
		<?php 
			$this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);   
			$year=0; $mon=0; $i=0; $j=0;   
			$output = '';   
			while($archives->next()):   
				$year_tmp = date('Y',$archives->created);   
				$mon_tmp = date('m',$archives->created);   
				$y=$year; $m=$mon;   
				if ($mon != $mon_tmp && $mon > 0) $output .= '</article>';   
				if ($year != $year_tmp && $year > 0) $output .= '</div>';   
				if ($year != $year_tmp) {   
					$year = $year_tmp;   
					$output .= '<section class="py-3">
									<h2 class="mb-2 inline-flex items-center"><iconpark-icon name="calendar" class="iconpark mr-1" size="20px"></iconpark-icon> '. $year .' 年</h2>
									<div class="timeline">';    
				}   
				 if ($archives->fields->article_type == "photos") { //<!-- 相册样式 -->
					$output .= '			
					<article class="timeline__item">
						<a href="'.$archives->permalink .'"><h5 class="title title--h5 timeline__title text-sm">'. $archives->title .'<i class="ri-image-line pl-2" data-toggle="tooltip" data-placement="bottom" title="相册"></i></h5></a>
						<span class="timeline__period">'.date('n-d',$archives->created).'</span>
					</article>'; //输出文章日期和标题  
				 } elseif ($archives->fields->article_type == "books") { //<!-- 书单样式 -->
					$output .= '			
					<article class="timeline__item">
						<a href="'.$archives->permalink .'"><h5 class="title title--h5 timeline__title text-sm">'. $archives->title .'<i class="ri-book-2-line pl-2" data-toggle="tooltip" data-placement="bottom" title="书单"></i></h5></a>
						<span class="timeline__period">'.date('n-d',$archives->created).'</span>
					</article>'; //输出文章日期和标题  
				 } elseif ($archives->fields->article_type == "movies") { //<!-- 影单样式 -->
					$output .= '			
					<article class="timeline__item">
						<a href="'.$archives->permalink .'"><h5 class="title title--h5 timeline__title text-sm">'. $archives->title .'<i class="ri-movie-2-line pl-2" data-toggle="tooltip" data-placement="bottom" title="影单"></i></h5></a>
						<span class="timeline__period">'.date('n-d',$archives->created).'</span>
					</article>'; //输出文章日期和标题  
				 } else {//<!-- 默认样式（文章） -->
					$output .= '			
					<article class="timeline__item">
						<a href="'.$archives->permalink .'"><h5 class="title title--h5 timeline__title text-sm">'. $archives->title .'</h5></a>
						<span class="timeline__period">'.date('n-d',$archives->created).'</span>
					</article>'; //输出文章日期和标题  
				 }
				 
			endwhile;   
			$output .= '
			<article class="timeline__item pb-0">
				<h5 class="title title--h5 timeline__title text-sm">开始</h5>
			</article>
			</div></section>';
			echo $output;
		?>
		
    </div>
  </main>

  <?php $this->need('layout/sidebar.php'); ?>
</div>

<script type="text/javascript">
	var data = {
		post: <?php echo json_encode(Contents::postCalendar(time() - 20736000, time())); ?>,
		comment: <?php echo json_encode(Contents::commentCalendar(time() - 20736000, time())); ?>
	};
</script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/ECharts.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<?php $this->need('layout/footer.php'); ?>

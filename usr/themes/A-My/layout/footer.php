<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

</div>
	<div id="GoTop">
		<a href="javascript:;" aria-label="GoTop" class="tips--left bg-tertiary-99">
			<iconpark-icon name="rocket-one" size="1.5rem"></iconpark-icon>
		</a>
	</div>

	<footer class="flex-shrink h-auto mt-3 border-t border-primary-200 bg-tertiary-99">
		<div class="container px-5 mx-auto">
			<nav class="mt-2">
				<ul class="inline-flex items-center flex-wrap">
					<li><a href="<?php $this->options->siteUrl(); ?>" target="_blank"><?php $this->options->title(); ?></a>
					</li>
				</ul>
			</nav>
			<div class="flex justify-between">
				<div class="flex flex-col mb-3 meta">
					<span class="mb-3"><?php $this->options->description(); ?></span>
					<div><?php $this->options->footermyself();?></div>
					<span>
						<?php if($this->options->sites_create_time != NULL) { ?>
							本站已运行：<?php Utils::getBuildTime(); ?>
						<?php } ?>
						<span class="flex items-center flex-wrap"><?php if ($this->options->IcpBa): ?><a href="http://beian.miit.gov.cn/publish/query/indexFirst.action"><?php $this->options->IcpBa(); ?></a><?php endif; ?> <span class="mr-1"></span> <?php if ($this->options->PoliceBa): ?><img src="<?php $this->options->themeUrl('src/img/police.png'); ?>">公安备案号:<a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php $this->options->PoliceBa(); ?>"><?php $this->options->PoliceBa(); ?></a><?php endif; ?></span>
						<span>Powered by <a target="_blank" href="http://www.typecho.org">Typecho</a>&nbsp;|&nbsp;Theme by <a target="_blank" href="https://www.rz.sb/archives/1402/">A-My</a> © 2022  Copyright </span>
					</span>
    			
				</div>
				<div class="md:block" style="display:none;">
					<div class="flex items-start rounded-md">
						<img class="rounded-md" src="<?php $this->options->author_gravatar() ?>" width="50" height="50" alt="<?php $this->options->title(); ?>">
					</div>
				</div>
			</div>
		</div>
	</footer>
	<canvas id="universe"></canvas>
</div>

<?php if ($this->options->compressHtml): $html_source = ob_get_contents();
	ob_clean();
	print utils::compressHtml($html_source);
	ob_end_flush(); 
endif; ?>


<script>
	Config = {
		homeUrl: '<?php $this->options->siteUrl(); ?>',
		Pjax: '<?php if ($this->options->pjax_switch):?>true<?php else: ?>close<?php endif; ?>',
		ECharts_switch: '<?php if (isset($GLOBALS['page']) && $GLOBALS['page'] == 'page-archives'):?>true<?php else: ?>close<?php endif; ?>',
		owoJson	: '<?php  $this->options->themeUrl('src/owo/OwO.json'); ?>',
		pageSize : '<?php $this->options->pageSize(); ?>',
		GLOBALSpage : '<?php if (isset($GLOBALS['page']) && $GLOBALS['page'] == 'page-cross'):?>true<?php else: ?>close<?php endif; ?>',
		sidebar_switch: '<?php if ($this->options->sidebar_switch):?>true<?php else: ?>close<?php endif; ?>'
	} 
	$(document).on("click", "#btnSearch", function () {
		tip.open({
			content: '<div class="field-search">'+
					'<form class="search-form flex form-group" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">'+
					'<input type="text" id="s" name="s" id="search" class="block w-full form-input" name="search" placeholder="<?php _e('请输入搜索关键词......'); ?>">'+
					'<button type="submit" class="inline-flex items-center btn btn-search ml-1">'+
					'<span>搜索</span>'+
					'</button>'+
					'</form></div>',
			btn: ['<iconpark-icon class="iconpark" name="close-small"></iconpark-icon>'],
			title:
			'<div class="flex items-center"><span>搜索...</span></div>',
			skin: "search",
			anim: "down",
			shade: true
		});
	});
</script>
<!-- style css -->
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/Sticky.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/tip.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/jquery.pjax.min.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/viewImage.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/lazyload.min.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/APlayer.min.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/prism.min.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/joe.short.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/owo/OwO.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
<script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/style.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>


<script type="text/javascript">
<?php $this->options->JavaScriptmyself();?>

<?php if ($this->options->pjax_switch):?>
const pjax = new Pjax({
    selectors: [
        '#pjax-main', 'title', 'header', 'joe-music'
    ],
});
document.addEventListener('pjax:send', () => {
	$("html").addClass("loading");
});
document.addEventListener('pjax:complete', () => {
	$("html").removeClass("loading");
    if (typeof Prism !== 'undefined') {
        Prism.highlightAll(true,null);
		$("pre[class*=' language-']").each(function (index, item) {
			let text = $(item).find("code[class*=' language-']").text();
			let span = $(`<span class="copy"><i class="fa fa-clone"></i></span>`);
			$(item).append(span);
		});
    }

    PjaxLoad();
	Crosslength();
	<?php $this->options->pjax_complete(); ?>
});
<?php endif; ?>
</script>

<?php $this->footer(); ?>
</body>
</html>

<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<!DOCTYPE HTML>
<html lang="zh">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>

	<link rel="shortcut icon" type="image/x-icon" href="<?php $this->options->favicon() ?>">
    <!-- 使用url函数转换相关路径 -->
	<link rel="stylesheet" type="text/css" href="<?php Utils::SrcCdnDir();?>src/css/custom.css?v<?php $ver = themeVersion(); echo ''. $ver .'';?>">
    <link rel="stylesheet" type="text/css" href="<?php Utils::SrcCdnDir();?>src/owo/owo.min.css?v<?php $ver = themeVersion(); echo ''. $ver .'';?>">
    <link rel="stylesheet" type="text/css" href="<?php Utils::SrcCdnDir();?>src/css/plugins/plugins.css?v<?php $ver = themeVersion(); echo ''. $ver .'';?>">
    <link rel="stylesheet" type="text/css" href="<?php Utils::SrcCdnDir();?>src/css/icon/remixicon.css?v<?php $ver = themeVersion(); echo ''. $ver .'';?>">
    <script type="text/javascript" src="<?php Utils::SrcCdnDir();?>src/js/plugins/jquery.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
	<script src="<?php Utils::SrcCdnDir();?>src/js/plugins/iconpark.js?v<?php $ver = themeVersion(); echo ''. $ver .'';?>"></script>
	
	<?php $this->options->headmyself();?>
	
	<?php if(!empty($this->options->Diyfont)): ?>
		<style>
			@font-face {
				font-family:Diyfont;font-style: normal;font-display: swap;
				src: url('<?php $this->options->Diyfont(); ?>') format('truetype')
			}
			*{
				font-family:Diyfont,'Noto Serif SC', serif !important;
			}
		</style>
	<?php endif; ?>
	<style>
	    body.theme-ocean,body.theme-jade{background-image:url(<?php $this->options->dark_bgUrl() ?>)!important;color:rgb(201 201 201)}

		<?php $this->options->Cssmyself(); 
		if($this->options->ymusic=='0'){	
			echo '.ymusic{display: none !important;}'. "\n";
		}
		elseif ($this->options->sxj=='0'){
			echo '@media only screen and (max-width:766px){.ymusic{display: none !important;}}'. "\n";
		}
		?>

		<?php if ($this->options->aidao) : ?>
		html {
			filter: grayscale(100%);
			-webkit-filter: grayscale(100%);
			-moz-filter: grayscale(100%);
			-ms-filter: grayscale(100%);
			-o-filter: grayscale(100%);
		}
		<?php endif; ?>
  	</style>

</head>


<body class="theme-light bg-primary-300" style="background-image:url(<?php $this->options->background_image_bgUrl() ?>);">
    <div class="<?php if ($this->options->sidebar_switch):?>container<?php else: ?>container sidebars<?php endif; ?> flex flex-col overflow-auto mx-auto box sm:box bg-primary-300">
        <div class="head <?php if ($this->options->sidebar_switch):?>container<?php else: ?>container sidebars<?php endif; ?> flex items-center justify-between absolute px-3 sm:px-6 py-6 z-10">
            <div class="flex-1 flex items-center justify-end">
                <?php if($this->options->ymusic=='1'){	?>
                    <div class="ymusic"><?php echo Utils::music();?></div>
                <?php } ?>
                <div class="inline-flex items-center tips--left ml-3" aria-label="切换主题">
                    <a id="light" href="javascript:;" aria-label="light">
                        <iconpark-icon icon-id="light" name="sleep" size="1.5rem" class="iconpark fill-current"
                            color="#384547"></iconpark-icon>
                    </a>
                    <a id="ocean" href="javascript:;" aria-label="ocean">
                        <iconpark-icon icon-id="ocean" name="config" size="1.5rem" class="hover:text-orange-600"
                            color="#fbd38d"></iconpark-icon>
                    </a>
                    <a id="jade" href="javascript:;" aria-label="jade">
                        <iconpark-icon icon-id="jade" name="dark-mode" size="1.5rem"
                            class="iconpark text-primary-300 hover:text-primary-600"></iconpark-icon>
                    </a>
                </div>
                <a id="btnSearch" href="javascript:;" class="ml-3" aria-label="Search">
                    <iconpark-icon class="iconpark" name="search" size="1.5rem"></iconpark-icon>
                </a>
            </div>
        </div>
        <header class="flex-shrink border-b bg-tertiary-99 border-primary-200 relative">
            <div class="banner">
                <img src="<?php $this->options->bannerUrl() ?>" alt="banner" class="w-full h-48 md:h-72 object-cover">
            </div>
            <div class="container flex items-center px-3 py-3 mx-auto absolute bottom-12">
                <div class="flex items-end sm:flex-row">
                    <a class="w-20 h-20 sm:w-24 sm:h-24 flex items-start text-primary-700 mr-5 hover:text-secondary-600 rounded-md bg-white" href="<?php $this->options->author_gravatar_url() ?>">
                        <img class="rounded-md border-4 border-white" src="<?php $this->options->author_gravatar() ?>" alt="tx" width="96" height="96">
                    </a>
                    <div class="leading-loose">
                        <h3 class="text-white font-bold text-2xl tracking-wider"><?php $this->options->author_name() ?></h3>
                        <div id="typed-strings" >
						<span><?php $this->options->author_describe() ?></span>
                        </div>
                        <span id="typed" class="header-status" style="margin-top:1rem;"></span>
                        <?php if (!empty($this->options->author_describe_typed) && in_array('author_describe_typed', $this->options->author_describe_typed)): ?>
                            <script src="<?php Utils::SrcCdnDir();?>src/js/plugins/Typed.js"></script>
                            <script type="text/javascript">
                                /* 打字机 */
                                var typed = new Typed('#typed', {
                                stringsElement: '#typed-strings',
                                typeSpeed: 150,
                                loop: false
                                });
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (!empty($this->options->theAllViews) && in_array('theAllViews', $this->options->theAllViews)): ?>
                    <div class="preview absolute top-4 sm:top-8 right-6 text-center">
                        <div class="tips--left flex items-center" aria-label="浏览量">
                            <iconpark-icon class="iconpark" name="eyes" size="1.5rem"></iconpark-icon>
                            <font class="text-white ml-2"><?php echo theAllViews();?></font>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="h-8"></div>
            <div class="header-nav container flex items-center justify-between px-3 py-3 mx-auto sticky-header relative">
                <div class="overflows">
                </div>
                <ul class="w-full flex flex-nowrap overflow-auto overflow-y-hidden cursor-move whitespace-no-wrap">
                    <li class="pjax px-3 py-1 <?php if($this->is('index')): ?>bg-primary-300 rounded border-b border-color<?php endif; ?>"><a href="<?php $this->options->siteUrl(); ?>">首页</a></li>
                    
                    <?php if ($this->options->pageortags == "0"):?>
                        <?php if ($this->options->category_switch == "0"):?>
                            <?php if ($this->options->sortalls == "1"): ?>
                                <!-- 分类 -->
                                <li class="pjax px-3 py-1 submenu">
                                    <a href="javascript:;"><?php $this->options->sortallname(); ?></a>
                                    <ul class="submenu_category rounded bg-tertiary-99">
                                    <?php
                                        $categories = $this->widget('Widget_Metas_Category_List');
                                        while($categories->next()){
                                        if ($categories->levels === 0){
                                            $html = '<li><div class="category-parent relative">';
                                            $html .= '<a href="'.$categories->permalink.'">'.$categories->name.'</a>';
                                            echo $html;
                                            $children = $categories->getAllChildren($categories->mid);
                                            if (!empty($children)){
                                            $childCategoryHtml = '<iconpark-icon name="right"></iconpark-icon><div class="category-child"><ul class="widget-tile">';
                                            foreach ($children as $mid){
                                                $child = $categories->getCategory($mid);
                                                $childCategoryHtml .= '<li><a href="'.$child['permalink'].'">'.$child['name'].'</a></li>';
                                            }
                                            $childCategoryHtml  .= '</ul></div>';
                                            echo $childCategoryHtml;
                                            echo "</div></li>";
                                            }
                                        }
                                        }
                                    ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                                <?php while($category->next()): ?>
                                    <li class="pjax px-3 py-1 <?php if($this->is('category',$category->slug)): ?>bg-primary-300 rounded border-b border-color<?php endif; ?>">
                                        <a href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <!-- 独立页面 -->
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while($pages->next()): ?>
                            <li class="pjax px-3 py-1 <?php if($this->is('page',$pages->slug)): ?>bg-primary-300 rounded border-b border-color<?php endif; ?>">
                                <a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <!-- 独立页面 -->
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while($pages->next()): ?>
                            <li class="pjax px-3 py-1 <?php if($this->is('page',$pages->slug)): ?>bg-primary-300 rounded border-b border-color<?php endif; ?>">
                                <a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
                            </li>
                        <?php endwhile; ?>

                        <?php if ($this->options->category_switch == "0"):?>
                            <?php if ($this->options->sortalls == "1"): ?>
                                <!-- 分类 -->
                                <li class="pjax px-3 py-1 submenu">
                                    <a href="javascript:;"><?php $this->options->sortallname(); ?></a>
                                    <ul class="submenu_category rounded bg-tertiary-99">
                                    <?php
                                        $categories = $this->widget('Widget_Metas_Category_List');
                                        while($categories->next()){
                                        if ($categories->levels === 0){
                                            $html = '<li><div class="category-parent relative">';
                                            $html .= '<a href="'.$categories->permalink.'">'.$categories->name.'</a>';
                                            echo $html;
                                            $children = $categories->getAllChildren($categories->mid);
                                            if (!empty($children)){
                                            $childCategoryHtml = '<iconpark-icon name="right"></iconpark-icon><div class="category-child"><ul class="widget-tile">';
                                            foreach ($children as $mid){
                                                $child = $categories->getCategory($mid);
                                                $childCategoryHtml .= '<li><a href="'.$child['permalink'].'">'.$child['name'].'</a></li>';
                                            }
                                            $childCategoryHtml  .= '</ul></div>';
                                            echo $childCategoryHtml;
                                            echo "</div></li>";
                                            }
                                        }
                                        }
                                    ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                                <?php while($category->next()): ?>
                                    <li class="pjax px-3 py-1 <?php if($this->is('category',$category->slug)): ?>bg-primary-300 rounded border-b border-color<?php endif; ?>">
                                        <a href="<?php $category->permalink(); ?>"><?php $category->name(); ?></a>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- 相册、书单、影单 -->
                    <?php if (!empty($this->options->nav_item_category) && in_array('photos', $this->options->nav_item_category)): ?>
                        <li class="pjax px-3 py-1 <?php if($this->is('category','photos')): ?>bg-primary-300 rounded border-b border-color<?php endif; ?>">
                            <a class="nav-link" href="<?php $this->options->siteUrl(); ?>category/photos/">相册</a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($this->options->nav_item_category) && in_array('books', $this->options->nav_item_category)): ?>
                        <li class="pjax px-3 py-1 <?php if($this->is('category','books')): ?>bg-primary-300 rounded border-b border-color<?php endif; ?>">
                            <a class="nav-link" href="<?php $this->options->siteUrl(); ?>category/books/">书单</a>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($this->options->nav_item_category) && in_array('movies', $this->options->nav_item_category)): ?>
                        <li class="pjax px-3 py-1 <?php if($this->is('category','movies')): ?>bg-primary-300 rounded border-b border-color<?php endif; ?>">
                            <a class="nav-link" href="<?php $this->options->siteUrl(); ?>category/movies/">影单</a>
                        </li>
                    <?php endif; ?>

                    <!-- 自定义导航 -->

                    <?php
                    $txt = $this->options->nav_item;
                    $string_arr = explode("\r\n", $txt);
                    $long = count($string_arr);
                    for ($i = 0; $i < $long; $i++) {
                        $url = explode(",", $string_arr[$i])[0];
                        $title = explode(",", $string_arr[$i])[1];
                    ?>
                        <?php if($txt != NULL) { ?>
                            <li class="pjax px-3 py-1">
                                <a target="_blank" rel="noopener" title="<?php echo $title ?>" href="<?php echo $url ?>"><?php echo $title ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    
                </ul>
            </div>
        </header>
        <div  id="pjax-main" class="relative">
            <div id="loading" class="butterbar active hidden">
                <span class="bar"></span>
            </div>
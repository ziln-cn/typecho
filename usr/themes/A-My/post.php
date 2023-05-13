<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>

<?php if ($this->options->sidebar_switch == 0 && ($this->fields->catalog == true)):?>
    <div id="toc-container">
        <div class="sticky top-17 p-3 rounded-md bg-primary-300">
            <strong>文章目录</strong>
            <div id="toc" class="TOC-text toc mt-2">
                <?php Contents::getCatalog(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if ($this->fields->article_type == "cross") { ?><!-- 动态样式 -->
    <?php $this->need('layout/article_post/cross.php');?>
<?php } elseif ($this->fields->article_type == "photos") { ?><!-- 相册样式 -->
    <?php $this->need('layout/article_post/photos.php');?>
<?php } elseif ($this->fields->article_type == "books") { ?><!-- 书单样式 -->
    <?php $this->need('layout/article_post/books.php');?>
<?php } elseif ($this->fields->article_type == "movies") { ?><!-- 影单样式 -->
    <?php $this->need('layout/article_post/movies.php');?>
<?php } else {?><!-- 默认样式（文章） -->
    <?php $this->need('layout/article_post/article.php');?>
<?php }?><!-- 自定义类型样式结束 -->

<?php $this->need('layout/footer.php'); ?>
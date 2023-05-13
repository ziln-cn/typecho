<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="news-item box sm:box mb-3 pt-2">
    <div class="post_article-content mx-3 py-1" style="letter-spacing:1px;">
        <div class="post_thumbnail-custom flex mb-3 h-32 sm:h-48 relative rounded-md overflow-auto">
            <img class="lazy w-full h-full rounded-md absolute object-cover object-center" 
                data-src="<?php echo Contents::getThumbnails($this)[0] ?>" 
                src="<?php echo Contents::getThumbnails($this)[0] ?>" 
                alt="<?php $this->title() ?>">
            <a href="<?php $this->permalink() ?>" aria-label="<?php $this->title() ?>" class="article-headline-p w-full flex items-center justify-center text-white hover:text-white font-bold md:text-2xl text-xl tracking-wider m-auto z-10">
                <span class="ell px-3"><?php $this->sticky(); $this->title() ?></span>
            </a>
        </div>

        <div class="post_entry-content">

        <?php $this->excerpt(50, '...'); ?>

        <a href="<?php $this->permalink() ?>" target="_self" aria-label="Read more"><p>阅读全文</p></a>
        </div>
    </div>
    <div class="post_box-state">
        <?php $suport = get_post_support($this->cid) ?>
        <div class="post_box-state-btns post-suport" data-cid="<?php echo $this->cid ?>">
            <iconpark-icon class="iconpark" name="<?php echo $suport['icon'] ?>"></iconpark-icon> <span><?php echo ' '.$suport['count'] .' '. $suport['text'] ?></span>
        </div>
        <a href="<?php $this->permalink() ?>#comments" class="post_box-state-btns" aria-label="comments">
            <iconpark-icon class="iconpark" name="comments"></iconpark-icon><span><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></span>
        </a>
        <div class="post_box-state-btns">
            <iconpark-icon class="iconpark" name="eyes"></iconpark-icon><span> <?php Contents::getPostView($this); ?> 浏览</span>
        </div>
    </div>
</div>
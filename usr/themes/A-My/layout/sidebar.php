<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if ($this->options->sidebar_switch):?>
<sidebar class="sidebar flex flex-col justify-between w-full mt-5 ml-0 md:w-66 md:flex-shrink-0 md:mt-0 md:ml-3">
    <div class="sticky top-17">
        <?php if (!empty($this->options->sidebar_box_show) && in_array('gg', $this->options->sidebar_box_show)): ?>
            <div class="p-3 mt-3 box sm:box">
                <div class="flex justify-between">
                    <div class="flex">
                        <div>
                            <h4>公告</h4>
                            <span class="meta"><?php $this->options->gonggao() ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebar_box_show) && in_array('yy', $this->options->sidebar_box_show)): ?>
            <div class="p-3 mt-3 box sm:box">
                <div class="flex justify-between">
                    <div class="flex">
                        <div>
                            <h4>随机一言</h4>
                            <span class="meta"><p id="hitokoto"><span id="hitokoto_text">:D 获取中...</span></p></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($this->is('post') && ($this->fields->catalog == true)): ?>
            <div class="p-3 mt-3 box sm:box">
                <strong>文章目录</strong>
                <div id="toc" class="TOC-text toc mt-2">
                    <?php Contents::getCatalog(); ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebar_box_show) && in_array('zxpl', $this->options->sidebar_box_show)): ?>
            <div class="p-3 mt-3 box sm:box">
                <div>
                    <h4>最新评论</h4>
                </div>

                <?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true')->to($comments); ?>
                <?php while($comments->next()): ?>
                    <div class="flex items-center pt-3 mt-3 border-t border-color text-sm tips--top" aria-label="<?php $comments->author(false); ?> 于 <?php $comments->date("m-d H:s"); ?> 说">
                        <img class="h-5 w-5 object-cover rounded mr-3" src="<?php utils::PAvatar($comments->mail); ?>s=100" alt="<?php $comments->author(false); ?>">
                        <span class="news-comments-content"><a href="<?php $comments->permalink(); ?>" class="ell"><?php $comments->excerpt(20, '...'); ?></a></span>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($this->options->sidebar_box_show) && in_array('sjwz', $this->options->sidebar_box_show)): ?>
            <div class="p-3 mt-3 box sm:box">
                <div>
                    <h4>随机文章</h4>
                </div>
                
                <?php Contents::random_posts(); ?>

            </div>
        <?php endif; ?>
        <?php
            $txt = $this->options->sidebar_box;
            $string_arr = explode("\r\n", $txt);
            $long = count($string_arr);
            for ($i = 0; $i < $long; $i++) {
                $title = explode(",", $string_arr[$i])[0];
                $content = explode(",", $string_arr[$i])[1];
            ?>
            <?php if($txt != NULL) { ?>
                <div class="p-3 mt-3 box sm:box">
                    <div class="pb-2 border-b border-color">
                        <h4><?php echo $title ?></h4>
                    </div>
                    <div class="py-3">
                        <?php echo $content ?>
                    </div>
                </div>
            <?php }?>
        <?php } ?>

    </div>
</sidebar>
<?php endif; ?>
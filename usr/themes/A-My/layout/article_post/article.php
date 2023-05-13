<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="container flex flex-wrap flex-1 px-0 sm:px-2 mx-auto mt-3 md:flex-no-wrap">
  <main class="flex-1 w-full" style="width: 0;">
    <div class="box sm:box mb-3 p-3">
      <?php if ($this->fields->thumbof == true){ ?>
        <div class="post_thumbnail-custom flex mb-3 h-32 sm:h-48 relative rounded-md overflow-auto">
          <img class="lazy w-full h-full rounded-md absolute object-cover object-center" 
              data-src="<?php echo Contents::getThumbnails($this)[0] ?>" 
              src="<?php echo Contents::getThumbnails($this)[0] ?>" 
              alt="<?php $this->title() ?>">
          
          <span class="px-3 article-headline-p w-full flex items-center justify-center text-white font-bold text-xl md:text-2xl tracking-wider m-auto flex-col z-10">
            <?php $this->title() ?>
          </span>
        </div>

      <?php } ?>
      <div class="post_entry-info flex pb-3 border-b border-color">
        <div class="post_entry-left-info flex items-center flex-1">
            <div class="author-avatar flex">
                <?php if ($this->options->index_gravatar_Select):?>
                    <?php $email=$this->author->mail; $imgUrl = utils::ParseAvatar($email);echo '<img data-src="'.$imgUrl.'"  src="'.$imgUrl.'" class="avatar rounded-md mr-3 shadow lazy" height="40" width="40">'; ?>
                <?php else: ?>
                    <img data-src="<?php $this->options->author_gravatar() ?>"  src="<?php $this->options->author_gravatar() ?>" class="avatar rounded-md mr-3 shadow lazy" height="40" width="40">
                <?php endif; ?>
            </div>
            <div style="display: flex;flex-direction: column;">
                <span class="author-title font-bold ell"><?php $this->author(); ?></span>
                <span style="font-size: 12px; font-weight: 400; color: #74858F;"><?php echo Utils::formatTime($this->created); ?></span>
            </div>
        </div>
        <div class="post_entry-right-info" style="overflow: hidden;">
            <span class="post_entry-category post_category-link" style="margin: 0 4px; white-space: nowrap;">
                <?php $this->category(' '); ?>            
            </span>
        </div>
      </div>

      <section class="joe_detail__article py-3">
        <?php if ($this->fields->Overdue && $this->fields->Overdue !== 'close' && floor((time() - ($this->modified)) / 86400) > $this->fields->Overdue) : ?>
            <div class="grid p-2 rounded-md" style="background: #fee7c2;color: #d3a152;">
                <span>温馨提示：</span>
                <span>
                    本文最后更新于<?php echo date('Y年m月d日' , $this->modified);?>，已超过<?php echo floor((time()-($this->modified))/86400);?>天没有更新，若内容或图片失效，请留言反馈。
                </span>
            </div>
        <?php endif; ?>

        <?php if ($this->hidden || $this->titleshow): ?>
          <form action="<?php echo Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>"
                  method="post">
                <p class="text-center">此篇文章已被加密，请输入密码后查看</p>
                <div class="form-group field-userinfo-tagline flex space-x-2 my-5 justify-center">
                  <input class="block form-input" name="protectPassword" type="password" placeholder="输入密码" aria-label="请输入密码">
                  <input class="inline-flex items-center btn btn-search ml-1" type="submit" name="" value="确认提交"/>
                </div>
                <input type="hidden" name="protectCID" value="<?php $this->cid(); ?>"/>
            </form>
        <?php else: ?>
            <?php _parseContent($this, $this->user->hasLogin()) ?>
        <?php endif; ?>
        
      </section>

      <span class="pb-3 post-tags">
        <?php $this->tags(' ', true, ''); ?>
      </span>
      <div class="flex items-center justify-between pt-3 border-t border-color">
        <div class="inline-flex items-center">
            <?php $suport = get_post_support($this->cid) ?>
            <a href="javascript:void(0);" class="favorite mr-4 tips--top inline-flex items-center post-suport" params="unfavorite vote_topic 1"
                aria-label="点赞" data-cid="<?php echo $this->cid ?>">
                <iconpark-icon class="iconpark mr-1" name="<?php echo $suport['icon'] ?>" size="19px"></iconpark-icon> <span class="ml-1"><?php echo ' '.$suport['count'] ?></span>
            </a>
            <a href="javascript:void(<?php Contents::getPostView($this); ?>);" class="thank mr-4 tips--top inline-flex items-center" id="thank topic 1" aria-label="浏览数">
              <div class="inline-flex items-center">
                <span class="mr-1 inline-flex items-center">
                  <iconpark-icon class="iconpark" name="eyes" size="18px"></iconpark-icon>
                </span>
                <span class="stars_count mr-1"><?php Contents::getPostView($this); ?></span>
              </div>
            </a>
        </div>
        
        <div class="inline-flex items-center">
            <span class="mr-3 sub">分享:</span>
            <span class="mr-3 inline-flex items-center">
                <a href="https://api.qrserver.com/v1/create-qr-code/?size=200x200&margin=10&data=<?php $this->permalink() ?>" class="inline-flex items-center tips--top" aria-label="微信" onclick="window.open(this.href, 'wechat-share', 'width=730,height=500');return false;">
                  <iconpark-icon class="iconpark" name="friends-circle"></iconpark-icon>
                </a>
            </span>
            <span class="mr-3 inline-flex items-center">
                <a href="http://service.weibo.com/share/share.php?url=<?php $this->permalink(); ?>/&title=<?php $this->title() ?>" class="inline-flex items-center tips--top" aria-label="微博"  onclick="window.open(this.href, 'weibo-share', 'width=730,height=500');return false;">
                  <iconpark-icon class="iconpark" name="weibo"></iconpark-icon>
                </a>
            </span>
            <span>
                <a href="https://connect.qq.com/widget/shareqq/index.html?url=<?php $this->permalink(); ?>&sharesource=qq&title=<?php $this->title() ?>" class="inline-flex items-center tips--top" aria-label="QQ" onclick="window.open(this.href, 'qzone-share', 'width=730,height=500');return false;">
                  <iconpark-icon class="iconpark" name="tencent-qq"></iconpark-icon>
                </a>
            </span>
        </div>
      </div>
    </div>
    
    <?php $this->need('layout/article_comments/comments.php'); ?>
  </main>

  <?php $this->need('layout/sidebar.php'); ?>
</div>

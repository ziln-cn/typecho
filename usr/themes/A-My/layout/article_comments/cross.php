
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
 $GLOBALS['isLogin'] = $this->user->hasLogin();
 $GLOBALS['rememberEmail'] = $this->remember('mail',true);
 $GLOBALS['convertip'] = $this->options->convertip;
 Comments::commentReply($this);
 function cross_at($coid) {
    $db = Typecho_Db::get();
    $row = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));
    if (empty($row)) return '';
    return '<span class="cross_at"><span style="margin: 0 3px;">回复</span><a href="#comment-'.$coid.'"><b>'.$row['author'].'</b></a>：</span>';
}
?>
    <?php function threadedComments($comments, $options) {
        $commentClass = '';$group = '';
            if ($comments->authorId) {
                if ($comments->authorId == $comments->ownerId) {
                    $group = '博主';
                        $commentClass .= 'By-authors';  //如果是文章作者的动态添加 .comment-by-author 样式
                    } else {
                        $group = '游客';
                        $commentClass .= 'By-user';  //如果是动态作者的添加 .comment-by-user 样式
                    }
                } 
        $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //动态层数大于0为子级，否则是父级
        $depth = $comments->levels +1;
        if ($comments->url) {
            $author = '<a href="' . $comments->url . '"' . '" target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
        } else {
            $author = $comments->author;
        }
    ?>
        <li class="m-comments-list <?php 
            if ($comments->levels > 0) {
                echo 'comment-child';
                $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
            } else {
                echo 'comment-parent';
            }
            $comments->alt(' comment-odd', ' comment-even');
            ?> depth-<?php echo $depth ?>" id="li-<?php $comments->theId(); ?>">
                <!--class  -->
                <div id="<?php $comments->theId(); ?>">
                    <div class="pt-3 border-t border-color cross-list-li">
                        <div class="flex">
                            <div class="mr-4 cross-tx">
                                <div class="relative preview">
                                    <?php $imgUrl = utils::ParseAvatar($comments->mail);echo '<img src="'.$imgUrl.'" aria-hidden="true" class="object-cover w-12 h-12 rounded">'; ?>
                                </div>
                            </div>
                            <div class="box rounded p-3 flex-1 action-list-parent relative">
                                <div class="flex flex-wrap items-center justify-between cross-head">
                                    <div class="inline-flex items-center tips--top" aria-label="<?php $comments->dateWord(); ?>">
                                        <span><b style="color: #647287;"><?php echo $author ?></b><?php echo cross_at($comments->parent);?></span>
                                    </div>
                                    <div class="inline-flex items-center">
                                        <span class="mr-2 meta cross-dateWord"><?php $comments->dateWord(); ?></span>
                                    </div>
                                </div>
                                <div class="mb-2 text-primary-700 whitespace cross-content">
                                    <?php 
                                        $reg='/\<img src="(.*?)"(.*?)">/ism';
                                        $rp='<div class="cross_photos"><dl class="image-thumb">
                                                <dt  data-src="$1" class="img_thumb-item-dt" >
                                                    <img data-src="$1" class="cross-img lazy view-image" data-fancybox="gallery" src="$1"  title="点击放大图片">
                                                </dt>
                                            </dl>';
                                        $text= preg_replace($reg,$rp,Comments::postCommentContent($comments->content,$GLOBALS['isLogin'],$GLOBALS['rememberEmail'],$comments->mail,$parentMail));
                                        echo $text;
                                    ?>
                                    <?php if ('waiting' == $comments->status) : ?>
                                    <span style="color:orange;">您的动态正在等待审核……</span>
                                    <?php endif; ?>
                                </div>
                                <div class="cross-foot">
                                    <div class="flex flex-wrap items-center justify-end text-sm cross-state" style="
                                        padding-top: 5px;
                                        ">
                                        <div class="inline-flex items-center mr-4 cross-item">
                                            <span class="show-comment-children" onclick="changeCommentVisibility(this)"></span>
                                        </div>
                                        <div class="inline-flex items-center cross-item">
                                            <a rel='nofollow' href="#回复给<?php $comments->author(false); ?>" class="comment-reply-link" id="createReply" onclick="createReply('<?php $comments->coid();?>','<?php $comments->author(false); ?>')"title="回复给<?php $comments->author(false); ?>">
                                            回复</a>
                                        </div>
                                    </div>
                                    
                                    <?php if ($comments->children) { ?>
                                        <div class="comment-children text-sm hidden">
                                            <?php $comments->threadedComments($options); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--class  -->
        </li>
    <?php } ?>

    <div class="box sm:box p-3 mb-3 flex items-center justify-between pb-3">
        <div class="inline-flex items-center">
        <span class="mr-1 inline-flex items-center">
            <iconpark-icon class="iconpark" name="comments" size="20px"></iconpark-icon>
        </span>
        <span><?php $this->commentsNum(_t('<span class="comment-count">0</span> 条动态'), _t('仅有 <span class="comment-count">1</span> 条动态'), _t(' 共 <span class="comment-count">%d</span> 条动态')); ?></span>
        </div>
        <div class="inline-flex items-center">
        <a class="inline-flex items-center" href="#comments">
            <iconpark-icon class="iconpark" name="hand-down" size="18px"></iconpark-icon>
        </a>
        </div>
    </div>
    <section class="Comments-warpper px-3 mb-3" id="comments">
        <?php $this->comments()->to($comments); ?>
        <!--  -->
        <?php if($this->allow('comment')): ?>
			<div id="<?php $this->respondId(); ?>" class="comment-respond">
                <div class="vcomment">
                    <!--form-->
                    <form id="comment-form" action="<?php $this->commentUrl() ?>" method="post" role="form" class="comment-form relative box sm:box p-3 <?php if ($this->user->hasLogin()): ?>show<?php else: ?>hidden<?php endif; ?>">
                        <div class="border-b border-color">
                            <div class="mt-1">
                                <div class="form-group field-editor required">

                                    <div class="wysibb">
                                        <div class="wysibb-text">
                                            <textarea id="textarea" class="block w-full mt-1 form-textarea wysibb-texarea textarea OwO-textarea" name="text" rows="6" placeholder="说点什么呢..." aria-required="true" onkeydown="if((event.ctrlKey||event.metaKey)&&event.keyCode==13){document.getElementById('submitComment').click();return false};"></textarea>
                                        </div>
                                        
                                        <div class="wysibb-toolbar" style="max-height: 105px;">
                                            <div class="wysibb-toolbar-container">
                                                <?php if ($this->user->hasLogin()): ?>
                                                    <div class="wysibb-toolbar-btn">
                                                        <a href="/admin" target="_blank" class="btn-inner">
                                                            <?php $email=$this->author->mail; $imgUrl = utils::ParseAvatar($email);echo '<img draggable="false" src="'.$imgUrl.'" alt="admin" class="rounded-full" width="26" height="26">'; ?>
                                                        </a>
                                                        <span class="btn-tooltip">后台管理</span>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="wysibb-toolbar-btn wbb-info">
                                                        <span class="btn-inner">
                                                            <?php $MD5email= md5(Typecho_Cookie::get('__typecho_remember_mail')); echo '<img draggable="false" src="https://cravatar.cn/avatar/'.$MD5email.'?d=mm" alt="user" class="rounded-full" width="26" height="26">'; ?>
                                                        </span>
                                                        <span class="btn-tooltip">编辑动态信息</span>
                                                    </div>
                                                <?php endif; ?>
                                                    <div class="wysibb-toolbar-btn wbb-smilebox static">
                                                        <span class="btn-inner OwO"></span>
                                                    </div>
                                                    <div class="wysibb-toolbar-btn wbb-img">
                                                        <span class="btn-inner" onclick="document.getElementById('textarea').value+='![图片描述](图片地址)' ">
                                                            <iconpark-icon name="pic" size="1.2rem"></iconpark-icon>
                                                        </span>
                                                        <span class="btn-tooltip">插入图片</span>
                                                    </div>
                                                    <div class="wysibb-toolbar-btn wbb-link">
                                                        <span class="btn-inner" onclick="document.getElementById('textarea').value+='[](https://)' ">
                                                            <iconpark-icon name="link-55da7cgk" size="1.2rem"></iconpark-icon>
                                                        </span>
                                                        <span class="btn-tooltip">链接</span>
                                                    </div>
                                                    <div class="wbb-at absolute right-0 top-0 flex items-center justify-center h-full px-2 cursor-pointer bg-gray-400:hover">
                                                        <div id="cancelReply" onclick="cancelReply();" title="点击取消回复" style="display: none;">取消</div>
                                                    </div>
                                            </div>
                                        </div>
                                        <?php if ($this->user->hasLogin()): ?>
                                        <?php else: ?>
                                            <div class="wbb-info-body absolute bottom-10 w-full" style="display:none">
                                                <div class="md:flex">
                                                    <div class="form-group flex">
                                                        <input type="text" id="qqinfo" class="form-input w-full m-2" name="qqinfo" placeholder="QQ号可获取头像和昵称" onblur="fn_qqinfo()">
                                                        <input type="text" id="author" class="form-input w-full m-2" name="author" placeholder="* 怎么称呼" autocomplete="on" value="<?php $this->remember('author'); ?>" required="required">
                                                    </div>
                                                    <div class="form-group flex">
                                                        <input type="email" id="mail" class="form-input w-full m-2" name="mail" placeholder="<?php if ($this->options->commentsRequireMail): ?>* <?php endif; ?>邮箱(放心~会保密~.~)" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> autocomplete="on"  required="required"<?php endif; ?>  onblur="fn_email_info()" lay-verify="email">
                                                        <input type="url" id="url" class="form-input w-full m-2" name="url" placeholder="<?php if ($this->options->commentsRequireURL): ?>* <?php endif; ?><?php _e('http://您的主页'); ?>" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> autocomplete="on" required="required"<?php endif; ?> lay-verify="url">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="help-block help-block-error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="py-3 flex items-center justify-between">
                            <div class="form-group field-userinfo-email_close">
                                <div class="flex items-center">
                                    <input type="checkbox" id="secret-button" name="secret" value="1">
                                    <label class="ui-switch2 items-center" for="secret-button" title="开启该功能，您的动态仅作者和动态双方可见"></label>
                                    <span class="ml-4">隐私动态</span>
                                </div>
                            </div>
                            <button id="submitComment" type="submit" class="btn btn-default inline-flex items-center create_comment">
                                <span class="mr-2">
                                    <svg viewBox="0 0 512 512" class="h-3 w-3 fill-current">
                                        <path opacity=".4"
                                            d="M504.5 144.42L264.75 385.5 192 312.59l240.11-241c9.912-9.996 26.052-10.064 36.048-.152l.012.012.14.14L504.5 108c9.998 10.081 9.998 26.339 0 36.42z">
                                        </path>
                                        <path
                                            d="M264.67 385.59l-54.57 54.87c-9.92 9.996-26.063 10.058-36.06.14l-.14-.14L7.5 273.1c-10.003-10.076-10.003-26.334 0-36.41l36.2-36.41c9.902-9.97 26.004-10.045 36-.17l.16.17z">
                                        </path>
                                    </svg>
                                </span>
                                <span>提交</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        <?php else : ?>
            <h3 class="vcount" style="text-align: center;"> 动态已关闭 &gt;_&lt; </h3>
		<?php endif; ?>

        <div class="v-comment" >
            <div class="Comments-lists">
                <?php if ($comments->have()): ?>
                    <?php $comments->listComments(); ?>
                    <?php $comments->pageNav('<', '>', 1, ''); ?>
                <?php endif; ?>	
            </div>
        </div>

	</section>

    
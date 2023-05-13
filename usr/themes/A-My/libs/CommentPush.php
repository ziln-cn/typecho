<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/* 邮件通知 */
if (
    Helper::options()->CommentsMail === 'on' &&
    Helper::options()->CommentsMailHost &&
    Helper::options()->CommentsMailPort &&
    Helper::options()->CommentsMailFromName &&
    Helper::options()->CommentsMailAccount &&
    Helper::options()->CommentsMailPassword &&
    Helper::options()->CommentsSMTPSecure
) {
    Typecho_Plugin::factory('Widget_Feedback')->finishComment = array('Email', 'send');
}

class Email
{
    public static function send($comment)
    {
        $options = Typecho_Widget::widget('Widget_Options');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPSecure = Helper::options()->CommentsSMTPSecure;
        $mail->Host = Helper::options()->CommentsMailHost;
        $mail->Port = Helper::options()->CommentsMailPort;
        $mail->FromName = Helper::options()->CommentsMailFromName;
        $mail->Username = Helper::options()->CommentsMailAccount;
        $mail->From = Helper::options()->CommentsMailAccount;
        $mail->Password = Helper::options()->CommentsMailPassword;
        $mail->isHTML(true);
        $date = new Typecho_Date($comment->created);
        $time = $date->format('Y-m-d H:i:s');
        $text = $comment->text;
        $text = Comments::parseBiaoQing($comment->text);
        $AuthorHtml = Helper::options()->CommentsToMailAuthorHtml;
        $ParentHtml = Helper::options()->CommentsToMailParentHtml;
        $status = array(
            "approved" => '通过',
            "waiting"  => '待审',
            "spam"     => '垃圾'
        );
        $manage = $options->siteUrl . 'admin/manage-comments.php';
        $sitename = $options->title ;
        /* 如果是博主发的评论 */
        if ($comment->authorId == $comment->ownerId) {
            /* 发表的评论是回复别人 */
            if ($comment->parent != 0) {
                $db = Typecho_Db::get();
                $parentInfo = $db->fetchRow($db->select('author', 'mail', 'text')->from('table.comments')->where('coid = ?', $comment->parent));
                $parentAuthor = $parentInfo['author'];
                $parentMail = $parentInfo['mail'];
                $parentText = Comments::parseBiaoQing($parentInfo['text']);
                $imgUrl = utils::ParseAvatar($comment->mail);
                $parentImgUrl = utils::ParseAvatar($parentMail);
                /* 被回复的人不是自己时，发送邮件 */
                if ($parentMail != $comment->mail) {
                    $mail->Body = strtr(
                        $ParentHtml,
                        array(
                            "{title}" => '' . $comment->title . '',
                            "{author}" => '' . $comment->author . '',
                            "{parentAuthor}" => $parentAuthor,
                            "{ip}" => '' . $comment->ip . '',
                            "{parentMail}" => $parentMail,
                            "{mail}" => '' . $comment->mail . '',
                            "{time}" => $time,
                            "{permalink}" => '' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '',
                            "{content}" => $text,
                            "{parentContent}" => $parentText,
                            "{imgUrl}" => $imgUrl,
                            "{parentImgUrl}" => $parentImgUrl,
                        )
                    );
                    $mail->addAddress($parentMail);
                    $mail->Subject = '您在 '. $sitename . ' [' . $comment->title . '] 中评论有了新的回复！';
                    $mail->send();
                }
            }
            /* 如果是游客发的评论 */
        } else {
            /* 如果是直接发表的评论，不是回复别人，那么发送邮件给博主 */
            if ($comment->parent == 0) {
                $db = Typecho_Db::get();
                $authoInfo = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', $comment->ownerId));
                $authorMail = $authoInfo['mail'];
                $imgUrl = utils::ParseAvatar($comment->mail);
                if ($authorMail) {
                    $mail->Body = strtr(
                        $AuthorHtml,
                        array(
                            "{title}" => '' . $comment->title . '',
                            "{author}" => '' . $comment->author . '',
                            "{ip}" => '' . $comment->ip . '',
                            "{mail}" => '' . $comment->mail . '',
                            "{time}" => $time,
                            "{permalink}" => '' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '',
                            "{content}" => $text,
                            "{status}" => $status[$comment->status],
                            "{manage}" => $manage,
                            "{imgUrl}" => $imgUrl,
                        )
                    );
                    $mail->addAddress($authorMail);
                    $mail->Subject = '博客评论通知小助手：您的文章 [' . $comment->title . '] 收到一条新的评论！';
                    $mail->send();
                }
                /* 如果发表的评论是回复别人 */
            } else {
                $db = Typecho_Db::get();
                $parentInfo = $db->fetchRow($db->select('author', 'mail', 'text')->from('table.comments')->where('coid = ?', $comment->parent));
                $parentAuthor = $parentInfo['author'];
                $parentMail = $parentInfo['mail'];
                $parentText = Comments::parseBiaoQing($parentInfo['text']);
                $imgUrl = utils::ParseAvatar($comment->mail);
                $parentImgUrl = utils::ParseAvatar($parentMail);
                /* 被回复的人不是自己时，发送邮件 */
                if ($parentMail != $comment->mail) {
                    $mail->Body = strtr(
                        $ParentHtml,
                        array(
                            "{title}" => '' . $comment->title . '',
                            "{author}" => '' . $comment->author . '',
                            "{parentAuthor}" => $parentAuthor,
                            "{ip}" => '' . $comment->ip . '',
                            "{parentMail}" => $parentMail,
                            "{mail}" => '' . $comment->mail . '',
                            "{time}" => $time,
                            "{permalink}" => '' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '',
                            "{content}" => $text,
                            "{parentContent}" => $parentText,
                            "{imgUrl}" => $imgUrl,
                            "{parentImgUrl}" => $parentImgUrl,
                        )
                    );
                    $mail->addAddress($parentMail);
                    $mail->Subject = '您在 '. $sitename . '  [' . $comment->title . '] 中评论有了新的回复！';
                    $mail->send();
                }
            }
        }
    }
}

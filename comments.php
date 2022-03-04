<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
        <h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>

        <?php $comments->listComments(); ?>

        <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

    <?php endif; ?>

<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>
 
<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>">
        <div class="comment-author">
            <?php $comments->gravatar('40', ''); ?>
            <div class='comment-meta'>
                <cite class="fn"><?php $comments->author(); ?></cite>
                <a href="<?php $comments->permalink(); ?>"><?php $comments->date('Y-m-d H:i'); ?></a>
            </div>
        </div>
        <div class="comment-content">
            <?php $comments->content(); ?><span class="comment-reply">
            <?php $comments->reply(); ?></span>
        </div>
        
    </div>
<?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>

    <?php if ($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
            </div>

            <h3 id="response"><?php _e('添加新评论'); ?></h3>
            <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                <p>
                    <label for="textarea" class="required"></label>
                    <textarea rows="6" cols="50" name="text" id="textarea" class="textarea"
                              required><?php $this->remember('text'); ?></textarea>
                </p>
                <div class='postuser'>
                    <?php if ($this->user->hasLogin()): ?>
                        <p><a
                                href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> <a
                                href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('&nbsp退出'); ?></a>
                        </p>
                    <?php else: ?>

                            
                            <input type="text" name="author" id="author" class="text" placeholder="<?php _e('昵称...'); ?>"
                                value="<?php $this->remember('author'); ?>" required/>
                        
                        
                            
                            <input type="email" name="mail" id="mail" class="text" placeholder="<?php _e('邮箱.'); ?>"
                                value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                        
                           
                            <input type="url" name="url" id="url" class="text" placeholder="<?php _e('网址..'); ?>"
                                value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                        
                    <?php endif; ?>
                    <button type="submit" class="submit"><?php _e('提交'); ?></button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>

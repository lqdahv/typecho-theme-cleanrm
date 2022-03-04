<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-mb-12 col-offset-1 col-3 kit-hidden-tb" id="secondary" role="complementary">
    <div class="sidebarfixed">
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock)): ?>
        <section class="widget-three">
            <div class="widget-title">
                <p><?php _e('热评'); ?><span></span></p>
                <p><?php _e('随机'); ?><span></span></p>
                <p><?php _e('热门'); ?><span></span></p>

            </div>
            
            <div class='widget-list-all'>
                <ul class='widget-list'>
                    <?php getHotComments(6);?>
                </ul>
                <ul class='widget-list'>
                    <?php theme_random_posts(5);?>
                </ul>
                <ul class='widget-list'>
                    <?php getHotViews(5);?>
                </ul>
                
            </div>
        </section>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
        <section class="widget-comments">
            <div class="widget-title">
                <p><span><?php _e('最近回复'); ?></span></p>
            </div>
            <ul class="widget-list">
                <?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
                <?php while ($comments->next()): ?>
                    <li>
                        <a href="<?php $comments->permalink(); ?>">
                            <div>
                                <p><?php echo mb_strimwidth($comments->author,0,10,'..','utf-8'); ?></p>
                                <span><?php $comments->date('m-d'); ?>:</span>
                            </div>
                            <p><?php $comments->excerpt(24, '...'); ?></p>
                        </a>
                    </li>
                <?php endwhile; ?>
            </ul>

        </section>
    <?php endif; ?>

    <section class="widget-tags">
        <div class="widget-title">
            <p><span><?php _e('标签云'); ?></span></p>
        </div>
        <?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=30')->to($tags); ?>
        <ul class="widget-list">
            <?php while($tags->next()): ?>
                <li><a style="color: rgb(<?php echo(rand(0, 255)); ?>, <?php echo(rand(0,165)); ?>, <?php echo(rand(0, 165)); ?>)" href="<?php $tags->permalink(); ?>" title='<?php $tags->name(); ?>'><?php $tags->name(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </section>
  <!--  <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <p class="widget-title"><?php _e('分类'); ?></p>
            <?php \Widget\Metas\Category\Rows::alloc()->listCategories('wrapClass=widget-list'); ?>
        </section>
    <?php endif; ?>

    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <p class="widget-title"><?php _e('归档'); ?></p>
            <ul class="widget-list">
                <?php \Widget\Contents\Post\Date::alloc('type=month&format=F Y')
                    ->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
            </ul>
        </section>
    <?php endif; ?> -->
<!--
    <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <hp class="widget-title"><?php _e('其它'); ?></p>
            <ul class="widget-list">
                <?php if ($this->user->hasLogin()): ?>
                    <li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?>
                            (<?php $this->user->screenName(); ?>)</a></li>
                    <li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
                <?php else: ?>
                    <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a>
                    </li>
                <?php endif; ?>
                <li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
                <li><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
                <li><a href="http://www.typecho.org">Typecho</a></li>
            </ul>
        </section>
    <?php endif; ?>-->
    </div>
</div><!-- end #sidebar -->
                </div>
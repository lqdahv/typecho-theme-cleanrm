<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php get_post_view($this) ?>
<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post-in" itemscope itemtype="http://schema.org/BlogPosting">
    <span><?php $this->category(','); ?></span>
        <h1 class="post-title" itemprop="name headline">
            <a itemprop="url"
               href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
        </h1>
        <ul class="post-meta">
            <li>
                创建: <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y年m月d日'); ?></time>
            </li>
            <li>字数: <?php echo mb_strlen($this->text,'UTF-8') ?></li>
            <li>评论: <?php echo $this->commentsNum ?></li>
            <li>阅读: <?php getPostViews($this->cid) ?></li>
        </ul>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>

        <p itemprop="keywords" class="tags"><?php _e('标签: '); ?><?php $tagsarr=$this->tags;
            foreach($tagsarr as $value): ?>
            <a href="<?php echo $value['permalink'] ?>"><span style="color:rgb(<?php echo rand(0,255) ?>,<?php echo rand(0,165) ?>,<?php echo rand(0,165) ?>)"><?php  echo $value['name'] ?></span></a>&nbsp;&nbsp;
            <?php endforeach; ?>
        </p>

    </article>

    <?php $this->need('comments.php'); ?>

    <ul class="post-near">
        <li>上一篇: <?php $this->thePrev('%s', '没有了'); ?></li>
        <li>下一篇: <?php $this->theNext('%s', '没有了'); ?></li>
    </ul>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>

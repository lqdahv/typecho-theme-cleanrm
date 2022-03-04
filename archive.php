<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php 
    switch($this->archiveType){
        case 'category':
            $archive=array('分类','下的文章');
            break;
        case 'tag':
            $archive=array('标签','下的文章');
            break;
        case 'search':
            $archive=array('包含关键字','的文章');
            break;
    }

?>

<div class="col-mb-12 col-8" id="main" role="main">
    <p class="archive-title"><span><?php echo $archive[0] ?></span><span><?php $this->archiveTitle([
            'category' => _t(' %s '),
            'search'   => _t(' %s '),
            'tag'      => _t(' %s '),
            'author'   => _t(' %s ')
        ], '', ''); ?></span><span><?php echo $archive[1] ?></span></p>

    <?php if ($this->have()): ?>
        <?php while ($this->next()): ?>
            <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
            <?php preg_match_all('/https?:\/\/.+.(svg|png|jpg|jpeg|gif)$/',$this->text,$defaultImg); ?>
                <?php if(isset($defaultImg[0][0])): ?>
                    <img src=<?php echo $defaultImg[0][0] ?>/>
                <?php else: ?>
                    <img src=<?php $this->options->defaultImg() ?>>
                <?php endif ?>
                <div>
                    <h3 class="post-title" itemprop="name headline"><a itemprop="url"
                                                                    href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                    </h3>
                    <div class="post-content" itemprop="articleBody">
                        <?php $this->excerpt(70,'...'); ?>
                    </div>
                    <ul class="post-meta">
                        <li>
                            <time datetime="<?php $this->date('Y年m月d日'); ?>"
                                itemprop="datePublished"><?php $this->date(); ?></time>
                        </li>
                        <li><?php $this->category(','); ?></li>
                        <li itemprop="interactionCount"><a
                                href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 评论', '1 条评论', '%d 条评论'); ?></a>
                        </li>
                    </ul>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <article class="not-post">
            <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
            <img src="http://localhost/typecho/usr/themes/mytheme/img/not_found.png" />
        </article>
    <?php endif; ?>

    <?php $this->pageNav('上一页', '下一页'); ?>
</div><!-- end #main -->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>

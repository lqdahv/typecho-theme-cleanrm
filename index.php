<?php
/**
 * Default theme for Typecho
 *
 * @package 我的主题
 * @author Typecho Team
 * @version 1.2
 * @link http://typecho.org
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div class="col-mb-12 col-8" id="main" role="main">
    <?php while ($this->next()): ?>
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
                <?php preg_match_all('/https?:\/\/.+.(svg|png|jpg|jpeg|gif)$/',$this->text,$defaultImg); ?>
                <?php if(isset($defaultImg[0][0])): ?>
                    <img src='<?php echo $defaultImg[0][0] ?>'>
                <?php else: ?>
                    <img src=<?php $this->options->defaultImg() ?>>
                <?php endif ?>
            <div>
                <h3 class="post-title" itemprop="name headline">
                    <a itemprop="url"
                    href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                </h3>
                <div class="post-content" itemprop="articleBody">
                    <?php $this->excerpt(56,'...'); ?>
                </div>
                <ul class="post-meta">
   
                    <li>
                        <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date("Y年m月d日"); ?></time>
                    </li>
                    <li><?php $this->category(','); ?></li>
                    <li itemprop="interactionCount">
                        <a itemprop="discussionUrl"
                        href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></a>
                    </li>
                </ul>
            </div>
        </article>
    <?php endwhile; ?>

    <?php $this->pageNav('前一页', '后一页'); ?>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>

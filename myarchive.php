<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * 归档
 *
 * @package custom
 */
 $this->need('header.php'); ?>
    <?php
        $stat = Typecho_Widget::widget('Widget_Stat');
        Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($archives);
        $year=0; $mon=0; $i=0; $j=0;$yearsarray=array();
        while($archives->next()){
            $year_tmp = date('Y',$archives->created);
            $mon_tmp = date('m',$archives->created);
            $y=$year; $m=$mon;
            if ($year > $year_tmp || $mon > $mon_tmp) {
            }
            if ($year != $year_tmp || $mon != $mon_tmp) {
                $year = $year_tmp;
                $mon = $mon_tmp;
                array_push($yearsarray,$year);
            }
        }
    ?>
<div class="col-mb-12 col-8" id="main" role="main">
    <article class="myarchive-post" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="toyear">
            <?php $array=array_unique($yearsarray); foreach($array as $value): ?>
                <p><a href='#<?php echo $value  ?>'><?php echo $value  ?></a></p>
            <?php endforeach; ?>
        </div>
        <h1 class="post-title" itemprop="name headline">
            <a itemprop="url"
               href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
        </h1>
        <div class="post-content" itemprop="articleBody">
       
        
<!--列表-->
    <div class="col-md-12">
        <article class="page-wrapper" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="post-content" itemprop="articleBody">
                <?php
                    $output = '<div class="myarchives">';
                    while($archives->next()){
                        $year_tmp = date('Y',$archives->created);
                        $mon_tmp = date('m',$archives->created);
                        $y=$year; $m=$mon;
                        if ($year > $year_tmp || $mon > $mon_tmp) {
                            $output .= '</ul></div>';
                        }
                        if ($year != $year_tmp || $mon != $mon_tmp) {
                            $year = $year_tmp;
                            $mon = $mon_tmp;
                            array_push($yearsarray,$year);
                            $output .= '<div class="archives-item"><h3 id='.date('Y',$archives->created).'>'.date('Y年',$archives->created).'</h3><span>'.date('m月',$archives->created).'</span><ul class="archives_list">'; //输出年份
                        }
                        $output .= '<li><span>'.date('d日',$archives->created).'</span><a href="'.$archives->permalink .'">'. $archives->title .'</a></li>'; //输出文章
                    }
                    $output .= '</ul></div></div>';
                    echo $output;
                ?>
            </div>
        </article>
    </div><!-- end #main-->


        </div>
    </article>
</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>

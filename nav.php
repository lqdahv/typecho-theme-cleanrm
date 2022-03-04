<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>



<header id="header" class="clearfix">
    <div class="container">
        <div class="row">
            <div class="site-name">
                <a href="javascript:"><i class="fa-solid fa-bars"></i></a>
                <a class='avatar' href="<?php $this->options->siteUrl(); ?>"><img src='https://t8.baidu.com/it/u=3519876884,1571025239&fm=218&app=126&f=JPEG?w=121&h=75&s=8881CF14410B52E908F471D9030090A2' alt='站名图片'/></a>
                <div class='site-name-right'>
                    <a id="logo" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
                    <p class="description"><?php $this->options->description() ?></p>
                </div>
                <i></i>
            </div>
            <div id="nav">
                <nav id="nav-menu" class="clearfix" role="navigation">
                    <ul>
                        <li><a href="<?php $this->options->siteUrl(); ?>"><span>首页</sapn></a></li>
                        <li class='catLi'>
                            <a class='openCat'><span>分类 <i class="fa-solid fa-caret-down"></i></span></i></a>
                            <ul class='catUl'>
                                <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>

                                <?php $array=array(); while($category->next()): ?>
                                    <?php array_push($array,intval($category->count)) ?>
                                <?php endwhile; $sum=array_sum($array) ?>

                                <?php while($category->next()): ?>
                                    <li><a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><span><?php $category->name(); ?></span><span><?php $category->count(); ?></span></a></li>
                                    <div style='width:<?php _e(round($category->count/$sum*100)) ?>%'></div>
                                <?php endwhile;?>
                            </ul>
                        </li>
                        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                        <?php while($pages->next()): ?>
                            <li><a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </nav>
            </div>
            <div class="site-search">
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" id="s" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" autocomplete='off' />
                </form>
            </div>
           <!-- <a href="javascript:">
                <i class="fa-solid fa-gear"></i>
            </a>-->
            <!-- 单独设置投影，设置header投影的话会被侧边栏挡住 -->
            <div class="placeshadow"></div>
           
        </div><!-- end .row -->
    </div>
</header><!-- end #header -->
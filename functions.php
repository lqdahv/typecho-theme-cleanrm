<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form)
{
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'logoUrl',
        null,
        null,
        _t('站点 LOGO 址'),
        _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO')
    );

    $form->addInput($logoUrl);

    $defaultImg = new Typecho_Widget_Helper_Form_Element_Text(
        'defaultImg',
        null,
        null,
        _t('首页默认的缩略图'),
        _t('在这里填入一个图片 URL 地址')
    );

    $form->addInput($defaultImg);

    $sidebarBlock = new \Typecho\Widget\Helper\Form\Element\Checkbox(
        'sidebarBlock',
        [
            'ShowRecentPosts'    => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'ShowCategory'       => _t('显示分类'),
            'ShowArchive'        => _t('显示归档'),
            'ShowOther'          => _t('显示其它杂项')
        ],
        ['ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'],
        _t('侧边栏显')
    );

    $form->addInput($sidebarBlock->multiMode());
}
//热评文章
function getHotComments($limit = 5){
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
        ->limit($limit)
        ->order('commentsNum', Typecho_Db::SORT_DESC)
    );
    if($result){
        foreach($result as $val){            
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
            $post_title = htmlspecialchars($val['title']);
            $permalink = $val['permalink'];
            $commentsNum=$val['commentsNum'];
            echo '<li><a href="'.$permalink.'" title="'.$post_title.'"><span>'.$post_title.'</span><span><i class="fa-regular fa-comment"></i>'.$commentsNum.'</span></a></li>';
            //var_dump($val);     
        }
    }
}
//随机文章
function theme_random_posts($limit=5){
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select()->from('table.contents')
    ->where('status = ?','publish')
    ->where('type = ?', 'post')
    ->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
    ->limit($limit)
    ->order('RAND()')
    );
    if($result){
        foreach($result as $val){
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
            $post_title = htmlspecialchars($val['title']);
            $permalink = $val['permalink'];
            $commentsNum=($val['date']->month).'/'.($val['date']->day);
            echo '<li><a href="'.$permalink.'" title="'.$post_title.'"><span>'.$post_title.'</span><span>'.$commentsNum.'</span></a></li>';
        }
    }
}
    
function get_post_view($archive){
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
    $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
    echo 0;
    return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
    $views = Typecho_Cookie::get('extend_contents_views');
    if(empty($views)){
    $views = array();
    }else{
    $views = explode(',', $views);
    }
    if(!in_array($cid,$views)){
    $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
    array_push($views, $cid);
    $views = implode(',', $views);
    Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
    }
    }
    //echo $row['views'];
}

function getHotViews($limit = 5){
    $db = Typecho_Db::get();
    $result = $db->fetchAll($db->select()->from('table.contents')
        ->where('status = ?','publish')
        ->where('type = ?', 'post')
        ->where('created <= unix_timestamp(now())', 'post') //添加这一句避免未达到时间的文章提前曝光
        ->limit($limit)
        ->order('views', Typecho_Db::SORT_DESC)
    );
    if($result){
        foreach($result as $val){            
            $val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
            $post_title = htmlspecialchars($val['title']);
            $permalink = $val['permalink'];
            $views=$val['views'];
            echo '<li><a href="'.$permalink.'" title="'.$post_title.'"><span>'.$post_title.'</span><span><i class="fa-regular fa-eye"></i>'.$views.'</span></a></li>';
            //var_dump($val);     
        }
    }
}

function getPostViews($cid){
    $db = Typecho_Db::get();
    $result = $db->fetchRow($db->select()->from('table.contents')
        ->where('cid = ?',$cid)
    );
    if($result){
        echo $result['views'];
    }
}

function themeInit($archive){
    if($archive->is('index')){
        $archive->parameter->pageSize=10;
    }elseif($archive->is('archive')){
        $archive->parameter->pageSize=10;
    }
}
/*
function themeFields($layout)
{
    $logoUrl = new \Typecho\Widget\Helper\Form\Element\Text(
        'logoUrl',
        null,
        null,
        _t('站点LOGO地址'),
        _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO')
    );
    $layout->addItem($logoUrl);
}
*/

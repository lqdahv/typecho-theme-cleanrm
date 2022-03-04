<?php

    echo '3';
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
getHotViews(5)
?>
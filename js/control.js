<script type="text/javascript">
    $('.openCat').on('click',function () {
        $('.catUl').slideToggle(100)
    })

    $('#nav-menu>ul>li>a').mouseover(function(){
        $(this).css({'color':'orange'})
    })
    $('#nav-menu>ul>li>a').mouseout(function(){
        $(this).css({'color':''})
    })
    //切换
    var now=0;
    $('.widget-three .widget-title').children().click(function(){
        if($(this).index()==now){return}
        $('.widget-list-all').children().hide()
        $('.widget-list-all').children().eq($(this).index()).fadeIn()
        now=$(this).index()
    })
    //横条
    $('.widget-three .widget-title').children().click(function(){
        $('.widget-three .widget-title span').css('opacity',0)
        $('.widget-three .widget-title span').eq($(this).index()).css('opacity',1)
    })
    $('.site-name>a:first-child').click(function(){
        if($('#header #nav').css('left')=='0px'){
            $('#header #nav').animate({
                left: '-45%'
            },100)
        }else{
            $('#header #nav').animate({
                left: '0%'
            },100)
        }
    })

</script>
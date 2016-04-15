<?//dd($url,$title,$description,$image);
$link = 'onclick="window.open(this.href,this.title,\'toolbar=0,status=0,width=548,height=325\'); return false" target="_parent" title="'.$title.'" ';
?>
<div class="share-box detail-info-entry">
    <div class="title">Поделиться</div>
    <div class="socials-box">
        <a {!! $link !!} href="http://www.facebook.com/sharer.php?u={{$url}}&p[title]={{$title}}&p[summary]={{$description}}&p[images][0]={{$image}}"><i class="fa fa-facebook"></i></a>
        <a {!! $link !!} href="http://twitter.com/share?text={{$title}}&url={{$url}}&counturl={{$url}}"><i class="fa fa-twitter"></i></a>
        <a {!! $link !!} href="https://plus.google.com/share?url={{$url}}"><i class="fa fa-google-plus"></i></a>
        <a {!! $link !!} href="https://www.linkedin.com/shareArticle?mini=true&url={{$url}}&title={{$title}}&summary={{$description}}"><i class="fa fa-linkedin"></i></a>
        <a {!! $link !!} href="http://vkontakte.ru/share.php?url={{$url}}&title={{$title}}&description={{$description}}&image={{$image}}&noparse=true"><i class="fa fa-vk"></i></a>
    </div>
    <div class="clear"></div>
</div>
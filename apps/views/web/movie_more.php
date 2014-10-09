<ul class="thm-mv">
<?php 
  $isLogin = (isset($memberLogin)&&$memberLogin)?'':' class="lb-popup" rel="#popup-login" ';
  foreach ($movies['items'] as $movie) {
    $popup = ($movie['is_18']=='YES')?' class="lb-popup'.($isLogin?' withlogin ':'').'" rel="#popup-age" ':$isLogin;
?>
  <li>
    <article>
        <a title="<?=$movie['title']?>" <?=$popup?> href="<?=base_url('/movie/'.$movie['movie_id'])?>">
            <img alt="<?=$movie['title_en']?>" src="<?=static_url($movie['cover'])?>">
            <h3><?=$movie['title']?></h3>
            <?php if($movie['is_soon']=='YES'){?>
            <span class="type soon">coming soon</span>
            <?php }elseif($movie['is_free']=='YES'){?>
            <span class="type free">Free</span>
            <?php }elseif($movie['is_hd']=='YES'){?>
            <span class="type HD">HD</span>
            <?php }?>
        </a>
        <footer>
          <p class="sm"><a href="javascript:;" title="รายการโปรด"> <?=$movie['summary']?></a></p>
          <p class="rating"><i class="icon-star<?=$movie['score']>0?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>1?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>2?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>3?"":" drop"?>"></i><i class="icon-star<?=$movie['score']>4?"":" drop"?>"></i></p>
          <p class="fv"><a href="javascript:;" title="รายการโปรด"><i class="icon-heart-empty"></i> รายการโปรด</a></p>
        </footer>
    </article>
  </li>
<?php }?>
</ul>
<?php if($movies['pageing']['page']<$movies['pageing']['maxPage']){?>
  <div class="ctrl-page">
    <a class="load-more" onclick="return nextpage();" href="<?=base_url($this->uri->uri_string().'/?'.(isset($search)?'q='.$search.'&':'').'more=1&page='.($movies['pageing']['page']+1).'&limit='.$movies['pageing']['itemPerPage'])?>" title="โหลดข้อมูลเพิ่ม">โหลดข้อมูลเพิ่ม <i class="icon-plus"></i></a>
  </div>
<?php }?>
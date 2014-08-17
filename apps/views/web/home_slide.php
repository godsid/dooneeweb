<!-- Highlight -->
      <section class="hl-slider container">
        <div id="slider" class="flexslider">
          <ul class="slides">
          <?php
            foreach ($banners as $banner) { ?>
              <li>
              <a href="<?=$banner['link']?>" title="<?=$banner['title']?>">
                <img src="<?=static_url($banner['cover'])?>" alt="">
                <div>
                    <h2><i class="icon-film"></i> <?=$banner['title']?></h2>
                    <p>...</p>
                </div>
              </a>
            </li>  
          <?php }?>
          </ul>
        </div>
        <div id="carousel" class="flexslider">
          <ul class="slides">
            <?php
            foreach ($banners as $banner) { ?>
              <li>
              <img src="<?=static_url($banner['cover'])?>" alt="">
            </li>
          <?php } ?>
          </ul>
        </div>
      </section>
      <!-- /Highlight --> 
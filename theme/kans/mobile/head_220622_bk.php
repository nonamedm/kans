<? include_once(G5_THEME_MOBILE_PATH.'/head_intro.php'); ?>

<!-- 컨텐츠 : 시작 -->
<header class="header">
   
   <div class="hd_nav clear">
      <div class="hd_bottom ct1 clear">
         <h1 class="logo"><a href="<?php echo G5_URL ?>"></a></h1>
         <nav class="gnb">
            <ul class="clear">
               <li> 
                  <a href="<?=$s1_1_1_1_url?>"><?=$s1_name?></a>
               </li>
               <li>
                  <a href="<?=$s1_2_1_1_url?>"><?=$s2_name?></a>
               </li>
               <li>
                  <a href="<?=$s1_2_2_url ?>"><?=$s3_name?></a>
               </li>
               <li>
                  <a href="<?=$s1_3_1_1_url?>"><?=$s4_name?></a>
               </li>
               <li>
                  <a href="<?=$s2_1_url?>"><?=$s5_name?></a>
               </li>
            </ul>

         </nav>
         <div class="hd_right">
            <div class="hd_sch">
               <figure><img src="<? echo G5_THEME_URL ?>/images/layout/hd_sch.png" /></figure>
               <div class="cnt"><? include_once('hd_sch.php'); ?></div>
            </div>
            <a href="" class="site_map btn_sitemap"><img src="<? echo G5_THEME_URL ?>/images/layout/hd_site.png" /></a>
         </div>
      </div>
   </div>

</header>




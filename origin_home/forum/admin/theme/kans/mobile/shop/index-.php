<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
add_javascript('<script src="'.G5_THEME_JS_URL.'/Ublue-jQueryTabs-1.2.js"></script>', 10);
?>

<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>

<div id="idx_container_wr">
    <!-- 쇼핑몰 배너 시작 { -->
    <?php echo display_banner('왼쪽'); ?>
    <!-- } 쇼핑몰 배너 끝 -->

    <?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>

    <div id="sidx" class="tab-wr">
        <ul class="tabsTit">
            <li class="tabsTab tabsHover">히트상품</li>
            <li class="tabsTab">추천상품</li>
            <li class="tabsTab">최신상품</li>
            <li class="tabsTab">인기상품</li>
            <li class="tabsTab">할인상품</li>
        </ul>
        <ul class="tabsCon">
            <li class="tabsList" readonly="true">
                <?php if($default['de_mobile_type1_list_use']) { ?>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_type(1);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
                <?php } ?>
            </li>
            <li class="tabsList">
                <?php if($default['de_mobile_type2_list_use']) { ?>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_type(2);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
                <?php } ?>
            </li>
            <li class="tabsList">
                <?php if($default['de_mobile_type3_list_use']) { ?>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_type(3);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
                <?php } ?>
            </li>
            <li class="tabsList">
                <?php if($default['de_mobile_type4_list_use']) { ?>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_type(4);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
                <?php } ?>
            </li>
            <li class="tabsList">
                <?php if($default['de_mobile_type5_list_use']) { ?>
                <?php
                $list = new item_list();
                $list->set_mobile(true);
                $list->set_type(5);
                $list->set_view('it_id', false);
                $list->set_view('it_name', true);
                $list->set_view('it_cust_price', false);
                $list->set_view('it_price', true);
                $list->set_view('it_icon', true);
                $list->set_view('sns', false);
                echo $list->run();
                ?>
                <?php } ?>
            </li>

        </ul>


    </div>
    <script>
    $("#sidx").UblueTabs({
        eventType:"click"
    });
    </script>

    <!--사진게시판-->
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수, 캐시타임, option);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        $options = array(
            'thumb_width'    => 300, // 썸네일 width
            'thumb_height'   => 300,  // 썸네일 height
        );
        echo latest('theme/gallery', 'notice', 6, 55, 1, $options);
        ?>
    <!--사진게시판-->
</div>
    <script>
        $("#container").addClass("container-index").removeClass("container");
    </script>

<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>
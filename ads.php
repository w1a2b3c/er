 <!--自助广告位开始-->
            <style type='text/css'>
                .index-card {margin-bottom: 10px;border-radius: 2px;background-color: #fff;border: 1px solid #eaeaea;}
                .index-site-list {display: block;overflow: hidden;clear: both;}
                .index-site-list li{float: left;line-height: 3.3;height: 41.9px;text-align: center;border:1px #efefef solid;border-width: 1px 1px 0px 0px;}
                .index-site-list li a{display: block;color: #666;font-size: 13px;display: inline-block;height: 33px;overflow: hidden;}
                .index-site-list li.site-recommend:nth-child(1n) a{color: #1E9FFF;}
                .index-site-list li.site-recommend:nth-child(2n) a{color: #FF5722;}
                .index-site-list li.site-recommend:nth-child(3n) a{color: #5FB878;}
                .index-site-list li a img{width: 14px;height: 14px;position: relative;top: -2px;margin-right: 3px;}
                .index-site-list li{width: 25%;}
                .index-site-list li:nth-child(5n){border-right: none;}
                .index-site-list li:nth-child(5n){border-right: 1px #efefef solid;}
            </style>


        <?php

            include_once "./ad/ad.php";
            echo '<div class="index-top-ad">';

            //大横幅 ./ad/go.php?url=
            for ($i=0;$i<count($bigAdListData);$i++){
                echo '<div>
                         <a href="'.$bigAdListData[$i]['ad_url'].'" class="bigAd" rel="nofollow" target="_blank">
                             <img alt="广告招商" src="'.$bigAdListData[$i]['ad_img'].'" style="height: 80px; width: 100%;margin-top: 1px" />
                         </a>
                     </div>';
            }


            //小横幅

            for ($i=0;$i<count($smallAdListData);$i=$i+2){
                echo '<span>
                        <a href="'.$smallAdListData[$i]['ad_url'].'" class="smallAd" rel="nofollow" target="_blank">
                            <img alt="广告招商" src="'.$smallAdListData[$i]['ad_img'].'" style="height: 80px; width: 100%;" />
                        </a>
                        <a href="'.$smallAdListData[$i+1]['ad_url'].'" class="smallAd" target="_blank">
                            <img alt="广告招商" src="'.$smallAdListData[$i+1]['ad_img'].'" style="height: 80px; width: 100%;" />
                        </a>
                    </span>';

            }

            echo '</div>';


            //文字广告
            echo '<div class="index-card">
                           <div class="site-list-body">
                               <ul class="index-site-list">';
            for ($i=0;$i<count($wordAdListData);$i++){
                echo '<li style="background: '.$wordAdListData[$i]['ad_background'].'; ">
                            <a href="'.$wordAdListData[$i]['ad_url'].'" class="wordAd"  target="_blank" rel="nofollow">
                                <span style="text-decoration: none;color:'.$wordAdListData[$i]['ad_text_color'].'">'.$wordAdListData[$i]['ad_title'].'</span>
                            </a>
                       </li>';
            }

            echo '  </ul>
                   </div>
               </div>';



            ?>


    <!--自助广告位结束-->

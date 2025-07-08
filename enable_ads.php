<?php
/**
 * 广告位启用文件
 * 使用方法：将此文件内容复制到 header.php 中的广告位区域
 */

// 检查数据库表是否存在
function checkAdsTable() {
    global $DB;
    try {
        $result = $DB->query("SHOW TABLES LIKE 'zzdh_ads'");
        return $DB->fetch($result) ? true : false;
    } catch (Exception $e) {
        return false;
    }
}

// 获取广告位数据
function getAdsData() {
    global $DB, $conf;
    $ads = [];
    
    if (!checkAdsTable()) {
        return $ads;
    }
    
    try {
        $result = $DB->query("SELECT id, name, url, img FROM zzdh_ads WHERE status = 1 ORDER BY sort_order ASC, id ASC LIMIT 10");
        if ($result) {
            while ($row = $DB->fetch($result)) {
                $ad_img = $row['img'];
                if (empty($ad_img)) {
                    preg_match('/^(http:\/\/|https:\/\/)?([^\/]+)/i', $row['url'], $url_parts);
                    $domain = isset($url_parts[2]) ? $url_parts[2] : '';
                    $ad_img = $conf['ico_api'] . $domain;
                }
                
                $ads[] = [
                    'name' => $row['name'],
                    'url' => $row['url'],
                    'img' => $ad_img
                ];
            }
        }
    } catch (Exception $e) {
        // 静默处理错误
    }
    
    return $ads;
}

// 生成广告位HTML
function generateAdsHTML() {
    $ads = getAdsData();
    $html = '';
    
    foreach ($ads as $ad) {
        $html .= '<div class="ad-banner-item" style="background: linear-gradient(135deg, #ffb6ec 0%, #aee2ff 100%); border-radius: 8px; padding: 8px; text-align: center; box-shadow: 0 2px 8px rgba(255,182,236,0.3); transition: all 0.3s ease; cursor: pointer;" 
                 onclick="window.open(\'' . htmlspecialchars($ad['url']) . '\', \'_blank\')" 
                 title="' . htmlspecialchars($ad['name']) . '">
            <div class="ad-icon" style="margin-bottom: 4px;">
                <img src="' . htmlspecialchars($ad['img']) . '" 
                     alt="' . htmlspecialchars($ad['name']) . '" 
                     style="width: 24px; height: 24px; border-radius: 4px; object-fit: cover;"
                     onerror="this.src=\'assets/images/default_ico.png\';">
            </div>
            <div class="ad-name" style="font-size: 10px; color: #fff; font-weight: bold; text-shadow: 0 1px 2px rgba(0,0,0,0.3); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                ' . htmlspecialchars($ad['name']) . '
            </div>
        </div>';
    }
    
    // 填充剩余位置
    for ($i = count($ads); $i < 10; $i++) {
        $html .= '<div class="ad-banner-item" style="background: rgba(255,255,255,0.1); border-radius: 8px; padding: 8px; text-align: center; border: 2px dashed rgba(255,182,236,0.3);">
            <div class="ad-icon" style="margin-bottom: 4px;">
                <div style="width: 24px; height: 24px; border-radius: 4px; background: rgba(255,255,255,0.2); margin: 0 auto;"></div>
            </div>
            <div class="ad-name" style="font-size: 10px; color: rgba(255,255,255,0.5);">
                广告位' . ($i + 1) . '
            </div>
        </div>';
    }
    
    return $html;
}

// 如果直接访问此文件，显示广告位HTML
if (basename($_SERVER['SCRIPT_NAME']) == 'enable_ads.php') {
    echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>广告位预览</title>
    <style>
        .ad-banner-container { margin-top: 20px; padding: 0 20px; }
        .ad-banner-grid { display: grid; grid-template-columns: repeat(10, 1fr); gap: 8px; max-width: 1200px; margin: 0 auto; }
        .ad-banner-item:hover { transform: translateY(-2px); box-shadow: 0 4px 16px rgba(255,182,236,0.5); }
        @media (max-width: 768px) {
            .ad-banner-grid { grid-template-columns: repeat(5, 1fr) !important; gap: 4px !important; }
            .ad-banner-item { padding: 6px !important; }
            .ad-name { font-size: 8px !important; }
        }
    </style>
</head>
<body>
    <div class="ad-banner-container">
        <div class="ad-banner-grid">';
    
    echo generateAdsHTML();
    
    echo '</div>
    </div>
    <p style="text-align: center; margin-top: 20px;">
        <strong>使用方法：</strong><br>
        1. 确保已创建 zzdh_ads 表<br>
        2. 在后台添加广告位数据<br>
        3. 将以下代码复制到 header.php 中的广告位区域：
    </p>
    <pre style="background: #f5f5f5; padding: 15px; margin: 20px; border-radius: 5px; overflow-x: auto;">
&lt;!-- 广告位展示区域 --&gt;
&lt;div class="ad-banner-container" style="margin-top: 20px; padding: 0 20px;"&gt;
    &lt;div class="ad-banner-grid" style="display: grid; grid-template-columns: repeat(10, 1fr); gap: 8px; max-width: 1200px; margin: 0 auto;"&gt;
        &lt;?php
        // 获取广告位数据
        $ads = getAdsData();
        foreach ($ads as $ad) {
            echo \'&lt;div class="ad-banner-item" style="background: linear-gradient(135deg, #ffb6ec 0%, #aee2ff 100%); border-radius: 8px; padding: 8px; text-align: center; box-shadow: 0 2px 8px rgba(255,182,236,0.3); transition: all 0.3s ease; cursor: pointer;" 
                 onclick="window.open(\\\'\' . htmlspecialchars($ad[\'url\']) . \'\\\', \\\'_blank\\\')" 
                 title="\' . htmlspecialchars($ad[\'name\']) . \'"&gt;
                &lt;div class="ad-icon" style="margin-bottom: 4px;"&gt;
                    &lt;img src="\' . htmlspecialchars($ad[\'img\']) . \'" 
                         alt="\' . htmlspecialchars($ad[\'name\']) . \'" 
                         style="width: 24px; height: 24px; border-radius: 4px; object-fit: cover;"
                         onerror="this.src=\\\'assets/images/default_ico.png\\\';"&gt;
                &lt;/div&gt;
                &lt;div class="ad-name" style="font-size: 10px; color: #fff; font-weight: bold; text-shadow: 0 1px 2px rgba(0,0,0,0.3); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"&gt;
                    \' . htmlspecialchars($ad[\'name\']) . \'
                &lt;/div&gt;
            &lt;/div&gt;\';
        }
        
        // 填充剩余位置
        for ($i = count($ads); $i &lt; 10; $i++) {
            echo \'&lt;div class="ad-banner-item" style="background: rgba(255,255,255,0.1); border-radius: 8px; padding: 8px; text-align: center; border: 2px dashed rgba(255,182,236,0.3);"&gt;
                &lt;div class="ad-icon" style="margin-bottom: 4px;"&gt;
                    &lt;div style="width: 24px; height: 24px; border-radius: 4px; background: rgba(255,255,255,0.2); margin: 0 auto;"&gt;&lt;/div&gt;
                &lt;/div&gt;
                &lt;div class="ad-name" style="font-size: 10px; color: rgba(255,255,255,0.5);"&gt;
                    广告位\' . ($i + 1) . \'
                &lt;/div&gt;
            &lt;/div&gt;\';
        }
        ?&gt;
    &lt;/div&gt;
&lt;/div&gt;
    </pre>
</body>
</html>';
}
?> 
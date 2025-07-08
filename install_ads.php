<?php
/**
 * 广告位功能安装脚本
 * 用于自动创建广告位表并插入示例数据
 */

// 引入配置文件
require_once './config.php';

// 连接数据库
try {
    $pdo = new PDO("mysql:host={$dbconfig['host']};port={$dbconfig['port']};dbname={$dbconfig['dbname']};charset=utf8", 
                    $dbconfig['user'], 
                    $dbconfig['pwd']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "数据库连接成功！\n";
} catch(PDOException $e) {
    die("数据库连接失败: " . $e->getMessage() . "\n");
}

// 创建广告位表
$create_table_sql = "
CREATE TABLE IF NOT EXISTS `zzdh_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '网站名称',
  `url` varchar(255) NOT NULL COMMENT '网站地址',
  `img` varchar(255) DEFAULT NULL COMMENT '图标地址',
  `description` text COMMENT '网站描述',
  `sort_order` int(11) DEFAULT '0' COMMENT '排序，数字越小越靠前',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态：1启用，0禁用',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `sort_order` (`sort_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='广告位表';
";

try {
    $pdo->exec($create_table_sql);
    echo "广告位表创建成功！\n";
} catch(PDOException $e) {
    echo "创建表失败: " . $e->getMessage() . "\n";
}

// 检查表是否已存在数据
$check_sql = "SELECT COUNT(*) FROM zzdh_ads";
$stmt = $pdo->query($check_sql);
$count = $stmt->fetchColumn();

if ($count == 0) {
    // 插入示例数据
    $sample_data = [
        ['百度', 'https://www.baidu.com', '', '全球最大的中文搜索引擎', 1],
        ['腾讯', 'https://www.qq.com', '', '腾讯官方网站', 2],
        ['阿里巴巴', 'https://www.alibaba.com', '', '全球领先的B2B电子商务平台', 3],
        ['京东', 'https://www.jd.com', '', '中国最大的自营式电商企业', 4],
        ['网易', 'https://www.163.com', '', '网易官方网站', 5],
        ['新浪', 'https://www.sina.com.cn', '', '新浪官方网站', 6],
        ['搜狐', 'https://www.sohu.com', '', '搜狐官方网站', 7],
        ['凤凰网', 'https://www.ifeng.com', '', '凤凰网官方网站', 8],
        ['今日头条', 'https://www.toutiao.com', '', '今日头条官方网站', 9],
        ['知乎', 'https://www.zhihu.com', '', '知乎官方网站', 10]
    ];
    
    $insert_sql = "INSERT INTO zzdh_ads (name, url, img, description, sort_order, status, addtime) VALUES (?, ?, ?, ?, ?, 1, ?)";
    $stmt = $pdo->prepare($insert_sql);
    
    foreach ($sample_data as $data) {
        $stmt->execute([$data[0], $data[1], $data[2], $data[3], $data[4], time()]);
    }
    
    echo "示例数据插入成功！\n";
} else {
    echo "表中已有数据，跳过示例数据插入。\n";
}

echo "\n安装完成！\n";
echo "现在您可以：\n";
echo "1. 访问网站前台查看广告位效果\n";
echo "2. 登录后台管理 → 广告位管理 来管理广告位\n";
echo "3. 删除此安装文件 install_ads.php\n";
?> 
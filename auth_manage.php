<?php
// ====== 配置区 ======
$db_host = 'localhost';
$db_user = 'auth_api';
$db_pwd  = 'Rxt7meXtK6hGKzwG';
$db_name = 'auth_api';
$sign_key = '你的签名密钥'; // 这里设置你的密钥，和源码端保持一致
$admin_key = 'Wt1a2b3c4d06117632'; // 管理后台访问密钥

// ====== 数据库连接 ======
$conn = new mysqli($db_host, $db_user, $db_pwd, $db_name);
if ($conn->connect_error) {
    if (isset($_GET['domain'])) {
        die(json_encode(['auth'=>false, 'msg'=>'数据库连接失败']));
    } else {
        die('数据库连接失败');
    }
}
$conn->set_charset('utf8');

// ====== 授权API接口 ======
if (isset($_GET['data'])) {
    $json = base64_decode($_GET['data']);
    $post = json_decode($json, true);
    $domain = isset($post['domain']) ? strtolower(trim($post['domain'])) : '';
    $timestamp = isset($post['timestamp']) ? intval($post['timestamp']) : 0;
    $nonce = isset($post['nonce']) ? $post['nonce'] : '';
    $client_sign = isset($post['sign']) ? $post['sign'] : '';
    $server_time = time();
    $server_time_str = date('Y-m-d H:i:s', $server_time);

    // 新增：只查expire分支
    if (!$timestamp && !$nonce && !$client_sign) {
        $stmt = $conn->prepare("SELECT * FROM auth_domains WHERE domain=? LIMIT 1");
        $stmt->bind_param("s", $domain);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row && strtotime($row['expire']) >= strtotime(date('Y-m-d'))) {
            $auth = 1;
            $expire = $row['expire'];
        } else {
            $auth = 0;
            $expire = '';
        }
        $data = [
            'auth' => $auth,
            'domain' => $domain,
            'expire' => $expire
        ];
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    // 新增：易支付回调添加域名API
    if (isset($post['action']) && $post['action'] === 'add_domain' && isset($post['domain']) && isset($post['expire'])) {
        $domain = strtolower(trim($post['domain']));
        $expire = trim($post['expire']);
        
        if ($domain && $expire) {
            // 检查域名是否已存在
            $stmt = $conn->prepare("SELECT * FROM auth_domains WHERE domain = ?");
            $stmt->bind_param("s", $domain);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // 更新到期时间
                $stmt = $conn->prepare("UPDATE auth_domains SET expire = ? WHERE domain = ?");
                $stmt->bind_param("ss", $expire, $domain);
                $stmt->execute();
            } else {
                // 新增域名
                $stmt = $conn->prepare("INSERT INTO auth_domains (domain, expire) VALUES (?, ?)");
                $stmt->bind_param("ss", $domain, $expire);
                $stmt->execute();
            }
            
            $data = [
                'success' => true,
                'domain' => $domain,
                'expire' => $expire,
                'message' => '域名授权成功'
            ];
            header('Content-Type: application/json');
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    // 原有签名校验分支
    if ($timestamp <= 0 || abs($server_time - $timestamp) > 600) {
        die(json_encode([
            'auth'=>false,
            'msg'=>'请求已过期或时间戳无效',
            'server_time'=>$server_time,
            'server_time_str'=>$server_time_str
        ]));
    }
    $stmt = $conn->prepare("SELECT * FROM auth_domains WHERE domain=? LIMIT 1");
    $stmt->bind_param("s", $domain);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row && strtotime($row['expire']) >= strtotime(date('Y-m-d'))) {
        $auth = true;
        $expire = $row['expire'];
    } else {
        $auth = false;
        $expire = '';
    }
    $sign_str = $auth . '|' . $domain . '|' . $expire . '|' . $timestamp . '|' . $nonce;
    $server_sign = hash_hmac('sha256', $sign_str, $sign_key);
    if ($client_sign !== $server_sign) {
        die(json_encode([
            'auth'=>false,
            'msg'=>'签名校验失败',
            'server_time'=>$server_time,
            'server_time_str'=>$server_time_str
        ]));
    }
    $data = [
        'auth' => $auth,
        'domain' => $domain,
        'expire' => $expire,
        'timestamp' => $timestamp,
        'nonce' => $nonce,
        'sign' => $server_sign,
        'server_time' => $server_time,
        'server_time_str' => $server_time_str
    ];
    header('Content-Type: application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// ====== 数据库表初始化（如无表自动创建） ======
$conn->query("CREATE TABLE IF NOT EXISTS `auth_domains` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `domain` VARCHAR(255) NOT NULL UNIQUE,
  `expire` DATE NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

// ====== 管理后台密钥验证 ======
session_start();
if (!isset($_SESSION['auth_admin_ok'])) {
    if (isset($_POST['admin_key'])) {
        if ($_POST['admin_key'] === $admin_key) {
            $_SESSION['auth_admin_ok'] = 1;
            header('Location: auth_manage.php');
            exit;
        } else {
            $error = '密钥错误！';
        }
    }
    // 密钥输入表单
    echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>管理后台登录</title></head><body>';
    if (isset($error)) echo '<p style="color:red">'.$error.'</p>';
    echo '<form method="post">请输入管理密钥：<input type="password" name="admin_key" autofocus required> <button type="submit">进入</button></form>';
    echo '</body></html>';
    exit;
}

// ====== 管理后台（添加/删除） ======
// 添加域名
if (isset($_POST['domain']) && isset($_POST['expire'])) {
    $domain = strtolower(trim($_POST['domain']));
    $expire = trim($_POST['expire']);
    if ($domain && $expire) {
        $stmt = $conn->prepare("INSERT IGNORE INTO auth_domains (domain, expire) VALUES (?, ?)" );
        $stmt->bind_param("ss", $domain, $expire);
        $stmt->execute();
        echo "<script>alert('添加成功');location.href='auth_manage.php';</script>";
        exit;
    }
}
// 删除域名
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $conn->query("DELETE FROM auth_domains WHERE id=$id");
    echo "<script>alert('删除成功');location.href='auth_manage.php';</script>";
    exit;
}
// 查询所有
$res = $conn->query("SELECT * FROM auth_domains ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>授权域名管理与API</title>
</head>
<body>
    <h2>添加授权域名</h2>
    <form method="post">
        域名（不带http/https）：<input type="text" name="domain" required>
        到期日期：<input type="date" name="expire" required>
        <button type="submit">添加</button>
    </form>
    <h2>已授权域名</h2>
    <table border="1" cellpadding="5">
        <tr><th>ID</th><th>域名</th><th>到期时间</th><th>添加时间</th><th>操作</th></tr>
        <?php while($row = $res->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['domain']) ?></td>
            <td><?= $row['expire'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><a href="?del=<?= $row['id'] ?>" onclick="return confirm('确定删除？')">删除</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <hr>
    <p>API接口用法：GET 方式访问本文件，如 <b>?data=xxxx</b>（base64加密参数），返回JSON授权信息及签名。</p>
</body>
</html> 
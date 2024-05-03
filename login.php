<?php
session_start();

// 检查是否已经设置管理员账户
if (!file_exists('admin_account.txt')) {
    // 如果管理员账户不存在，则显示注册表单
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // 将管理员账户信息保存到文件
        $admin_data = "$username\n$password";
        file_put_contents('admin_account.txt', $admin_data);

        // 提示管理员账户注册成功
        $success_message = "管理员账户已成功注册，请登录！";
    }
} else {
    // 如果管理员账户已存在，则显示登录表单
    $valid_credentials = explode("\n", file_get_contents('admin_account.txt'));
    $valid_username = $valid_credentials[0];
    $valid_password = $valid_credentials[1];

    // 处理用户提交的登录表单
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // 验证用户名和密码
        if ($username === $valid_username && $password === $valid_password) {
            // 认证成功，将用户标记为已登录，并重定向到管理页面
            $_SESSION['logged_in'] = true;
            header("Location: admin.php");
            exit;
        } else {
            // 认证失败，显示错误消息
            $error_message = "用户名或密码错误，请重试！";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <!-- 引入Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        <?php
        // 如果你有背景图片的 URL，请在这里替换
        $background_image_url = 'image.jpg'; // 背景图片的URL
        ?>
        body {
            background-image: url('<?php echo $background_image_url; ?>'); /* 设置背景图片 */
            background-size: cover; /* 让背景图片充满整个屏幕 */
            background-position: center; /* 将背景图片居中 */
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 400px;
            margin: 0 auto; /* 居中显示 */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* 添加半透明白色背景 */
            border-radius: 10px;
            margin-top: 100px; /* 垂直居中 */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>登录</h2>
        <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
        <?php if (isset($success_message)) echo "<p>$success_message</p>"; ?>
        
        <?php if (!file_exists('admin_account.txt')): ?>
        <h3>注册管理员账户</h3>
        <form method="post">
            <div class="form-group">
                <label for="username">用户名:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">密码:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">注册</button>
        </form>
        <?php else: ?>
        <h3>管理员登录</h3>
        <form method="post">
            <div class="form-group">
                <label for="username">用户名:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">密码:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">登录</button>
        </form>
        <?php endif; ?>
    </div>

    <!-- 引入Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

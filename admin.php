<?php
// 检查用户是否已经登录，如果没有登录则重定向到登录页面
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}


// 检查是否有POST请求，处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取用户输入的内容
    $app_name = $_POST['app_name'];
    $app_description = $_POST['app_description'];
    $app_version = $_POST['app_version'];

    // 保存用户输入的内容到文件
    $data = "$app_name\n$app_description\n$app_version";
    file_put_contents('app_info.txt', $data);
    
    // 保存应用版本信息到单独的文件
    file_put_contents('version.txt', $app_version);

    // 提示用户修改成功
    $message = "App信息已更新！";
}

// 检查文件是否存在，如果不存在则创建一个初始内容的文件
if (!file_exists('app_info.txt')) {
    $initial_data = "App名称\nApp描述\n1.0";
    file_put_contents('app_info.txt', $initial_data);
}

// 读取已保存的App信息
$app_info = file('app_info.txt', FILE_IGNORE_NEW_LINES);
$app_name = $app_info[0];
$app_description = $app_info[1];
$app_version = $app_info[2];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理页面</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
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
        <h2>修改App信息</h2>
        <form method="post">
            <label for="app_name">App名称:</label><br>
            <input type="text" id="app_name" name="app_name" value="<?php echo $app_name; ?>" required><br>
            <label for="app_description">App描述:</label><br>
            <textarea id="app_description" name="app_description" rows="4" required><?php echo $app_description; ?></textarea><br>
            <label for="app_version">App版本:</label><br>
            <input type="text" id="app_version" name="app_version" value="<?php echo $app_version; ?>" required><br><br>
            <input type="submit" value="保存">
        </form>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
    </div>
</body>
</html>

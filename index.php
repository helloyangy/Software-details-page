<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        // 读取保存的App信息
        $app_info = file('app_info.txt', FILE_IGNORE_NEW_LINES);
        $app_name = $app_info[0] ?? 'App名称';
        echo $app_name; // 将应用名称作为页面标题
        ?>
    </title>
    <!-- 引入Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        <?php
        // 从Unsplash API获取随机背景图片
        $background_api_url = 'https://source.unsplash.com/1600x900/?nature'; // 指定背景图片的大小和主题
        ?>
        body {
            background-image: url('<?php echo $background_api_url; ?>'); /* 设置背景图片 */
            background-size: cover; /* 让背景图片充满整个屏幕 */
            background-position: center; /* 将背景图片居中 */
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto; /* 居中显示 */
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* 添加半透明白色背景 */
            border-radius: 10px;
        }
        .download-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // 继续显示应用描述、版本信息和更新日期
        $app_description = $app_info[1] ?? 'App描述Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.';
        // 从 version.txt 文件中读取应用版本信息
        $app_version = file_get_contents('version.txt');
        // 获取当前日期
        $update_date = date("Y-m-d");
        ?>

        <h1 class="text-center"><?php echo $app_name; ?></h1>
        <p class="lead"><?php echo $app_description; ?></p>
        <hr>
        <h2>版本信息</h2>
        <p><strong>App名称:</strong> <?php echo $app_name; ?><br><strong>版本:</strong> <?php echo $app_version; ?><br><strong>更新日期:</strong> <?php echo $update_date; ?></p>
        <a href="app_download_link" class="download-button">下载App</a>
    </div>

    <!-- 引入Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

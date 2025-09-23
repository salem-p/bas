<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مرحبا بك</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #e3f2fd;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        /* شريط علوي */
        .appbar {
            background-color: #1976d2;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        /* المحتوى */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .spinner {
            width: 80px;
            height: 80px;
            border: 8px solid #bbdefb;
            border-top: 8px solid #1976d2;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        @keyframes spin {
            100% { transform: rotate(360deg); }
        }
        p {
            color: #555;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <?php
    $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : "الزائر";
    ?>

    <!-- شريط علوي -->
    <div class="appbar">
        مرحباً بك يا <?php echo $name; ?> 👋
    </div>

    <!-- المحتوى -->
    <div class="content">
        <div class="spinner"></div>
        <p>نأسف، الموقع قيد الإنشاء 🚧</p>
    </div>

</body>
</html>

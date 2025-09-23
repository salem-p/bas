<?php
if (isset($_POST["reset_request"])) {
    $host="localhost";
    $username="root";
    $pass="";
    $dbname="project_db";

    $conn = mysqli_connect($host, $username, $pass, $dbname);

    $email = $_POST["email"];

    // تحقق إذا البريد موجود
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // توليد رمز عشوائي
        $token = bin2hex(random_bytes(8));

        // نخزن الرمز في جدول المستخدمين
        $sql = "UPDATE users SET reset_token = '$token' WHERE email = '$email'";
        mysqli_query($conn, $sql);

        $success_message = "تم إنشاء رابط إعادة التعيين 🎉 <br> 
        <a href='reset_password.php?token=$token'>اضغط هنا لإعادة تعيين كلمة المرور</a>";
    } else {
        $error_message = "الإيميل غير موجود.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نسيت كلمة المرور</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #e3f2fd; }
        .card { border-radius: 15px; border: none; background: #ffffff; }
        .card-title { color: #1976d2; font-weight: bold; }
        .btn-primary { background-color: #1976d2; border: none; border-radius: 10px; font-weight: bold; }
        .btn-primary:hover { background-color: #1565c0; }
        a { color:#1976d2; text-decoration:none; }
        a:hover { text-decoration:underline; }
    </style>
</head>
<body>
<div class="container-fluid vh-100">
    <div class="row h-100">

        <!-- العمود الأيسر -->
        <div class="col-md-3 d-flex align-items-center justify-content-center" style="background-color:#bbdefb;">
            <img src="u1.svg" alt="صورة" style="max-width:60%; height:auto;">
        </div>

        <!-- العمود الأيمن -->
        <div class="col-md-9 d-flex align-items-center justify-content-center">
            <div class="card shadow-lg w-75">
                <div class="card-body p-4 text-end">

                    <div class="d-flex justify-content-end mb-3">
                        <i class="bi bi-envelope-lock" style="font-size:70px; color:#1976d2;"></i>
                    </div>

                    <h3 class="card-title mb-3">نسيت كلمة المرور</h3>
                    <p class="text-muted">أدخل بريدك الإلكتروني لإرسال رابط إعادة التعيين</p>

                    <!-- رسائل نجاح أو خطأ -->
                    <?php if (!empty($success_message)) { ?>
                        <div class="alert alert-success text-center"><?php echo $success_message; ?></div>
                    <?php } ?>
                    <?php if (!empty($error_message)) { ?>
                        <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
                    <?php } ?>

                    <?php if (empty($success_message)) { ?>
                    <!-- الفورم -->
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <div class="input-group flex-row-reverse">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>
                                <input type="email" class="form-control text-end" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="reset_request" class="btn btn-primary">إرسال</button>
                        </div>
                    </form>
                    <?php } ?>

                    <div class="mt-3 text-center">
                        <p><a href="login.php">العودة لتسجيل الدخول</a></p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

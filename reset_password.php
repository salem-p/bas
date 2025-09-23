<?php
if (isset($_GET["token"])) {
    $token = $_GET["token"];

    $host="localhost";
    $username="root";
    $pass="";
    $dbname="project_db";

    $conn = mysqli_connect($host, $username, $pass, $dbname);

    // نبحث عن المستخدم اللي عنده هذا التوكن
    $sql = "SELECT * FROM users WHERE reset_token = '$token'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $email = $row["email"];

        if (isset($_POST["reset_password"])) {
            $new_pass = $_POST["password"];

            // تحديث كلمة المرور ومسح التوكن
            $sql = "UPDATE users SET password = '$new_pass', reset_token=NULL WHERE email = '$email'";
            mysqli_query($conn, $sql);

            $success_message = "تم تغيير كلمة المرور بنجاح 🎉 سيتم تحويلك لتسجيل الدخول...";
            header("refresh:3;url=login.php"); // تحويل بعد 3 ثواني
        }
    } else {
        $error_message = "الرابط غير صالح.";
    }

    mysqli_close($conn);
} else {
    $error_message = "رمز مفقود.";
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #e3f2fd; }
        .card { border-radius: 15px; border: none; background: #ffffff; }
        .card-title { color: #1976d2; font-weight: bold; }
        .btn-primary { background-color: #1976d2; border: none; border-radius: 10px; font-weight: bold; }
        .btn-primary:hover { background-color: #1565c0; }
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
                        <i class="bi bi-shield-lock" style="font-size:70px; color:#1976d2;"></i>
                    </div>

                    <h3 class="card-title mb-3">إعادة تعيين كلمة المرور</h3>
                    <p class="text-muted">أدخل كلمة مرور جديدة لحسابك</p>

                    <!-- رسائل نجاح أو خطأ -->
                    <?php if (!empty($success_message)) { ?>
                        <div class="alert alert-success text-center"><?php echo $success_message; ?></div>
                    <?php } ?>
                    <?php if (!empty($error_message)) { ?>
                        <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
                    <?php } ?>

                    <?php if (empty($success_message) && empty($error_message)) { ?>
                    <!-- الفورم -->
                    <form method="POST">
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور الجديدة</label>
                            <div class="input-group flex-row-reverse">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control text-end" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="reset_password" class="btn btn-primary">تغيير</button>
                        </div>
                    </form>
                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

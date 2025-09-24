<!DOCTYPE html> 
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <!-- Bootstrap CSS --><!--  CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #e3f2fd; /* خلفية زرقاء فاتحة */
        }
        .card {
            border-radius: 15px;
            border: none;
            background: #ffffff;
        }
        .card-title {
            color: #1976d2;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #1976d2;
            border: none;
            border-radius: 10px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #1565c0;
        }
        a {
            color: #1976d2;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container-fluid vh-100">
    <div class="row h-100">

        <!-- العمود الأيسر -->
        <div class="col-md-3 d-flex align-items-center justify-content-center" style="background-color:#bbdefb;">
            <img src="us3.jpg" alt="صورة توضيحية" style="max-width:60%; height:auto;">
        </div>

        <!-- العمود الأيمن -->
        <div class="col-md-9 d-flex align-items-center justify-content-center">
            <div class="card shadow-lg w-75">
                <div class="card-body p-4">

                    <!-- أيقونة أعلى يمين -->
                    <div class="d-flex justify-content-end mb-2">
                        <i class="bi bi-person-circle" style="font-size:70px; color:#1976d2;"></i>
                    </div>

                    <div class="text-end mb-3">
                        <h3 class="card-title">تسجيل الدخول</h3>
                        <p class="text-muted">أدخل بياناتك للوصول إلى حسابك</p>
                    </div>

                    <?php
                    if(isset($_POST["login"])){

                        $host="localhost";
                        $username="root";
                        $pass="";
                        $dbname="project_db";

                        $conn = mysqli_connect($host, $username, $pass, $dbname) or die("فشل الاتصال: " . mysqli_connect_error());

                        $email = $_POST["email"];
                        $password = $_POST["password"];

                        // التحقق من المستخدم
                        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $name = $row["name"]; // لازم يكون عندك عمود اسمه name في جدول users
                            header("Location: bas.php?name=" . urlencode($name));
                            exit;
                        } else {
                            echo "<div class='alert alert-danger text-center'>البريد أو كلمة المرور غير صحيحة!</div>";
                        }

                        mysqli_close($conn);

                    } 
                    ?>

                    <!-- الفورم -->
                    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST" class="text-end">
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <div class="input-group flex-row-reverse">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>
                                <input type="email" class="form-control text-end" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <div class="input-group flex-row-reverse">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control text-end" id="password" name="password" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-primary">تسجيل الدخول</button>
                        </div>
                    </form>

                    <div class="mt-4 text-center">
                        <p>إذا لم يكن لديك حساب، <a href="register.php">سجل الآن</a></p>
                        <p><a href="forgot_password.php">نسيت كلمة المرور؟</a></p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل مستخدم جديد</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #020d2f;">

<div class="container-fluid vh-100">
    <div class="row h-100">

        <!-- العمود الأيسر -->
        <div class="col-md-3 d-flex align-items-center justify-content-center" style="background-color: #080e1b;">
            <img src="u1.svg" alt="صورة توضيحية" style="max-width: 50%; height: auto;">
        </div>

        <!-- العمود الأيمن للنموذج -->
        <div class="col-md-9 d-flex align-items-center justify-content-center">
            <div class="card shadow-lg w-75" style="border-radius:10px; background-color: rgba(11,30,74,0.95);">
                <div class="card-body">

                    <!-- أيقونة المستخدم أعلى يمين -->
                    <div class="d-flex justify-content-end mb-2">
                        <i class="bi bi-person-circle" style="font-size:80px; color:#1e90ff;"></i>
                    </div>

                    <!-- الترحيب -->
                    <div class="text-end mb-1">
                        <h4 style="color:#1e90ff; font-weight:bold;">مرحباً بك</h4>
                    </div>

                    <!-- نص إضافي -->
                    <div class="text-end mb-4">
                        <p style="color:#1e90ff; font-size:0.95rem;">للتسجيل معنا اضف بياناتك!</p>
                    </div>

                    <?php
                    $message = "";
                    if(isset($_POST["register"])){

                        $host="localhost";
                        $username="root";
                        $pass="";
                        $dbname="project_db";

                        $conn=mysqli_connect($host,$username,$pass) or die("فشل الاتصال: " . mysqli_connect_error());

                        $conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
                        $conn->select_db($dbname);

                        $conn->query("CREATE TABLE IF NOT EXISTS users(
                            id INT(11) AUTO_INCREMENT PRIMARY KEY,
                            email VARCHAR(100) NOT NULL UNIQUE,
                            password VARCHAR(255) NOT NULL,
                            name VARCHAR(100) NOT NULL,
                            reset_token VARCHAR(32) NULL
                        )");

                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];

                        // تحقق إذا الإيميل موجود
                        $check = $conn->query("SELECT * FROM users WHERE email='$email'");
                        if($check->num_rows > 0){
                            $message = "<div class='alert alert-warning text-end'>لديك حساب مسجل بالفعل</div>";
                        } else {
                            $sql = "INSERT INTO users(email, password, name) VALUES('$email', '$password', '$name')";
                            $query = mysqli_query($conn , $sql) or die("فشل الإضافة: " . mysqli_error($conn));

                            mysqli_close($conn);

                            // رسالة نجاح + تحويل بعد 3 ثواني
                            $message = "<div class='alert alert-success text-end'>
                                            تم التسجيل بنجاح، سيتم نقلك إلى صفحة تسجيل الدخول خلال ثوانٍ...
                                        </div>
                                        <script>
                                            setTimeout(function(){
                                                window.location.href = 'login.php';
                                            }, 3000);
                                        </script>";
                        }
                    }

                    // عرض الرسالة داخل الكارد
                    if(!empty($message)){
                        echo $message;
                    }
                    ?>

                    <!-- الفورم -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="text-end">
                        <div class="mb-3 position-relative">
                            <label for="name" class="form-label" style="color:#1e90ff;">الاسم</label>
                            <div class="input-group flex-row-reverse">
                                <span class="input-group-text" style="background-color:#1e90ff; color:white;">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" class="form-control text-end" id="name" name="name" required style="border-radius:6px;">
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label" style="color:#1e90ff;">البريد الإلكتروني</label>
                            <div class="input-group flex-row-reverse">
                                <span class="input-group-text" style="background-color:#1e90ff; color:white;">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>
                                <input type="email" class="form-control text-end" id="email" name="email" required style="border-radius:6px;">
                            </div>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label" style="color:#1e90ff;">كلمة المرور</label>
                            <div class="input-group flex-row-reverse">
                                <span class="input-group-text" style="background-color:#1e90ff; color:white;">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control text-end" id="password" name="password" required style="border-radius:6px;">
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="register" class="btn" style="background-color:#1e90ff; color:white; font-weight:bold;">تسجيل</button>
                        </div>
                    </form>

                    <p class="text-end mt-3" style="color:#1e90ff;">لديك حساب بالفعل؟ <a href="login.php" style="color:#1e90ff;">تسجيل الدخول</a></p>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// تضمين مكتبة PHPMailer
require 'vendor/autoload.php';

// تضمين ملف الاتصال بقاعدة البيانات
include('db.php');

// التحقق من أن النموذج تم إرساله
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // التحقق من تنسيق البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "تنسيق البريد الإلكتروني غير صحيح.";
    } else {
        // التحقق من وجود البريد الإلكتروني في قاعدة البيانات
        $stmt = $pdo->prepare("SELECT users_id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // إنشاء رمز إعادة تعيين
            $token = bin2hex(random_bytes(50));

            // تحديد وقت انتهاء صلاحية الرمز (على سبيل المثال، ساعة واحدة)
            $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

            // تخزين الرمز ووقت انتهاء الصلاحية في قاعدة البيانات
            $stmt = $pdo->prepare("UPDATE users SET password_reset_token = ?, token_expiry = ? WHERE email = ?");
            $stmt->execute([$token, $expires, $email]);

            // إعداد PHPMailer لإرسال البريد الإلكتروني
            $mail = new PHPMailer(true);

            try {
                // إعدادات SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';  // إعداد SMTP الخاص بـ Gmail
                $mail->SMTPAuth = true;
                $mail->Username = 'your-email@gmail.com';  // البريد الإلكتروني الخاص بك على Gmail
                $mail->Password = 'your-app-password';  // كلمة مرور التطبيقات التي أنشأتها
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // المرسل والمستقبل
                $mail->setFrom('no-reply@localhost.com', 'No Reply');
                $mail->addAddress($email);

                // الموضوع والمحتوى
                $mail->isHTML(true);
                $mail->Subject = 'طلب إعادة تعيين كلمة المرور';
                $mail->Body = 'اضغط على الرابط لإعادة تعيين كلمة المرور الخاصة بك: <a href="http://localhost/reset_password_form.php?token=' . $token . '">إعادة تعيين كلمة المرور</a>';

                // إرسال البريد الإلكتروني
                $mail->send();
                echo 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.';
            } catch (Exception $e) {
                echo "فشل إرسال البريد الإلكتروني. خطأ: {$mail->ErrorInfo}";
            }
        } else {
            echo "لا يوجد حساب مسجل بهذا البريد الإلكتروني.";
        }
    }
}
?>

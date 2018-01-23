<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/auth/reset-password', 'token' => $user->password_reset_token]);
?>

สวัสดีค่ะ คุณ<?php echo Html::encode($user->username) ?>,

<p>&nbsp;</p>
<p>คุณได้แจ้งขอรีเซตรหัสผ่านใหม่ กรุณายืนยันผ่านลิงค์ด้านล่าง </p>
<p>
  <span style="color:#ffa500;"><strong>  <?php echo Html::a('ตั้งรหัสผ่านใหม่', $resetLink) ?></strong></span></p>
<p>

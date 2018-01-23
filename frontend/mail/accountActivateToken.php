<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$activateLink = Yii::$app->urlManager->createAbsoluteUrl(['/user/auth/activate-account', 'token' => $user->password_reset_token]);
?>
สวัสดีค่ะ คุณ<?php echo Html::encode($user->username) ?>,

<p>	ท่านได้รับการตอบรับเป็นสมาชิกสำหรับระบบ m.e-pretest เพื่อให้การลงทะเบียนเสร็จสมบูรณ์ กรุณายืนยันผ่านลิงค์ด้านล่าง </p>
<p>
  <span style="color:#ffa500;"><strong>  <?php echo Html::a('ยืนยันการลงทะเบียน', $activateLink) ?></strong></span></p>
<p>
 

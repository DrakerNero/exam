<?php

use frontend\models\QuestionSave;
use frontend\helpers\MainHelper;

header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="export_question_choices.xls"'); #ชื่อไฟล์
?>

<!--<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"   />-->
<HTML
  xmlns:o="urn:schemas-microsoft-com:office:office"
  xmlns:x="urn:schemas-microsoft-com:office:excel"
  >
  <HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
      td {
        mso-number-format:\@;
        border: 1px solid #000;
      }
    </style>
  </HEAD>
  <BODY>
    <table class="export-tb">
      <thead>
        <tr style="font-size: 16px; font-weight: 700;">
          <td>SID</td>
          <td>ชื่อ-สกุล</td>
          <td>Year</td>
          <td>รุ่น</td>
          <td>Exam Pass</td>
          <td>Exam Total</td>
          <td>Attempt</td>
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $rotations = MainHelper::setLotation();
        foreach ($userModels as $model) {
          $examPass = 0;
          $attempt = 0;
          $questionSaves = QuestionSave::find()
                  ->where(['user_id' => $model->id])
                  ->andWhere(['!=', 'module_part', null])
                  ->all();
          foreach ($questionSaves as $questionSave) {
            ($questionSave->score >= 80) ? $examPass++ : null;
            $attempt++;
          }
          ?>
          <tr>
            <td><?= $model->username ?></td>
            <td><?= $model->first_name . ' ' . $model->last_name ?></td>
            <td><?= $model->start_study ?></td>
            <td><?= (!empty($model->rotation) && isset($model->rotation) && $model->rotation != null) ? $rotations[$model->rotation] : '' ?></td>
            <td><?= $examPass ?></td>
            <td><?= $questionSetCount ?></td>
            <td><?= $attempt ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <?php ?>
  </BODY>

</HTML>


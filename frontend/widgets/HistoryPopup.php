<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\QuestionSave;

class HistoryPopup extends \yii\bootstrap\Widget {

  public $models;

  public function run() {
    ?>

    <!--  modal question all  -->
    <div class="modal fade" id="question_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">รายการชุดข้อสอบที่ท่านได้ทำทั้งหมด</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>
                <th>ครั้งที่</th>
                <th>ประเภท</th>
                <th>วิชา</th>
                <th>คะแนนที่ได้</th>
              </tr>
              <?php
              $i = sizeof($this->models);
              foreach ($this->models as $model) {
                ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $model->questionSet->subject->exam_class ?></td>
                  <td><?= $model->questionSet->subject->exam_subclass ?></td>
                  <td><?= $model->score ?> คะแนน</td>
                </tr>
                <?php
                $i--;
              }
              ?>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!--  modal question pord  -->
    <div class="modal fade" id="question_pord" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">รายการชุดข้อสอบที่ท่านทำยังไม่เสร็จ</h4>
          </div>
          <div class="modal-body">
            <table class="table">
              <tr>		     
                <th>ประเภท</th>
                <th>วิชา</th>	
                <th>เวลาที่เหลือ</th>		      	
              </tr>
              <?php
              foreach ($this->models as $model) {
                if ($model->status == 2) {
                  ?>
                  <tr>
                    <td><?= $model->questionSet->subject->exam_class ?></td>
                    <td><?= $model->questionSet->subject->exam_subclass ?></td>
                    <td><?= $model->questionSet->total_time - $model->elapse_time ?> นาที</td>
                    <td>
                      <a href="<?= Yii::$app->urlManager->createUrl(['question-set/do-exam', 'questionSetId' => $model->questionSet->id]) ?>">
                        <button type="button" class="btn btn-warning btn-xs">ทำข้อสอบ</button>
                      </a>
                    </td>
                  </tr>
                  <?php
                }
              }
              ?>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <?php
  }

}

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Edit Profile';
?>

<?php $form = ActiveForm::begin(); ?>
<div class="wrapper-edit-profile-user">
  <div class="x_panel">
    <div class="x_title">
      <h2>Form Edit <small><?= $model->first_name ?></small></h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      <div class="form-horizontal form-label-left">
      <!--<form action="<?= Url::to(['site/edit-profile-user', 'id' => $id]) ?>" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">-->
        <input value="<?= $id ?>" name="id" style="display: none;"/>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="student_id">Student Id <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'student_id')->textInput(['maxlength' => true, 'class' => 'form-control col-md-7 col-xs-12'])->label(false) ?>
            <!--<input type="text" id="student-id" name="student_id" required="required" class="form-control col-md-7 col-xs-12">-->
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">First Name <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'class' => 'form-control col-md-7 col-xs-12'])->label(false) ?>
            <!--<input type="text" id="first-name" name="first_name" required="required" class="form-control col-md-7 col-xs-12">-->
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Last Name <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'class' => 'form-control col-md-7 col-xs-12'])->label(false) ?>
            <!--<input type="text" id="last-name" name="last_name" required="required" class="form-control col-md-7 col-xs-12">-->
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="faculty">Faculty <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'faculty')->textInput(['maxlength' => true, 'class' => 'form-control col-md-7 col-xs-12'])->label(false) ?>
            <!--<input type="text" id="faculty" name="faculty" required="required" class="form-control col-md-7 col-xs-12">-->
          </div>
        </div>
        <div class="form-group">
          <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Branch</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'branch')->textInput(['maxlength' => true, 'class' => 'form-control col-md-7 col-xs-12'])->label(false) ?>
          </div>
        </div>
        <div class="form-group">
          <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Start Study</label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'start_study')->textInput(['maxlength' => true, 'class' => 'form-control col-md-7 col-xs-12'])->label(false) ?>
          </div>
        </div>

        <!--        <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="gender" class="btn-group" data-toggle="buttons">
                      <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                        <input type="radio" name="gender" value="male" data-parsley-multiple="gender"> &nbsp; Male &nbsp;
                      </label>
                      <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender"> Female
                      </label>
                    </div>
                  </div>
                </div>-->
        <!--        <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                  </div>
                </div>-->
        <div class="ln_solid"></div>
        <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <a href="<?= Url::to(['monitor-profile-user', 'userId' => $id]) ?>" class="btn btn-primary" type="button">Cancel</a>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <!--<button type="submit" id="btn-submit-profile-user" class="btn btn-success">Submit</button>-->
          </div>
        </div>
      </div>
      <!--</form>-->
    </div>
  </div>

</div>

<?php ActiveForm::end(); ?>
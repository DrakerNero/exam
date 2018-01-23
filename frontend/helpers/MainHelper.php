<?php

namespace frontend\helpers;

use Yii;
use yii\web\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MainHelper extends Controller {

  public function arrayQuestionSaveStatus() {
    return [
        1 => 'Doing',
        3 => 'Pass',
        4 => 'Fail - Retest',
    ];
  }
  

}

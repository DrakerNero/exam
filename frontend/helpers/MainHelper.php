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

  public function questionSaveStatus($status, $score) {
    $text = 'Null';
    if ($status == 1) {
      $text = 'Doing';
    } else if ($status == 3) {
      if ($score >= 80) {
        $text = 'Pass';
      } else {
        $text = 'Fail - Retest';
      }
    } else if ($status == 4) {
      $text = 'Fail - Retest';
    } else {
      $text = 'Null';
    }
    return $text;
//    return [
//        1 => 'Doing',
//        3 => 'Pass',
//        4 => 'Fail - Retest',
//    ];
  }
  
  public function arrayQuestionSaveStatus(){
     return [
        1 => 'Doing',
        3 => 'Pass',
        4 => 'Fail - Retest',
    ];
  }

}

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

  public function arrayQuestionSaveStatus() {
    return [
        1 => 'Doing',
        3 => 'Pass',
        4 => 'Fail - Retest',
    ];
  }

  public function setLotation() {
    return [
        1 => 'รุ่น 1 พ.ค.-ก.ค.',
        2 => 'รุ่น 2 ก.ค.-ส.ค.',
        3 => 'รุ่น 3 ส.ค.-ต.ค.',
        4 => 'รุ่น 4 ต.ค.-ธ.ค.',
        5 => 'รุ่น 5 ธ.ค.-ก.พ.',
        6 => 'รุ่น 6 ก.พ.-เม.ย',
    ];
  }

  public function setDateTimeThai($datetime) {
    $timestamp = strtotime($datetime) + 7 * 60 * 60;

    $time = date('Y-m-d H:i:s', $timestamp);

    return $time;
  }

  public function nameModuleParts() {
    return [
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
        13 => '13',
        14 => '14',
        15 => '15',
        16 => '16',
        17 => '17',
        18 => '18',
        19 => '19',
        20 => '20',
        21 => '21',
        22 => '22',
        23 => '23',
        24 => '24',
        25 => '25',
        26 => '26',
        27 => '27',
        28 => '28',
        29 => '29',
        30 => '30',
        100 => '1ABC',
        101 => '2ABC',
        102 => '3ABC',
        103 => '4ABC',
        104 => '5ABC',
        105 => '6ABC',
        106 => '7ABC',
        107 => '8ABC',
        108 => '9ABC',
        109 => '10ABC',
    ];
  }

  public function setNameModulePart($key) {
    $nameModuleParts= self::nameModuleParts();
    return $nameModuleParts[$key];
  }

}

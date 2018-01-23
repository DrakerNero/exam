<?php

namespace frontend\widgets;

use frontend\models\QuestionSet;
use yii\web\View;

class HeartRate extends \yii\bootstrap\Widget {

  public function run() {
    ?>

    <div class="heart-rate-component">
      <div class="heart-rate">
        <svg
          version="1.0"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          x="0px"
          y="0px"
          width="150px"
          height="50px"
          viewBox="0 0 150 73"
          enable-background="new 0 0 150 73"
          xml:space="preserve"
          >
          <polyline fill="none" stroke="#fff" stroke-width="3" stroke-miterlimit="10" points="0,45.486 38.514,45.486 44.595,33.324 50.676,45.486 57.771,45.486 62.838,55.622 71.959,9 80.067,63.729 84.122,45.486 97.297,45.486 103.379,40.419 110.473,45.486 150,45.486"
                    />
        </svg>
        <div class="fade-in-heart-rate"></div>
        <div class="fade-out-heart-rate"></div>
      </div>
    </div >

    <?php
  }

}

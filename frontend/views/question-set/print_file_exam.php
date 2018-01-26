
<div style="">

  <?php
//$this->title = 'Print Exam ' . $questionSet->name;
  /*
   * To change this license header, choose License Headers in Project Properties.
   * To change this template file, choose Tools | Templates
   * and open the template in the editor.
   */
  $i = 1;
  foreach ($questions as $question) {
    $arrChoices = json_decode($question->choices, true);
    $answers = json_decode($question->answers, true);
    echo $i . '.  ' . $question->question;
    echo '<br /><br />';
    if ($question->png == 1) {
      echo '<img src="' . Yii::$app->getUrlManager()->getBaseUrl() . '/uploads/png/' . $question->id . '.png" />';
      echo '<br /><br />';
    }

    $numChoice = 1;
    foreach ($arrChoices as $key => $choice) {
//    if ($this->question->type_question == 2 && $answers[$key] == '') {
      if ($answers[$key] == '') {
        
      } else {
        echo $numChoice . '. ' . $choice . ' ((' . $answers[$key] . '))';
        echo '<br />';
      }

      $numChoice++;
    }

    echo '<br />';
    ?>

    <div style="">
      <b>Explain</b><br />
      <?= $question->answer_detail ?>
    </div>

    <?php
    echo '<br /><br />';
    echo '<br /><br />';
    $i++;
  }
  ?>
</div>

<?php 
use frontend\widgets\NewQuestion;
use frontend\widgets\HistoryPopup;
use yii\helpers\Url;
?>
<script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

    <script type="text/javascript">
      google.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?= json_encode($genGraphQuestion)?>);
        var options = {
          title: 'Test Result Trendline',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>   
  
<?php
  if(!empty(Yii::$app->user->identity->userProfile->avatar)){
    $url_image_profile = Yii::$app->user->identity->userProfile->avatar;
  }else {
    $url_image_profile = Url::to('@frontendUrl/uploads/images/default_avatar_male.jpg');
  }
?>
<div class="col-md-5 image-profile">
 <img src="<?=$url_image_profile?>" />
 <p><br></p>
</div> 


<div class="row" style="padding-left:15px; padding-right:15px;">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion glyphicon glyphicon-flag"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Latest Score</span>
        <span class="info-box-number"><?=$genCounrNumber['score_new']?>  points</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="ion glyphicon glyphicon-star-empty"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Highest Score</span>
        <span class="info-box-number"><?=$genCounrNumber['max_score']?>  points</span>
      </div>
    </div>
  </div>

  <a href="#" data-toggle="modal" data-target=".question_all">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion glyphicon glyphicon-saved"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Completed</span>
          <span class="info-box-number"><?=$genCounrNumber['question_all']?> exams</span>
        </div>
      </div>
    </div>
  </a>
  <a href="#" data-toggle="modal" data-target=".question_pord">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion glyphicon glyphicon-pushpin"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Not Completed</span>
          <span class="info-box-number"><?=$genCounrNumber['question_pord']?>  exams</span>
        </div>
      </div>
    </div>
  </a>
</div>

<div class="col-md-12">
  <div class="box box-success">
    <div class="box-header with-border">
      <h3 class="box-title">Exam Statistic</h3>
    </div>
    <div class="box-body">
      <div id="curve_chart"></div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Exam Activity Detail</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          <th>No.</th>
          <th>Score</th>
          <th>Elapse Time</th>
          <th>Date</th>
        </tr>
      <?php 
        $i= sizeof($models);
        foreach ($models as $model)  
          { 
      ?>
        <tr>
          <td><?=$i?></td>
          <td><?=$model->score?> scores</td>
          <td><?=$model->elapse_time?> mins</td>
          <td><?=date("Y-m-d",$model->created_at)?></td>

        </tr>
                 
      <?php  
        $i--;
         }  
       ?>
                  
      </table>
    </div>
  </div>
</div>

<?php echo NewQuestion::widget();?>

<?= HistoryPopup::widget(['models' => $models])?>

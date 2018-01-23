<?php 
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use kartik\field\FieldRange;
use kartik\select2\Select2;

$this->title = 'Report Question Saves';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'method' => 'get',
    'action' => ['report/question-save'],
]);?>

 <div class='box box-success col-lg-12'>

    <div class="col-lg-4">   
        <div class="report_date_input">       
       <?php
             echo DatePicker::widget([
			    'name' => 'from_date',
			    'value' => date("d-m-Y"),
			    'type' => DatePicker::TYPE_RANGE,
			    'name2' => 'to_date',
			    'value2' => date("d-m-Y"),
			    'pluginOptions' => [
			        'autoclose'=>true,
			        'format' => 'd-m-yyyy',
			    ]
			]);           
       ?>
         </div>
     </div>
     <div class="col-lg-3">
     <div class="report_date_input">  
         <?php 
             echo Select2::widget([
                'name' => 'status',
                'data' => [3 =>'เสร็จ', 2 => 'กำลังทำ' , 1 => 'อื่นๆ'],
                'theme' => Select2::THEME_CLASSIC,
                'options' => ['placeholder' => 'เลือกสถานะการทำข้อสอบ'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
         ?>
     </div>
     </div>
         <div class="col-lg-2">
              <br>
             <?= Html::submitButton('ดูรายงาน', ['class' => 'btn btn-primary','id'=>'see_report']) ?>
             <p><br></p>
         </div>

    </div>
<?php ActiveForm::end();?>

 <div class='box box-success col-lg-12'>
        <div class="box-header">
            <a class="btn btn-warning pull-right" target="_blank" onclick="printContent('content')">
                <i class="fa fa-print"></i> พิมพ์
            </a>
        </div>
        <div class="box-body print_report " id="content">       
       
        <?php       
        $cut_page = 0;
        $page_number =1;
        $row =1;
        	foreach ($models as $model) {
        		if($cut_page ==0 || $cut_page==22)
        		{
        		?>
        		<div class="page-a4">
        			<div class="header-report">
        				<h3>รายงาน QuestionSave</h3>
        			</div>
        			 <table class="table table-bordered">
        			<tr>
        				<th>ลำดับ</th>
        				<th>ชุดข้อสอบ</th>
        				<th>รายชื่อ</th>
        				<th>คะแนน</th>
        				<th>เวลาที่ใช้</th>
        			</tr>

        		<?php
        	$cut_page=0;
        		}
        		?>
        		<tr>
        			<td><?= $row; ?></td>
        			<td><?= $model->questionSet->name;?></td>
        			<td><?= $model->user->userProfile->firstname;?></td>
        			<td><?= $model->score;?></td>
        			<td><?= $model->elapse_time;?> นาที</td>
        		</tr>

		<?php
		if($cut_page==21)
		{
			?>
		</table>
        </div>

			<?php
			
		}
		$cut_page++;
		$row++;
        	}
         ?>
         </table>
        </div>
 </div>
 </div>

<script type="text/javascript">
	function printContent (divid){
   var restorepage = document.body.innerHTML;
   var printcontent = document.getElementById(divid).innerHTML;
   document.body.innerHTML = printcontent;
   window.print();
   document.body.innerHTML = restorepage   
 }
</script>
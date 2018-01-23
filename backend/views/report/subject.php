<?php 
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use kartik\field\FieldRange;
use kartik\select2\Select2;
use backend\models\Subject;
use yii\helpers\ArrayHelper;

$this->title = 'Report Subject';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'method' => 'get',
    'action' => ['report/subject'],
]);?>

 <div class='box box-success col-lg-12' id='mostest'>

    <div class="col-lg-4">   
        <div class="report_date_input">       
       <?php
             echo Select2::widget([
			    'name' => 'exam_class',
			    'data' => ArrayHelper::map(Subject::find()->all(), 'exam_class', 'exam_class'),
			    'options' => ['placeholder' => 'Select exam class']
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
        				<h3>รายงาน Subject</h3>
        			</div>
        			 <table class="table table-bordered">
        			<tr>
        				<th>ลำดับ</th>
        				<th>รายวิชา</th>
        				<th>ชุดข้อสอบ</th>
        				<th>จำนวนผู้ทำข้อสอบ</th>        				
        			</tr>
        		<?php
        	$cut_page=0;
        		}
        	foreach ($model->questionSet as $value) {        			
        		?>
        		<tr>
        			<td><?= $row; ?></td>
        			<td><?= $model->exam_subclass; ?></td>
        			<td><?= $value->name;?></td>
        			<td><?= sizeof($value->questionSave)?> คน</td>        			
        			
        		</tr>

		<?php
		$row++;
			}
		if($cut_page==21)
		{
			?>
		</table>
        </div>

			<?php
			
		}
		$cut_page++;
		
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
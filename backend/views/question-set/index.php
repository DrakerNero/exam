<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\editable\Editable;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionSetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Sets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-set-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Question Set', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
    $exportColumns =  
        [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'subject.exam_class',
            'name',
            'explanation',
            'from',
             'to',
             'total_time',
             'total_score',
             'question_type',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        
    ]; 

    $gridColumns= 
    [
     //   ['class' => 'yii\grid\SerialColumn'],    
     //  ['class' => 'kartik\grid\CheckboxColumn'],        
        [
          'attribute'=>'subject_id',
          'value' => 'subject.exam_class',
        ],        
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'name',

        'pageSummary' => true,        
        'editableOptions'=> [
          'header' => 'ชุดข้อสอบ',
          'placement' => 'top',
          'inputType' => Editable::INPUT_TEXTAREA,
           'size'=>'lg',
          'options' => ['class'=>'form-control', 'rows'=>3, 'placeholder'=>'Enter notes...'],
            ]
        ], 
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'explanation',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'Explanation',
            ]
        ],
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'total_time',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'Total time',
            ]
        ],
        
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'total_score',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'Total score',
            ]
        ],         
      ['class' => 'yii\grid\ActionColumn'],
];

    ?>

<div class="box box-success col-lg-12">
<p><br></p>
<div style="text-align:right;">
<?php
   echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $exportColumns,

    'columnSelectorOptions'=>[
        'label' => 'Cols...',
        'class' => 'btn btn-default btn-xs'
    ],   
    'dropdownOptions' => [
        'label' => 'Export All',
        'class' => 'btn btn-default btn-export'
    ]
]);

?>

</div>
<?php
    echo GridView::widget([
        'dataProvider'=> $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,

        
    ]);
    ?>

</div>
</div>
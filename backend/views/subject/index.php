<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\editable\Editable;
use kartik\popover\PopoverX;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subjects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Subject', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    
<?php
        $exportColumns =  
        [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'exam_class',
            'exam_subclass',
            'status',         
        ];
        
    $gridColumns= 
    [
        ['class' => 'yii\grid\SerialColumn'],   
        'id', 
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'exam_class',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'Exam class',
            ]
        ], 
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'exam_subclass',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'Exam subclass',
            ]
        ],
        
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'status',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'สถานะ',
          'inputType' => Editable::INPUT_DROPDOWN_LIST,
          'data'=> ['0' => 0, '1' => 1, '2' => 2],
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

<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
use kartik\editable\Editable;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuestionSaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Saves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-save-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Question Save', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
        $exportColumns =  
        [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'question_set_id',
            'user.userProfile.firstname',
            'mode',
            'answer:ntext',
            'score',
            'elapse_time:datetime',
            'status',
            'created_at',
            'updated_at',          
        ];
        
    $gridColumns= 
    [
        ['class' => 'yii\grid\SerialColumn'],
     //  'question_set_id',
        ['class' => 'kartik\grid\CheckboxColumn'],        
        [
          'attribute'=>'user_id',
          'value' => 'user.userProfile.firstname',
        ],
        [
          'attribute'=>'question_set_id',
          'value' => 'questionSet.name',
        ],
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'score',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'คะแนน',
       //  'format' => Editable::FORMAT_BUTTON,    
            ]
        ], 
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'elapse_time',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'เวลาที่ใช้ในการทำ',
       //  'format' => Editable::FORMAT_BUTTON,    
            ]
        ],
        
        [
        'class' => 'kartik\grid\EditableColumn',
        'attribute'=>'status',
        'pageSummary' => true,
        'editableOptions'=> [
          'header' => 'สถานะ',

       //  'format' => Editable::FORMAT_BUTTON,  
            ]
        ], 
        // [
        //     'class' => 'kartik\grid\EditableColumn',
        //         'attribute' => 'created_at',
        //             'pageSummary' => 'Page Total',
        //             'vAlign' => 'middle',
        //                     'headerOptions' => ['class' => 'kv-sticky-column'],
        //                     'contentOptions' => ['class' => 'kv-sticky-column'],
        //                     'editableOptions' => function ($model, $key, $index) {
        //                     return [
        //                         'header' => '&nbsp;',
        //                         'size' => 'md',
        //                         'inputType'=>Editable::INPUT_WIDGET,
        //                         'pluginEvents' => [ ],
        //                         'widgetClass'=> 'kartik\datecontrol\DateControl',
        //                         'options'=>[
        //                             'type'=>DateControl::FORMAT_DATE,
        //                             //'ajaxConversion'=>false,
        //                             'options' => [
        //                                 'pluginOptions' => [
        //                                     'autoclose' => true
        //                                 ]
        //                             ]
        //                         ]
        //                         ];
        //                     }
                          
        //     ],
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
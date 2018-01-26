<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>false,
    'showScriptName'=>false,
    'rules'=> [
        // Pages
        ['pattern'=>'page/<slug>', 'route'=>'page/view'],

        // Articles
//        ['pattern'=>'article/index', 'route'=>'question-set/index'],
        ['pattern'=>'article/attachment-download', 'route'=>'article/attachment-download'],
        ['pattern'=>'article/<slug>', 'route'=>'article/view'],

        // QuestionSet
        ['pattern'=>'question-set/do-exam/<questionSetId:\d+>', 'route'=>'question-set/do-exam'],
        ['pattern'=>'question-set/scholarship-exam/<questionSetId:\d+>', 'route'=>'question-set/scholarship-exam'],


        // Api
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/article', 'only' => ['index', 'view', 'options']],
        ['class' => 'yii\rest\UrlRule', 'controller' => 'api/v1/user', 'only' => ['index', 'view', 'options']]
    ]
];

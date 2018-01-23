<?php

use common\models\User;
use yii\db\Migration;

use frontend\models\QuestionSet;

class m160101_192740_seed_data extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'webmaster@example.com',
            'email' => 'webmaster@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('webmaster'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%user}}', [
            'id' => 2,
            'username' => 'manager@example.com',
            'email' => 'manager@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('manager'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'status'=> User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->insert('{{%user}}', [
            'id' => 3,
            'username' => 'user@example.com',
            'email' => 'user@example.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('user'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $this->insert('{{%user_profile}}', [
            'user_id'=>1,
            'locale'=>Yii::$app->sourceLanguage,
            'firstname' => 'John',
            'lastname' => 'Doe'
        ]);
        $this->insert('{{%user_profile}}', [
            'user_id'=>2,
            'locale'=>Yii::$app->sourceLanguage
        ]);
        $this->insert('{{%user_profile}}', [
            'user_id'=>3,
            'locale'=>Yii::$app->sourceLanguage
        ]);

        $this->insert('{{%widget_menu}}', [
            'key'=>'frontend-index',
            'title'=>'Frontend index menu',
            'items'=>json_encode([
                [
                    'label'=>'Get started with Yii2',
                    'url'=>'http://www.yiiframework.com',
                    'options'=>['tag'=>'span'],
                    'template'=>'<a href="{url}" class="btn btn-lg btn-success">{label}</a>'
                ],
                [
                    'label'=>'Yii2 Starter Kit on GitHub',
                    'url'=>'https://github.com/trntv/yii2-starter-kit',
                    'options'=>['tag'=>'span'],
                    'template'=>'<a href="{url}" class="btn btn-lg btn-primary">{label}</a>'
                ],
                [
                    'label'=>'Find a bug?',
                    'url'=>'https://github.com/trntv/yii2-starter-kit/issues',
                    'options'=>['tag'=>'span'],
                    'template'=>'<a href="{url}" class="btn btn-lg btn-danger">{label}</a>'
                ]

            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'status'=>\common\models\WidgetMenu::STATUS_ACTIVE
        ]);

        $this->insert('{{%widget_text}}', [
            'key'=>'backend_welcome',
            'title'=>'Welcome to backend',
            'body'=>'<p>Welcome to Yii2 Starter Kit Dashboard</p>',
            'status'=>1,
            'created_at'=> time(),
            'updated_at'=> time(),
        ]);

        $this->insert('{{%widget_carousel}}', [
            'id'=>1,
            'key'=>'index',
            'status'=>\common\models\WidgetCarousel::STATUS_ACTIVE
        ]);

        $this->insert('{{%widget_carousel_item}}', [
            'carousel_id'=>1,
            'base_url' => Yii::getAlias('@frontendUrl'),
            'path'=>'img/yii2-starter-kit.gif',
            'type'=>'image/gif',
            'url'=>'/',
            'status'=>1
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.theme-skin',
            'value' => 'skin-blue',
            'comment' => 'skin-blue, skin-black, skin-purple, skin-green, skin-red, skin-yellow'
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-fixed',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-boxed',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'backend.layout-collapsed-sidebar',
            'value' => 0
        ]);

        $this->insert('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance',
            'value' => 'disabled',
            'comment' => 'Set it to "true" to turn on maintenance mode'
        ]);
        //////////////////////////////////////////////////////////////////// by Yong

        $this->insert('{{%question}}', [
          'id' => 10010005,
          'question_topic' => 1,
          'question' => "อ่านบทความนี้แล้วตอบคำถามข้อ 13 - 15

เว็บไซต์ข้างต้นจัดทำขึ้นโดยหน่วยงานใด",
          'type_question' => 1,
          'choices' => '{"1":"สำนักงานคณะกรรมการอาหารและยา ","2":"กรมตำรวจ","3":"สำนักงานคณะกรรมการคุ้มครองผู้บริโภค","4":"กระทรวงสาธารณสุข","":""}',
          'answer' => 1,
          'answer_detail' => 'เพราะสำนักงานคณะกรรมการอาหารและยามีหน้าที่กำกับดูแลเรื่องอาหารทุกชนิดยกเว้นเนื้อสัตว์ สัตว์ปีก หรือพิจารณาได้จากคำว่า “อย.”ในบทความ ซึ่งย่อมาจาก “คณะกรรมการอาหารและยา”  ส่วนในข้ออื่นๆแต่ละหน่วยงานมีดังนี้

ข้อ 2. กรมตำรวจหรือสำนักงานตำรวจแห่งชาติมีหน้าที่ดูแลกิจการตำรวจ

ข้อ 3. สำนักงานคณะกรรมการคุ้มครองผู้บริโภคมีหน้าที่รับร้องทุกข์จากผู้บริโภค และสอดส่องผู้ประกอบการที่เอาเปรียบ

   ข้อ 4. กระทรวงสาธารณะสุขมีหน้าที่เกี่ยวกับสร้างเสริมสุขภาพอนามัย การป้องกันและรักษาโรคต่างๆ
',
          'mp3' => 0,
          'png' => 1,
          'txt' => 1,
          'updated_at' => time(),
      ]);
      $this->insert('{{%question_set}}', [
          'id' => 1,
          'subject_id' => 1001,
          'name' => 'Photographs ชุดที่ 1',
          'explanation' => 'PART 1
Directions: For each question in this part, you will ',
          'from' => 10010001,
          'to' =>10010020,
          'total_time' => 20,
          'total_score' => 20,
          'question_type' => 1,
          'status' => QuestionSet::STATUS_ACTIVE,
          'created_at' => time(),
          'updated_at' => time()
      ]);
      $this->insert('{{%question_set}}', [
          'id' => 2,
          'subject_id' => 1001,
          'name' => 'Photographs ชุดที่ 2',
          'explanation' => 'PART 2
Directions: For each question in this part, you will ',
          'from' => 10010001,
          'to' =>10010040,
          'total_time' => 20,
          'total_score' => 20,
          'question_type' => 1,
          'status' => QuestionSet::STATUS_ACTIVE,
          'created_at' => time(),
          'updated_at' => time()
      ]);
      $this->insert('{{%question_set}}', [
          'id' => 3,
          'subject_id' => 1002,
          'name' => 'Photographs ชุดที่ 1',
          'explanation' => 'PART 1
Directions: For each question in this part, you will ',
          'from' => 10020001,
          'to' =>10020010,
          'total_time' => 20,
          'total_score' => 20,
          'question_type' => 1,
          'status' => QuestionSet::STATUS_ACTIVE,
          'created_at' => time(),
          'updated_at' => time()
      ]);
      $this->insert('{{%subject}}', [
          'id' => 1001,
          'exam_class' => 'ONET',
          'exam_subclass' => 'ภาษาไทย',
      ]);
      $this->insert('{{%subject}}', [
          'id' => 1002,
          'exam_class' => 'ONET',
          'exam_subclass' => 'สังคมศึกษา',
      ]);
      $this->insert('{{%subject}}', [
          'id' => 1003,
          'exam_class' => 'ONET',
          'exam_subclass' => 'ภาษาอังกฤษ',
      ]);
      $this->insert('{{%subject}}', [
          'id' => 2001,
          'exam_class' => 'GAT',
          'exam_subclass' => 'ENG',
      ]);
    }

    public function safeDown()
    {
        $this->delete('{{%key_storage_item}}', [
            'key' => 'frontend.maintenance'
        ]);

        $this->delete('{{%key_storage_item}}', [
            'key' => [
                'backend.theme-skin',
                'backend.layout-fixed',
                'backend.layout-boxed',
                'backend.layout-collapsed-sidebar',
            ],
        ]);

        $this->delete('{{%widget_carousel_item}}', [
            'carousel_id'=>1
        ]);

        $this->delete('{{%widget_carousel}}', [
            'id'=>1
        ]);

        $this->delete('{{%widget_text}}', [
            'key'=>'backend_welcome'
        ]);

        $this->delete('{{%widget_menu}}', [
            'key'=>'frontend-index'
        ]);

        $this->delete('{{%user_profile}}', [
            'user_id' => [1, 2, 3]
        ]);

        $this->delete('{{%user}}', [
            'id' => [1, 2, 3]
        ]);

        $this->delete('{{%question}}', [
            'id' => [1, 2, 3]
        ]);

        $this->delete('{{%question_set}}', [
            'id' => [1, 2, 3]
        ]);

        $this->delete('{{%subject}}', [
            'id' => [1, 2, 3]
        ]);
    }
}

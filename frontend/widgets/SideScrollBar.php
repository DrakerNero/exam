<?php

namespace frontend\widgets;

class SideScrollBar extends \yii\bootstrap\Widget
{

    public $countQuesiton;

    public function run()
    {
        ?>

        <div class="frameScrollBar" style="display: block">
            <?php
            for ( $i = 1; $i <= $this->countQuesiton; $i++ )
            {
                ?>

                <div class="clickDiv" onclick="MoveScroll(<?= $i ?>)">
                    <?= $i ?>
                </div>

                <?php
            }
            ?>
        </div>

        <script>

            function MoveScroll(scroll) {
                alert(scroll);
            }

        </script>

        <?php
    }

}

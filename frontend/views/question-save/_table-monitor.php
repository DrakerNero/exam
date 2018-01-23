<?php
$arrStatus = [
    1 => "กำลังทำ",
    2 => "กำลังทำ",
    3 => "ส่ง",
];
?>
<table class="table table-hover">
    <tbody>
        <tr id="tb-head-monitor" >
            <th style="width: 20px;">
                #
            </th>
            <th style="width: 400px;">
                ชื่อข้อสอบ
            </th>
            <th style="width: 300px;">
                คะแนนที่ได้
            </th>
            <th style="width: 300px;">
                เวลาที่ใช้ไป
            </th>
            <th style="width: 300px;">
                สถานะ
            </th>
        </tr>
        <?php
        $i = 1;
        foreach ( $models as $model )
        {
            ?>

            <tr>
                <td>
                    <?= $i ?>
                </td>
                <td>
                    <?= $model->questionSet->name ?>
                </td>
                <td>
                    <?= $model->score ?>
                </td>
                <td>
                    <?= $model->elapse_time ?>
                </td>
                <td>
                    <?= $arrStatus[$model->status] ?>
                </td>
            </tr>

            <?php
            $i++;
        }
        ?>
    </tbody>
</table>

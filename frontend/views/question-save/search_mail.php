<?php ?>


<div class="frame-monitor">
    <div class='background-monitor'>
        <div class="search-monitor">
            <table class="tb-search-monitor">
                <tr>
                    <td>
                        <input class="insert-email-monitor" type="text">
                    </td>
                    <td>
                        <button id="btn-search-monitor" class="btn bg-navy btn-flat margin" onclick="LoadMonitor();" ><i class="fa  fa-send-o "></i>Search E-mail</button>
                    </td>
                </tr>
            </table>
            <?php
            if ( $titleSearch != '' )
            {
                echo $titleSearch;
            }
            else
            {
//                
                echo $this->render('_table-monitor', [
                    'models' => $models,
                ]);
//                print_r($models);
//                echo $user->id;
            }
            ?>
        </div>
    </div>
</div>
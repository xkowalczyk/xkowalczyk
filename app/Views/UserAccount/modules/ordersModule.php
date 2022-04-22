<?php print_r($orders) ?>

<link href="<?= esc(base_url()) ?>/css/account/modules/style-account-ordersmodule.css" rel="stylesheet" type="text/css">

<div class="orderslist">
    <h3>Lista zamówień</h3><br>
    <table>
        <tr>
            <td><b>Data zamówienia:</b></td>
            <td><b>Status zamówienia:</b></td>
        </tr>
        <?php if($orders != null) foreach($orders as $item):?>
           <tr>
               <td><?= esc($item->order_date) ?></td>
               <td><span><?= esc($item->order_status) ?></span></td>
               <td><button onclick="location.href = '<?= esc(base_url('account/checkorder').'/'.$item->order_id) ?>'">Sprawdź zamówienie</button></td>
           </tr> 
        <?php endforeach; ?>
    </table>
</div>

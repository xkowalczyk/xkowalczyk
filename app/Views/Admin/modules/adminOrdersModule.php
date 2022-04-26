<div class="orders">
    <h3>Lista zamówień</h3><br>
    <table>
        <tr>
            <td><b>Data zamówienia:</b></td>
            <td><b>Status zamówienia:</b></td>
        </tr>
        <?php if ($usersOrders != null) foreach ($usersOrders as $order) : ?>
            <tr>
                <td><?= esc($order->order_date) ?></td>
                <td><span><?= esc($order->order_status) ?></span></td>
                <td><button onclick="location.href = '<?= esc(base_url('admin/ordermanager') . '/' . $order->order_id) ?>'">Zarządzaj zamówieniem</button></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
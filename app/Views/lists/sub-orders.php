<table class="table dt-responsive nowrap">
<thead>
<tr>
    <th>Fly Code</th>
    <th>Fly Name</th>
    <th>Description</th>
    <th>Size</th>
    <th>Hook</th>
    <th>Quantity</th>
    <th>Amount</th>
</tr>
</thead> 
<?php
        if(!empty($order) && is_array($order)):  ?>
    <tbody> 
    <?php 
        $i = 0;
        foreach($order as $order): ?>
    <tr>
    <td><?= esc($order['fly_code'] ) ?></td>
    <td><?= esc($fly[$i][0]['flyname'] ) ?></td>
    <td><?= esc($fly[$i][0]['description']) ?></td>
    <td><?= esc($order['size']  ) ?></td>
    <td><?= esc($fly[$i][0]['hook'] ) ?></td>
    <td><?= esc($order['qty']  ) ?></td>
    <td><?= esc($order['amount'] ) ?></td>
    
    <td><a data-orderid='<?= esc($order['orderid']  ) ?>' class='btn btn-info btn-view' onclick='showWorkDetails(this)'>View</a></td>
    </tr>
      <td colspan="6" id="view-container-<?= esc($order['orderid']) ?>" style="display: none;"></td> 
    <?php 
    $i++;
       endforeach; ?>
                </tbody>
                <?php else: ?>
                
                <tbody><tr>
              <p class="error" >No orders were found</p>
                </tbody></tr>
              <?php endif ?>
</table>
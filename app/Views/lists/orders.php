<?= $this->extend('layouts/main') ?>   
<?= $this->section('content') ?>   

<div id="order-list" class="row ">
        <div class="row justify-content-left">
				<div class="col-md-4 text-center mb-5">
          <a class="nav-link btn btn-success create-new-button" href="/orders/neworder">Add New Order +</a>
				</div>
		</div>
        <div class="col-12 grid-margin">        <div class="card">
            <div class="card-body">
            <h4 class="card-title">Order List</h4>
            <div class="table-responsive">
                <table class="table display table-striped">
                <thead>
                    <tr>                            
                    <th> Order No </th>
                    <th> Client Name </th>
                    <th> No. of orders</th>
                    <th> Amount  </th>
                    <th> Order Date </th>
                    <th> Order Status </th>
                    <th> Actions </th>
                    <th></th>
                    </tr>
                </thead>
                <?php
              if(!empty($order) && is_array($order)):  ?>
                <tbody> 
                <?php 
                if (!$orderid):
                    $orderNumbers = array();
                    // $combined = array_combine($order, $user);
                    // foreach($combined as $order =>$user): 
                        $i=0;
                    foreach($order as $order): 
                        $orderNo = $order['orderno'];

                        if (in_array($orderNo, $orderNumbers)) {
                            $i++;
                            continue; 
                        } else {
                            $orderNumbers[] = $orderNo; 
                        }?>
                    <tr>
                        <td><?= esc($order['orderno'] ) ?></td>
                        <td><?= esc($user[$i]) ?></td>
                        <td><?= esc($count[$order['orderno']]) ?></td>
                        <td><?= esc($amount[$order['orderno']])?></td>
                        <td><?= esc($order['orderstart'] )?></td>
                        <?php
                        if($order['orderstop']){
                            echo '<td><div class="badge badge-outline-success">Complete</div></td>';
                        }else{
                            echo '<td><div class="badge badge-outline-warning">Pending</div></td>';
                        }
                        ?>
                        <!-- <td><a href="edit.php?id=< ?= esc($order['orderid'] ) ?>">Edit</a> <a href="delete.php?id=< ?= esc($order['orderid'] )?>">Delete</a></td> -->
                        <td><a  data-orderno="<?= esc($order['orderno'] )?>" class='btn btn-info btn-view' onclick='showOrderDetails(this)'>View</a></td>
                    </tr>

                    <td colspan="6" id="details-container-<?= esc($order['orderno'] )?>" style="display: none;"></td>
                    
                    <?php 
                    $i++;
                            endforeach;
                        else: ?>
                    <tr> 
                        <td><?= esc($order['orderno'] ) ?></td>
                        <td><?= esc($user) ?></td>
                        <td><?= esc($count[$order['orderno']]) ?></td>
                        <td><?= //esc($amount )
                            esc("$20")?></td>
                        <td><?= esc($order['orderstart'] )?></td>
                        <?php
                        if($order['orderstop']){
                            echo '<td><div class="badge badge-outline-success">Complete</div></td>';
                        }else{
                            echo '<td><div class="badge badge-outline-warning">Pending</div></td>';
                        }
                        ?>
                    </tr>   
                        <?php
                        endif; ?>
                </tbody>
                <?php else: ?>
                
                <tbody>
              <p class="error" >No orders were found</p>
                </tbody>
              <?php endif ?>
                </table>
                
            </div>
            </div>
        </div>
        </div>
    </div>
<?= $this->endSection() ?>
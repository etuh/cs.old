
<form method="POST" action="/orders/assignorder" onsubmit="saveCount()" id="assignform" name="assignform">
<tr><td>Assigned: </td><td><?php echo $assigned; ?></td></tr> 
<tr><td>Unassigned: </td><td><?php $unassigned=$totalqty-$assigned; echo $unassigned;?></td></tr> 
<table class="table display " id="datatable">

    <thead>
        <tr>
            <th>Staff Name</th>
            <th>Staff id</th>
            <th>Quantity</th>
            <th>Size</th>
            <th>Job type</th>
            <th>Job date</th>
            <th>Status</th>
        </tr>
    </thead>
    
    <tbody id="jobs-table">
    <?php if(!empty($order)&& is_array($order)):   //if (!$jobid):
    $i = 0;
    foreach($jobs as $job):
    ?>       

        <tr>
        <td id='name_<?= esc($job['jobid'])?>'><?= esc($user[$i])?></td>
        <td id='orderid_<?= esc($job['jobid'])?>'><?= esc($job['staffid'])?></td> 
        <td id='quantity_<?= esc($job['jobid'])?>'><?= esc($job['dqty'])?></td>
        <td id='size_<?= esc($job['jobid'])?>'><?= esc($size[0])?></td>
        <td id='jobtype_<?= esc($job['jobid'])?>'><?= esc($job['jobtype'])?></td>
        <td id='date_<?= esc($job['jobid'])?>'><?= esc($job['jobstart'])?></td>
        <td>
        <?php if (!empty($job['jobend'])){ ?>
            <div class='badge badge-outline-success'>Complete</div>
        <?php }else{ ?>
            <div class='badge badge-outline-warning'>Pending</div>
        <?php } ?>
        </td>
        <td><button type="button" id='edit_<?= esc($job['jobid'])?>' onclick='delete(<?= esc($job['jobid'])?>)'>Delete</button></td>
        </tr>
        <!-- <tr id='notes_row_esc($job['fly_code'])' style='display:none;'><td colspan='8'>esc($job['notes'])</td></tr> -->
        <?php
        $i++;
        endforeach; ?>
    
        <?php
    
else:
    ?>
    <tr>No results found</tr>
    <?php endif;

     ?>
    </tbody>

    <tfoot><br><br>
				<tr>
					<td colspan="2">
					<button type="button" onclick="assignStaff()">Assign</button></td><td>
					<button type="button" onclick="removeLast()">Remove</button>
					
					</td>
				</tr>
				<br>
				<tr><td>
					<button type="submit" value="Submit" form="assignform"> Submit </button>
				</td></tr>
			</tfoot>
</table>
<input name="orderid" type="hidden" value="<?= esc($orderid) ?>" >
</form>
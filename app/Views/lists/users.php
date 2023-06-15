<?= $this->extend('layouts/main') ?>   
<?= $this->section('content') ?>   

<div id="user-list" class="row ">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
        <section class="ftco-section">
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">User list</h2>
				</div>
			</div>

      <div class="row justify-content-left">
				<div class="col-md-4 text-center mb-5">
          <a class="nav-link btn btn-success create-new-button" href="/users/register">Add New User +</a>
				</div>
			</div>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">Open modal for @fat</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('New message to ' + recipient)
  modal.find('.modal-body input').val(recipient)
})
</script>


			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table display" id="datatable" >
						  <thead>
						    <tr>
								<th> Username </th>
								<th> Full name </th>
								<th> User Level</th>
								<th> Staff type </th>
								<th> Staff id </th>
								<th> Actions</th>
						    </tr>
						  </thead>
              <?php
              if(!empty($users) && is_array($users)): 

              // view_cell('\App\Libraries\Users::userlist', ['title'=>$userid]);
                  ?>
              <tbody>
                <?php 
              if (!$userid):
                foreach($users as $users): ?>
                    <tr>
                      <td id='uname_<?= esc($users['userid']) ?>' ><?= esc($users['username']) ?></td>
                      <td id='name_<?= esc($users['userid']) ?>' ><?= esc($users['name']) ?></td>
                      <td id='utype_<?= esc($users['userid']) ?>'><?= esc($users['type']) ?></td>
                      <td id='stafftype_' ><?php echo displayTByUid($staff, $users['userid']);?></td>
                    <td id='staffid_'><?php echo displaySidByUid($staff, $users['userid']);?></td>

                    <td><button type="button" class="btn btn-secondary btn-sm" id='edit_<?= esc($users['userid']) ?>' onclick='editUser(<?= esc($users['userid']) ?>)'>Edit</button>
                      <button type="button" class="btn btn-secondary btn-sm" id="delete_<?= esc($users['userid']) ?>" data-href="/users/delete/<?= esc($users['userid']) ?>">Delete</button>
                    </td>

                  
                    </tr>
                    <?php 
                endforeach;
              else: ?>
                    <tr><td id='uname_<?= esc($users['userid']) ?>' ><?= esc($users['username']) ?></td>
                    <td id='name_<?= esc($users['userid']) ?>' ><?= esc($users['name']) ?></td>
                    <td id='utype_<?= esc($users['userid']) ?>'><?= esc($users['type']) ?></td>
                    <td id='stafftype_' ><?php echo displayTByUid($staff, $users['userid']);?></td>
                    <td id='staffid_'><?php echo displaySidByUid($staff, $users['userid']);?></td> 
                    
                    <td><button id='edit_<?= esc($users['userid']) ?>' onclick='console.log("Edit button clicked"); editUser(<?= esc($users['userid']) ?>)'>Edit</button></td>
                    </tr>

               <?php endif  ?>
                  
              </tbody>
              <?php else: ?>
                
                <tbody>
              <p class="error" >No users were found</p>
                </tbody>
              <?php endif ;
                  function displaySidByUid($array, $userId) {
                    foreach ($array as $item) {
                        if ($item['uid'] == $userId) return $item['sid'];
                    }
                    return null;
                }
                function displayTByUid($array, $userId) {
                  foreach ($array as $item) {
                      if ($item['uid'] == $userId) return $item['t'];
                  }
                  return null;
              }?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



<?= $this->endSection() ?>
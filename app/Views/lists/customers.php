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
					<h2 class="heading-section">Customer list</h2>
				</div>
			</div>

      <div class="row justify-content-left">
				<div class="col-md-4 text-center mb-5">
          <a class="nav-link btn btn-success create-new-button" href="/users/register">Add New User +</a>
				</div>
			</div>
    

			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table " id="datatable">
						  <thead>
						    <tr>
                  <th> Customer id </th>
                  <th> Username </th>
                  <th> Full name </th>
                  <th> Email address </th>
                  <th> Phone </th>
                  <th> Actions </th>
						    </tr>
						  </thead>
              <?php
              if(!empty($users) && is_array($users)): 

              // view_cell('\App\Libraries\Users::userlist', ['title'=>$userid]);
                  ?>
              <tbody>
                <?php 
              if (!$customerid):
                foreach($users as $users): 
                if($users['type'] !== 'customer'){continue;}?>

                    <tr>
                      <td id='customerid_<?= esc($users['userid']) ?>' ><?php echo displayCidByUid($customer,$users['userid']) ?></td>
                      <td id='uname_<?= esc($users['userid']) ?>' ><?= esc($users['username']) ?></td>
                      <td id='name_<?= esc($users['userid']) ?>' ><?= esc($users['name']) ?></td>
                      <td id='email_<?= esc($users['userid']) ?>' ><?= esc($users['email']) ?></td>
                      <td id='phone_<?= esc($users['userid']) ?>' ><?php echo displayPhoneByUid($customer,$users['userid']) ?></td>

                      <td><button type="button" class="btn btn-secondary btn-sm" id='edit_<?= esc($users['userid']) ?>' onclick='editUser(<?= esc($users['userid']) ?>)'>Edit</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="delete_<?= esc($users['userid']) ?>" data-href="/users/delete/<?= esc($users['userid']) ?>">Delete</button>
                      </td>
                    </tr>
                    <?php 
                endforeach;
              else: ?>
                    <tr>
                      <td id='customerid_<?= esc($users['userid']) ?>' ><?php echo displayCidByUid($customer,$users['userid']) ?></td>
                      <td id='uname_<?= esc($users['userid']) ?>' ><?= esc($users['username']) ?></td>
                      <td id='name_<?= esc($users['userid']) ?>' ><?= esc($users['name']) ?></td>
                      <td id='email_<?= esc($users['userid']) ?>' ><?= esc($users['email']) ?></td>
                      <td id='phone_<?= esc($users['userid']) ?>' ><?php echo displayPhoneByUid($customer,$users['userid']) ?></td>

                      <td><button type="button" class="btn btn-secondary btn-sm" id='edit_<?= esc($users['userid']) ?>' onclick='editUser(<?= esc($users['userid']) ?>)'>Edit</button>
                        <button type="button" class="btn btn-secondary btn-sm" id="delete_<?= esc($users['userid']) ?>" data-href="/users/delete/<?= esc($users['userid']) ?>">Delete</button>
                      </td>
                    </tr>
               <?php endif  ?>
                  
              </tbody>
              <?php else: ?>
                
                <tbody>
              <p class="error" >No users were found</p>
                </tbody>
              <?php endif ;
                  function displayCidByUid($array, $userId) {
                    foreach ($array as $item) {
                        if (isset($item[0]['userid']) && isset($item[0]['customerid']) && $item[0]['userid'] == $userId) {
                            return $item[0]['customerid'];
                        }
                    }
                    return null;
                }
                function displayPhoneByUid($array, $userId) {
                  foreach ($array as $item) {
                      if (isset($item[0]['userid']) && isset($item[0]['phone']) && $item[0]['userid'] == $userId) {
                          return $item[0]['phone'];
                      }
                  }
                  return null;
              }
                
                ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



<?= $this->endSection() ?>
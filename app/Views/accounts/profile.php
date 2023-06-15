<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>profile edit data and skills - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	body{
    background: #f7f7ff;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
.me-2 {
    margin-right: .5rem!important;
}
    </style>
</head>
<body> -->
<?= $this->extend('layouts/main') ?>   
<?= $this->section('content') ?>  

<div class="row">
<div class="col-lg-4">
<div class="card">
<div class="card-body">
<div class="d-flex flex-column align-items-center text-center">
<img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
<div class="mt-3">
<h4><?= $name ?></h4>
<p class="text-secondary mb-1"><?= $type ?></p>
<!-- <button class="btn btn-outline-primary">Message</button> -->
</div>
</div>
<hr class="my-4">
</div>
</div>
</div>
<div class="col-lg-8">
<div class="card">
<div class="card-body">
    <form action="/accounts/profile" method="POST">
<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0">Username</h6>
</div>
<div class="col-sm-9 text-secondary">
<input type="text" class="form-control" value="<?= $user['name'] ?>">
</div>
</div>
<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0">Full Name</h6>
</div>
<div class="col-sm-9 text-secondary">
<input type="text" class="form-control" value="<?= $name ?>">
</div>
</div>
<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0">Email</h6>
</div>
<div class="col-sm-9 text-secondary">
<input type="text" class="form-control" value="<?= $user['email'] ?>">
</div>
</div>

<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0">Mobile</h6>
</div>
<div class="col-sm-9 text-secondary">
<input type="text" class="form-control" value="">
</div>
</div>

<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0">Password</h6>
</div>
<div class="col-sm-9 text-secondary">
<input type="password" class="form-control" placeholder="Current password" name="password">
</div>
</div>

<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0">New Password</h6>
</div>
<div class="col-sm-9 text-secondary">
<input type="password" class="form-control" placeholder="New password" name="newpassword">
</div>
</div>

<div class="row mb-3">
<div class="col-sm-3">
<h6 class="mb-0">Repeat New Password</h6>
</div>
<div class="col-sm-9 text-secondary">
<input type="password" class="form-control" placeholder="Repeat new password" name="renewpassword">
</div>
</div>

<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-9 text-secondary">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="card-body">




</div>
</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
<?= $this->endSection('content');

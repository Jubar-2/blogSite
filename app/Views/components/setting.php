<form method="post" action="<?= base_url('changePass') ?>">
    <div class="form-group">
        <label for="exampleInputEmail1">Old Password</label>
        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="oldPassword" placeholder="Enter email">

    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">New Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
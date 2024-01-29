<?= $this->extend('./components/index.php') ?>
<?= $this->section('content') ?>
<div class="container">
    <?php $sessionMass = session()->getFlashdata('Errmass'); ?>
    <div class="w-50 mx-auto">
        <div class="w-100" style="padding-top:150px">
            <?php if (session()->getFlashdata('mass')) : ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('mass') ?>
                    </div>
                </div>
            <?php endif ?>
            <form method="post" action="<?= base_url('usersRegistration') ?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Fast Name</label>
                    <input type="text" name="fast_name" class="form-control" id="exampleFormControlInput1" placeholder="Fast Name">
                    <?php if ($sessionMass !== null && isset($sessionMass['fast_name'])) : ?>
                        <small class="text-danger"><?= $sessionMass['fast_name'] ?></small>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Last Name</label>
                    <input type="text" name="Last_name" class="form-control" id="exampleFormControlInput1" placeholder="Last Name">
                    <?php if ($sessionMass !== null && isset($sessionMass['Last_name'])) : ?>
                        <small class="text-danger"><?= $sessionMass['Last_name'] ?></small>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">User Name</label>
                    <input type="text" name="userName" class="form-control" id="exampleFormControlInput1" placeholder="User Name">
                    <?php if ($sessionMass !== null && isset($sessionMass['userName'])) : ?>
                        <small class="text-danger"><?= $sessionMass['userName'] ?></small>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
                    <?php if ($sessionMass !== null && isset($sessionMass['email'])) : ?>
                        <small class="text-danger"><?= $sessionMass['email'] ?></small>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Birth Of Date</label>
                    <input type="date" name="birthOfDate" class="form-control" id="exampleFormControlInput1" placeholder="Birth Of Date">
                    <?php if ($sessionMass !== null && isset($sessionMass['birthOfDate'])) : ?>
                        <small class="text-danger"><?= $sessionMass['birthOfDate'] ?></small>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Gender</label>
                    <select class="form-control" name="gender" id="exampleFormControlSelect1">
                        <option>Select one</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <?php if ($sessionMass !== null && isset($sessionMass['gender'])) : ?>
                        <small class="text-danger"><?= $sessionMass['gender'] ?></small>
                    <?php endif ?>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Country</label>
                            <input type="text" name="country" class="form-control" id="exampleFormControlInput1" placeholder="Country">
                            <?php if ($sessionMass !== null && isset($sessionMass['country'])) : ?>
                                <small class="text-danger"><?= $sessionMass['country'] ?></small>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">District</label>
                            <input type="text" name="district" class="form-control" id="exampleFormControlInput1" placeholder="District">
                            <?php if ($sessionMass !== null && isset($sessionMass['district'])) : ?>
                                <small class="text-danger"><?= $sessionMass['district'] ?></small>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Division</label>
                            <input type="text" name="division" class="form-control" id="exampleFormControlInput1" placeholder="Division">
                            <?php if ($sessionMass !== null && isset($sessionMass['division'])) : ?>
                                <small class="text-danger"><?= $sessionMass['division'] ?></small>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="Password">
                    <?php if ($sessionMass !== null && isset($sessionMass['password'])) : ?>
                        <small class="text-danger"><?= $sessionMass['password'] ?></small>
                    <?php endif ?>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="exampleFormControlInput1" placeholder="Confirm Password">
                    <?php if ($sessionMass !== null && isset($sessionMass['confirm_password'])) : ?>
                        <small class="text-danger"><?= $sessionMass['confirm_password'] ?></small>
                    <?php endif ?>

                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input " name="agree" value="true" type="checkbox" id="gridCheck">

                        <?php if ($sessionMass !== null && isset($sessionMass['agree'])) : ?>
                            <label class="form-check-label text-danger" for="gridCheck">
                                Check me out
                            </label>
                        <?php else : ?>
                            <label class="form-check-label " for="gridCheck">
                                Check me out
                            </label>
                        <?php endif ?>
                    </div>
                </div>

                <div class="main-button">
                    <input class="sub-button" type="submit">
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
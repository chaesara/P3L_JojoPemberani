<div class="container-fluid">
<h1 class="h3 mb-2 text-gray-800">Edit Employee : <?= $employee['employee_name']; ?></h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form class="my-3 mx-3" method="post" action="">
            <div class="form-group">
                <label for="employee_name">Full Name</label>
                <input type="text" class="form-control form-control-user" id="employee_name" name="employee_name" value="<?= $employee['employee_name']; ?>">
            </div>
            <?= form_error('employee_name', '<small class="text-danger pl-3">', '</small>') ?>
            <div class="form-group">
                <label for="employee_address">Address</label>
                <input type="text" class="form-control form-control-user" id="employee_address" name="employee_address" value="<?= $employee['employee_address']; ?>">
            </div>
            <?= form_error('employee_address', '<small class="text-danger pl-3">', '</small>') ?>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">+62</span>
                <input type="text" class="form-control form-control-user" name="employee_phoneno" value="<?= $employee['employee_phoneno']; ?>">
                <?= form_error('employee_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="employee_birth">Birth Date</label>
                <input type="date" class="form-control form-control-user" id="employee_birth" name="employee_birth" value="<?= $employee['employee_birth']; ?>">
            </div>
            <hr class="sidebar-divider">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control form-control-user" id="username" name="username" value="<?= $employee['username']; ?>">
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" id="passowrd2" name="password2" placeholder="Confirm Password">
                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Confirm Edit
            </button>
        </form>
    </div>
</div>
</div>
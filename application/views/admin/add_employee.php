<div class="container-fluid">
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form class="my-3 mx-3" method="post" action="<?= base_url('employees/add_employees'); ?>">
            <div class="form-group">
                <label for="employee_name">Full Name</label>
                <input type="text" class="form-control form-Dcontrol-user" id="employee_name" name="employee_name" value="<?= set_value('employee_name') ?>">
                <?= form_error('employee_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="employee_address">Address</label>
                <input type="text" class="form-control form-control-user" id="employee_address" name="employee_address" value="<?= set_value('employee_address') ?>">
                <?= form_error('employee_address', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="employee_phoneno">Phone Number</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control form-control-user" name="employee_phoneno" value="<?= set_value('employee_phoneno') ?>">
                    <?= form_error('employee_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="employee_birth">Birth Date</label>
                <input type="date" class="form-control form-control-user" id="employee_birth" name="employee_birth" value="<?= set_value('employee_birth') ?>">
            </div>
            <hr class="sidebar-divider">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control form-control-user" id="username" name="username" value="<?= set_value('username') ?>">
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="password">Password</label>
                    <input type="password" class="form-control form-control-user" id="password1" name="password1">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="col-sm-6">
                    <label for="password2">Confirm Password</label>
                    <input type="password" class="form-control form-control-user" id="passowrd2" name="password2">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <hr class="sidebar-divider">
            <div class="form-group">
                <label for="Role">Roles</label>
                <select class="form-control" name="role" id="role">
                    <?php foreach ($role as $r) : ?>
                        <option value="<?= $r ?>"><?= $r ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Employee
            </button>
        </form>
    </div>
</div>
</div>
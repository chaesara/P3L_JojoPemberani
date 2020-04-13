<div class="container-fluid">
    <div class="card center o-hidden border-0 my-5 col-lg-8 mx-auto">
        <form class="my-3 mx-3" method="post" action="<?= base_url('employees/add_employees'); ?>">
            <div class="form-group">
                <input type="text" class="form-control form-Dcontrol-user" id="employee_name" name="employee_name" placeholder="Full Name" value="<?= set_value('employee_name') ?>">
                <?= form_error('employee_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="employee_address" name="employee_address" placeholder="Enter Address" value="<?= set_value('employee_address') ?>">
                <?= form_error('employee_address', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">+62</span>
                <input type="text" class="form-control form-control-user" name="employee_phoneno" placeholder="Phone Number" value="<?= set_value('employee_phoneno') ?>">
                <?= form_error('employee_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <input type="date" class="form-control form-control-user" id="employee_birth" name="employee_birth" placeholder="Birth Date" value="<?= set_value('employee_birth') ?>">
            </div>
            <hr class="sidebar-divider">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username') ?>">
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
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
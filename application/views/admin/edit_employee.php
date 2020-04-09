<div class="container-fluid">
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form class="my-3 mx-3" method="post" action="">
            <div class="form-group">
                <label for="employee_name">Full Name</label>
                <input type="text" class="form-control form-control-user" id="employee_name" name="employee_name" placeholder="Full Name" value="<?= $employee['employee_name']; ?>">
            </div>
            <?= form_error('employee_name', '<small class="text-danger pl-3">', '</small>') ?>
            <div class="form-group">
                <label for="employee_address">Address</label>
                <input type="text" class="form-control form-control-user" id="employee_address" name="employee_address" placeholder="Enter Address" value="<?= $employee['employee_address']; ?>">
            </div>
            <?= form_error('employee_address', '<small class="text-danger pl-3">', '</small>') ?>
            <div class="form-group">
                <label for="employee_phoneno">Phone Number</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control form-control-user" name="employee_phoneno" placeholder="Phone Number" value="<?= $employee['employee_phoneno']; ?>">
                    <?= form_error('employee_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="employee_birth">Birth Date</label>
                <input type="date" class="form-control form-control-user" id="employee_birth" name="employee_birth" placeholder="Birth Date" value="<?= $employee['employee_birth']; ?>">
            </div>
            <hr class="sidebar-divider">
            <div class="form-group">
                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= $employee['username'];     ?>">
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Submit
            </button>
        </form>
    </div>
</div>
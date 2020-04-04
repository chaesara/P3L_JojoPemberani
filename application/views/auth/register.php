<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="employee_name" name="employee_name" placeholder="Full Name" value="<?= set_value('employee_name') ?>">
                                <?= form_error('employee_name', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="employee_address" name="employee_address" placeholder="Enter Address" value="<?= set_value('employee_address') ?>">
                                <?= form_error('employee_address', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="employee_address" name="employee_address" placeholder="Enter Address" value="<?= set_value('employee_address') ?>">
                                <?= form_error('employee_address', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="text" class="form-control form-control-user" placeholder="Phone Number" aria-describedby="basic-addon1">
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control form-control-user" id="employee_birth" name="employee_birth" placeholder="Birth Date" value="<?= set_value('employee_birth') ?>">
                            </div>
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
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-user custom-select" name="role" id="role">
                                    <?php foreach ($role as $r) : ?>
                                        <option value="<?= $r ?>"><?= $r ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
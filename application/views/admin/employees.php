<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Employees List</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
    <a href="<?= base_url('employees/add_employees'); ?>"><button type="button" class="btn btn-primary mb-3">Add Employee</button></a>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Add Employee</button>
    <form action="" method="post">
        <div class="input-group mt-3 mb-3">
            <input type="text" class="form-control" placeholder="Enter a name..." name="keyword" value="<?= set_value('keyword'); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Birth Date</th>
                            <th>Username</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $e) : ?>
                            <tr>
                                <td><?= $e['employee_name'] ?></td>
                                <td><?= $e['role_name'] ?></td>
                                <td><?= $e['employee_address'] ?></td>
                                <td><?= $e['employee_phoneno'] ?></td>
                                <td><?= $e['employee_birth'] ?></td>
                                <td><?= $e['username'] ?></td>
                                <td><a href="<?= base_url(); ?>employees/edit_employees/<?= $e['employee_id']; ?>"><button type="button" class="btn btn-outline-primary">Edit</button></a>
                                    <a href="#" data-toggle="modal" data-target="#deleteModal"><button type="button" class="btn btn-outline-danger">Delete</button></a></td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="my-3 mx-3" method="post" action="<?= base_url('employees/add_employees'); ?>">
                <div class="form-group">
                    <input type="text" class="form-control form-Dcontrol-user" id="employee_name" name="employee_name" placeholder="Full Name" value="<?= set_value('employee_name') ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="employee_address" name="employee_address" placeholder="Enter Address" value="<?= set_value('employee_address') ?>">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control form-control-user" name="employee_phoneno" placeholder="Phone Number" value="<?= set_value('employee_phoneno') ?>">
                    <?= form_error('employees_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
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
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" id="passowrd2" name="password2" placeholder="Confirm Password">
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

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" below if you swear god want to delete</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="<?= base_url(); ?>employees/delete_employees/<?= $e['employee_id']; ?>">Delete</a>
            </div>
        </div>
    </div>
</div>
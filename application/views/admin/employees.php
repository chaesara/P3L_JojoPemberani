<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Employees List</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

    <button type="button" class="btn btn-primary mb-3" onclick="window.location.href = '<?= base_url('employees/add_employees'); ?>';">Add Employee</button>

    <div class="input-group mt-3 mb-3">
        <input type="text" class="form-control" id="searchInput" onkeyup="search()" placeholder="Search by a name...">
    </div>

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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $e) : ?>
                            <?php if ($e['DELETED_AT'] === NULL) : ?>
                                <tr>
                                    <td><?= $e['employee_name'] ?></td>
                                    <td><?= $e['role_name'] ?></td>
                                    <td><?= $e['employee_address'] ?></td>
                                    <td><?= $e['employee_phoneno'] ?></td>
                                    <td><?= $e['employee_birth'] ?></td>
                                    <td><?= $e['username'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href = '<?= base_url(); ?>employees/edit_employees/<?= $e['employee_id']; ?>';"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href = '<?= base_url(); ?>employees/delete_employees/<?= $e['employee_id']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            <?php endif; ?>
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
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Employees List</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
    <a href="<?= base_url('employees/add_employees'); ?>"><button type="button" class="btn btn-primary mb-3">Add Employee</button></a>
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
                                    <a href="<?= base_url(); ?>employees/delete_employees/<?= $e['employee_id']; ?>"><button type="button" class="btn btn-danger">Delete</button> </a></td>
                                
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

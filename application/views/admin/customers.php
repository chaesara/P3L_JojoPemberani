<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Customers List</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
    <a href="<?= base_url('customers/add_customers'); ?>"><button type="button" class="btn btn-primary mb-3">Add Customer</button></a>
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
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Birth Date</th>
                            <th>Membership</th>
                            <th>Updated by</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($customers != null) : ?>
                            <?php foreach ($customers as $c) : ?>
                                <tr>
                                    <td><?= $c['customer_name'] ?></td>
                                    <td><?= $c['customer_address'] ?></td>
                                    <td><?= $c['customer_phoneno'] ?></td>
                                    <td><?= $c['customer_birth'] ?></td>
                                    <td><?= $c['customer_membership'] ?></td>
                                    <td><?= $c['employee_name'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href = '<?= base_url(); ?>customers/edit_customers/<?= $c['customer_id']; ?>';"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href = '<?= base_url(); ?>customers/delete_customers/<?= $c['customer_id']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7">
                                    <h3 class="text-center">list was empty</h3>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
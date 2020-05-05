<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Suppliers List</h1>
    <a href="<?= base_url('suppliers/add_suppliers'); ?>"><button type="button" class="btn btn-primary mb-3">Add Supplier</button></a>
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
                            <th>Updated by</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($suppliers != null) : ?>
                            <?php foreach ($suppliers as $s) : ?>
                                <?php if ($s['DELETED_AT'] === NULL) : ?>
                                    <tr>
                                        <td><?= $s['supplier_name'] ?></td>
                                        <td><?= $s['supplier_address'] ?></td>
                                        <td><?= $s['supplier_phoneno'] ?></td>
                                        <td><?= $s['employee_name'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-secondary" onclick="window.location.href = '<?= base_url(); ?>suppliers/edit_suppliers/<?= $s['supplier_id']; ?>';"><i class="fas fa-pencil-alt"></i></button>
                                            <button type="button" class="btn btn-danger" onclick="window.location.href = '<?= base_url(); ?>suppliers/delete_suppliers/<?= $s['supplier_id']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7">
                                    <h3 class="text-center">list was empty</h3>
                                    <p class="text-center">what are you looking for ?</p>
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
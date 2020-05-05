<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Suppliers List</h1>
    <a href="<?= base_url('suppliers/add_suppliers'); ?>"><button type="button" class="btn btn-primary mb-3">Add Supplier</button></a>

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
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Updated by</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($suppliers != null) : ?>
                            <?php foreach ($suppliers as $c) : ?>
                                <?php if ($c['DELETED_AT'] === NULL) : ?>
                                    <tr>
                                        <td><?= $c['supplier_name'] ?></td>
                                        <td><?= $c['supplier_address'] ?></td>
                                        <td><?= $c['supplier_phoneno'] ?></td>
                                        <td><?= $c['employee_name'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-secondary" onclick="window.location.href = '<?= base_url(); ?>suppliers/edit_suppliers/<?= $c['supplier_id']; ?>';"><i class="fas fa-pencil-alt"></i></button>
                                            <button type="button" class="btn btn-danger" onclick="window.location.href = '<?= base_url(); ?>suppliers/delete_suppliers/<?= $c['supplier_id']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
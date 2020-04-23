<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">sizes List</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
    <a href="<?= base_url('sizes/add_sizes'); ?>"><button type="button" class="btn btn-primary mb-3">Add size</button></a>

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
                            <th>Updated by</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($sizes != null) : ?>
                            <?php foreach ($sizes as $c) : ?>
                                <?php if ($c['DELETED_AT'] === NULL) : ?>
                                    <tr>
                                        <td><?= $c['size_name'] ?></td>
                                        <td><?= $c['employee_name'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-secondary" onclick="window.location.href = '<?= base_url(); ?>sizes/edit_sizes/<?= $c['size_id']; ?>';"><i class="fas fa-pencil-alt"></i></button>
                                            <button type="button" class="btn btn-danger" onclick="window.location.href = '<?= base_url(); ?>sizes/delete_sizes/<?= $c['size_id']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
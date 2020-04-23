<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Services</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
    <a href="<?= base_url('services/add_services'); ?>"><button type="button" class="btn btn-primary mb-3">Add Service</button></a>

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
                            <th>Size</th>
                            <th>Price</th>
                            <th>Updated by</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $s) : ?>
                            <?php if ($s['DELETED_AT'] === NULL) : ?>
                                <tr>
                                    <td><?= $s['service_name'] ?></td>
                                    <td><?= $s['size_name'] ?></td>
                                    <td><?= $s['service_price'] ?></td>
                                    <td><?= $s['employee_name'] ?></td>
                                    <td>
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href = '<?= base_url(); ?>services/edit_services/<?= $s['service_id']; ?>';"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="window.location.href = '<?= base_url(); ?>services/delete_services/<?= $s['service_id']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
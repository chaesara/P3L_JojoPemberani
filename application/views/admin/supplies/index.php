<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Supplies List</h1>
    <a href="<?= base_url('supplies/add_supplies'); ?>"><button type="button" class="btn btn-primary mb-3">Add Supply Order</button></a>

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
                            <th>Code</th>
                            <th>Supplier</th>
                            <th>Status</th>
                            <th>Updated by</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($supplies != null) : ?>
                            <?php foreach ($supplies as $c) : ?>
                                <tr>
                                    <td><a class="list-group-item-action" href="<?= base_url(); ?>supplies/detail_supplies/<?= $c['supply_id']; ?>"><?= $c['supply_code'] ?></a></td>
                                    <td><?= $c['supplier_name'] ?></td>
                                    <?php if ($c['supply_status'] === 'Draft') : ?>
                                        <td class="text-secondary"><?= $c['supply_status'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($c['supply_status'] === 'Completed') : ?>
                                        <td class="text-success"><?= $c['supply_status'] ?></td>
                                    <?php endif; ?>
                                    <?php if ($c['supply_status'] === 'Deleted') : ?>
                                        <td class="text-warning"><?= $c['supply_status'] ?></td>
                                    <?php endif; ?>
                                    <td><?= $c['employee_name'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7">
                                    <h3 class="text-center">list was empty</h3>
                                    <p class="text-center">what are you looking for ?</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <p><i>Click to view/edit supply order</i></p>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
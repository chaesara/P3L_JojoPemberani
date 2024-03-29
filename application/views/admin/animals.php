<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Animals</h1>
    <a href="<?= base_url('animals/add_animals'); ?>"><button type="button" class="btn btn-primary mb-3">Add Animal</button></a>

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
                            <th>Animal Name</th>
                            <th>Type</th>
                            <th>Owned by</th>
                            <th>Birth Date</th>
                            <th>Updated by</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($animals as $a) : ?>
                            <tr>
                                <td><?= $a['animal_name'] ?></td>
                                <td><?= $a['type_name'] ?></td>
                                <td><?= $a['customer_name'] ?></td>
                                <td><?= $a['animal_birth'] ?></td>
                                <td><?= $a['employee_name'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href = '<?= base_url(); ?>animals/edit_animals/<?= $a['animal_id']; ?>';"><i class="fas fa-pencil-alt"></i></button>
                                    <button type="button" class="btn btn-danger" onclick="window.location.href = '<?= base_url(); ?>animals/delete_animals/<?= $a['animal_id']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </td>
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
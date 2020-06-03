<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products List</h1>
    <a href="<?= base_url('products/add_products'); ?>"><button type="button" class="btn btn-primary mb-3">Add Product</button></a>


    <!-- DataTales Example -->
    <div class="input-group mt-3 mb-3">
        <input type="text" class="form-control" id="searchInput" onkeyup="search()" placeholder="Search by a name...">
    </div>





    <!-- /.container-fluid -->


    <!-- End of Main Content -->


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Updated by</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p) : ?>
                            <tr>
                                <td><a class="list-group-item-action" href="<?= base_url(); ?>products/edit_products/<?= $p['product_id'] ?>">
                                        <?= $p['product_name'] ?>
                                    </a>
                                </td>
                                <td><img style="max-height:100px;
                    max-width:100px;
                    height:auto;
                    width:auto;" src="<?= base_url(); ?>assets/products/<?= $p['image'] ?>" alt=""></td>
                                <td>
                                    <?= $p['product_quantity'] ?>
                                </td>
                                <td>
                                    <?= $p['product_price'] ?>
                                </td>
                                <td><?= $p['employee_name'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</div>
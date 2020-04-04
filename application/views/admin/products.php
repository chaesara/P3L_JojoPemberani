<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products List</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
    <a href="<?= base_url('products/add_products'); ?>"><button type="button" class="btn btn-primary mb-3">Add Product</button></a>
    <div class="nav nav-tabs" id="myTab" role="tablist">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
            </li>
        </ul>
    </div>

    <!-- DataTales Example -->
    <form action="" method="post">
        <div class="input-group mt-3 mb-3">
            <input type="text" class="form-control" placeholder="Enter a name..." name="keyword" value="<?= set_value('keyword'); ?>">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>





    <!-- /.container-fluid -->


    <!-- End of Main Content -->

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <?php foreach ($products as $p) : ?>
                    <div class="col-ml-auto">
                        <div class="card" style="width: 18rem;">
                            <img style="position: relative; max-height: 120px;" class="card-img-top" src="<?= base_url(); ?>assets/products/<?= $p['img'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?= $p['product_name'] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><?= $p['product_price'] ?></li>
                                <li class="list-group-item"><?= $p['product_quantity'] ?></li>
                                <li class="list-group-item"><?= $p['employee_name'] ?></li>
                            </ul>
                            <div class="card-body">
                                <a href="#" class="card-link">Edit</a>
                                <a href="#" class="card-link text-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Updated by</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $p) : ?>
                                    <tr>
                                        <td><?= $p['product_name'] ?></td>
                                        <td><img style="max-height:100px;
                    max-width:100px;
                    height:auto;
                    width:auto;" src="<?= base_url(); ?>assets/products/<?= $p['img'] ?>" alt=""></td>
                                        <td><?= $p['employee_name'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">..eqweqwe.</div>
    </div>

</div>
</div>
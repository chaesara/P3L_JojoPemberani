<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-2 text-gray-800">Edit Service : <?= $service['service_name']; ?></h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form method="post" class="my-3 mx-3" id="submit" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Service Name</label>
                <input type="text" class="form-control" id="service_name" name="service_name" value="<?= $service['service_name']; ?>">
                <?= form_error('service_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Rp </span>
                    <input type="text" class="form-control" id="service_price" name="service_price" value="<?= $service['service_price']; ?>">
                    <?= form_error('service_price', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Confirm Edit
            </button>
        </form>
    </div>
</div>
</div>
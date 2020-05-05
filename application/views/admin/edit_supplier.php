<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-2 text-gray-800">Update Supplier : <?= $supplier['supplier_name']; ?></h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form method="post" class="my-3 mx-3" id="submit" enctype="multipart/form-data">
            <div class="form-group">
                <label for="supplier_name">Full Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter supplier name..." value="<?= $supplier['supplier_name']; ?>">
                <?= form_error('supplier_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="supplier_address">Address</label>
                <input type="text" class="form-control" id="supplier_address" name="supplier_address" placeholder="Enter supplier address..." value="<?= $supplier['supplier_address']; ?>">
                <?= form_error('supplier_address', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="supplier_phoneno">Phone Number</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control form-control-user" name="supplier_phoneno" placeholder="Enter a phone number..." value="<?= $supplier['supplier_phoneno']; ?>">
                    <?= form_error('supplier_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Confirm Update
            </button>
        </form>
    </div>
</div>
</div>
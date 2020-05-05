<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add Supplier</h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form class="my-3 mx-3" method="POST" action="<?= base_url('suppliers/add_suppliers'); ?>">
            <div class="form-group">
                <label for="supplier_name">Full Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Enter supplier name..." value="<?= set_value('supplier_name') ?>">
                <?= form_error('supplier_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="supplier_address">Address</label>
                <input type="text" class="form-control" id="supplier_address" name="supplier_address" placeholder="Enter supplier address..." value="<?= set_value('supplier_address') ?>">
                <?= form_error('supplier_address', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="supplier_phoneno">Phone Number</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control form-control-user" name="supplier_phoneno" placeholder="Enter a phone number..." value="<?= set_value('supplier_phoneno') ?>">
                    <?= form_error('supplier_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <hr class="sidebar-divider">
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Supplier
            </button>
        </form>
    </div>
</div>
</div>
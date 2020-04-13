<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add Customer</h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form class="my-3 mx-3" method="POST" action="<?= base_url('customers/add_customers'); ?>">
            <div class="form-group">
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Full Name" value="<?= set_value('customer_name') ?>">
                <?= form_error('customer_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Address" value="<?= set_value('customer_address') ?>">
                <?= form_error('customer_address', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">+62</span>
                <input type="text" class="form-control form-control-user" name="customer_phoneno" placeholder="Phone Number" value="<?= set_value('customer_phoneno') ?>">
                <?= form_error('customer_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <input type="date" class="form-control form-control-user" id="customer_birth" name="customer_birth" placeholder="Birth Date" value="<?= set_value('employee_birth') ?>">
                <?= form_error('customer_birth', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <hr class="sidebar-divider">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Membership</label>
                <select class="form-control" id="customer_membership" name="customer_membership">
                    <option disabled selected value=""> Choose one... </option>
                    <option value="Regular">Regular</option>
                    <option value="Member">Member</option>
                </select>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Customer
            </button>
        </form>
    </div>
</div>
</div>
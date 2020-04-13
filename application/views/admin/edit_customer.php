<div class="container-fluid">
<<<<<<< HEAD
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-2 text-gray-800">Edit Customer : <?= $customer['customer_name']; ?></h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form method="post" class="my-3 mx-3" id="submit" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Full Name" value="<?= $customer['customer_name']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Address" value="<?= $customer['customer_address']; ?>">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">+62</span>
                <input type="text" class="form-control form-control-user" name="customer_phoneno" placeholder="Phone Number" value="<?= $customer['customer_phoneno']; ?>">
            </div>
            <div class="form-group">
                <input type="date" class="form-control form-control-user" id="customer_birth" name="customer_birth" placeholder="Birth Date" value="<?= $customer['customer_birth']; ?>">
=======
    <h1 class="h3 mb-2 text-gray-800">Edit Customer</h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form class="my-3 mx-3" method="POST" action="<?= base_url('customers/edit_customers'); ?>">
            <div class="form-group">
                <label for="customer_name">Full Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Full Name" value="<?= $customer['customer_name']; ?>">
                <?= form_error('customer_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="customer_address">Address</label>
                <input type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Address" value="<?= $customer['customer_address']; ?>">
                <?= form_error('customer_address', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="customer_phoneno">Phone Number</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+62</span>
                    <input type="text" class="form-control form-control-user" name="customer_phoneno" placeholder="Phone Number" value="<?= $customer['customer_phoneno']; ?>">
                    <?= form_error('customer_phoneno', '<small class="text-danger pl-3">', '</small>') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="customer_birth">Birth Date</label>
                <input type="date" class="form-control form-control-user" id="customer_birth" name="customer_birth" placeholder="Birth Date" value="<?= $customer['customer_birth']; ?>">
                <?= form_error('customer_birth', '<small class="text-danger pl-3">', '</small>') ?>
>>>>>>> f66337224039f599c8cff1c0e4efc1f2a5571c56
            </div>
            <hr class="sidebar-divider">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Membership</label>
                <select class="form-control" id="customer_membership" name="customer_membership">
                    <option>Regular</option>
                    <option>Member</option>
                </select>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Confirm Edit
            </button>
        </form>
    </div>
<<<<<<< HEAD
</div>
=======
>>>>>>> f66337224039f599c8cff1c0e4efc1f2a5571c56
</div>
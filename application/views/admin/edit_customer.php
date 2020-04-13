<div class="container-fluid">
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
</div>
</div>
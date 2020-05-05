<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-2 text-gray-800">Edit Size : <?= $size['size_name']; ?></h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form method="post" class="my-3 mx-3" id="submit" enctype="multipart/form-data">
            <div class="form-group">
                <label for="size_name">Size Name</label>
                <input type="text" class="form-control" id="size_name" name="size_name" placeholder="Enter size name..." value="<?= $size['size_name']; ?>">
                <?= form_error('size_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Confirm Edit
            </button>
        </form>
    </div>
</div>
</div>
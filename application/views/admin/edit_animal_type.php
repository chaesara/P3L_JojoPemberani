<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-2 text-gray-800">Update Animal Types<?= $animal_type['animal_type_name']; ?></h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form method="post" class="my-3 mx-3" id="submit" enctype="multipart/form-data">
            <div class="form-group">
                <label for="animal_type_name">Full Name</label>
                <input type="text" class="form-control" id="animal_type_name" name="animal_type_name" placeholder="Ex. Dog" value="<?= $animal_type['animal_type_name']; ?>">
                <?= form_error('animal_type_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Confirm Update
            </button>
        </form>
    </div>
</div>
</div>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Add Animal Types</h1>
    <div class="card o-hidden border-0 my-5 col-lg-12 mx-auto">
        <form class="my-3 mx-3" method="POST" action="<?= base_url('animal_types/add_animal_types'); ?>">
            <div class="form-group">
                <label for="animal_type_name">Full Name</label>
                <input type="text" class="form-control" id="animal_type_name" name="animal_type_name" placeholder="Ex. Dog" value="<?= set_value('animal_type_name') ?>">
                <?= form_error('animal_type_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Animal Types
            </button>
        </form>
    </div>
</div>
</div>
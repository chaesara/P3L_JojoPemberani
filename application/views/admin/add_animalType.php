<div class="container-fluid">
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form class="my-3 mx-3" method="post" action="<?= base_url('animalTypes/add_animalTypes'); ?>">
            <div class="form-group">
                <label for="type_name">Type Name</label>
                <input type="text" class="form-control form-Dcontrol-user" id="type_name" name="type_name" value="<?= set_value('type_name') ?>">
                <?= form_error('type_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Animal Type
            </button>
        </form>
    </div>
</div>
</div>
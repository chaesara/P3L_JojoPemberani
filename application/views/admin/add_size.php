<div class="container-fluid">
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form class="my-3 mx-3" method="post" action="<?= base_url('sizes/add_sizes'); ?>">
            <div class="form-group">
                <label for="size_name">Size Name</label>
                <input type="text" class="form-control form-Dcontrol-user" id="size_name" name="size_name" value="<?= set_value('size_name') ?>">
                <?= form_error('size_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add size
            </button>
        </form>
    </div>
</div>
</div>
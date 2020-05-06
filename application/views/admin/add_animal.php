<div class="container-fluid">
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form class="my-3 mx-3" method="post" action="<?= base_url('animals/add_animals'); ?>">
            <div class="form-group">
                <label for="animal_name">Animal Name</label>
                <input type="text" class="form-control form-Dcontrol-user" id="animal_name" name="animal_name" value="<?= set_value('animal_name') ?>">
                <?= form_error('animal_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="animal_birth">Birth Date</label>
                <input type="date" class="form-control form-control-user" id="animal_birth" name="animal_birth" value="<?= set_value('animal_birth') ?>">
                <?= form_error('animal_birth', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="Customer">Owner</label>
                <select class="form-control" name="customer_name" id="customer_name">
                    <?php foreach ($customers as $c) : ?>
                        <option value="<?= $c['customer_name'] ?>"><?= $c['customer_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="animalTypes">Type</label>
                <select class="form-control" name="type_name" id="type_name">
                    <?php foreach ($types as $t) : ?>
                        <option value="<?= $t['type_name'] ?>"><?= $t['type_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Animal
            </button>
        </form>
    </div>
</div>
</div>
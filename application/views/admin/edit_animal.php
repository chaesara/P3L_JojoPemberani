<div class="container-fluid">
    <?= $this->session->flashdata('message'); ?>
    <h1 class="h3 mb-2 text-gray-800">Edit Animal : <?= $animal['animal_name']; ?></h1>
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form method="post" class="my-3 mx-3" id="submit" enctype="multipart/form-data">
            <div class="form-group">
                <label for="animal_name">Animal Name</label>
                <input type="text" class="form-control form-control-user" id="animal_name" name="animal_name" value="<?= $animal['animal_name'] ?>">
                <?= form_error('animal_name', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="animal_birth">Birth Date</label>
                <input type="date" class="form-control form-control-user" id="animal_birth" name="animal_birth" value="<?= $animal['animal_birth'] ?>">
                <?= form_error('animal_birth', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="form-group">
                <label for="Customer">Owner</label>
                <select class="form-control" name="customer_name" id="customer_name">
                    <?php foreach ($customers as $c) : ?>
                        <?php if ($animal['customer_id'] === $c['customer_id']) : ?>
                            <option selected value="<?= $c['customer_name'] ?>"><?= $c['customer_name'] ?></option>
                        <?php else : ?>
                            <option value="<?= $c['customer_name'] ?>"><?= $c['customer_name'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="animalTypes">Type</label>
                <select class="form-control" name="type_name" id="type_name">
                    <?php foreach ($types as $t) : ?>
                        <?php if ($animal['type_id'] === $t['type_id']) : ?>
                            <option selected value="<?= $t['type_name'] ?>"><?= $t['type_name'] ?></option>
                        <?php else : ?>
                            <option value="<?= $t['type_name'] ?>"><?= $t['type_name'] ?></option>
                        <?php endif; ?>
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
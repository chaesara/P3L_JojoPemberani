<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Supply Code : <?= $supply['supply_code']; ?></h1>
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form id="detail_form" class="my-3 mx-3" method="post">
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label for="Customer">Product</label>
                        <select class="form-control" name="product_name" id="product_name">
                            <?php foreach ($products as $c) : ?>
                                <option value="<?= $c['product_name'] ?>"><?= $c['product_name'] ?> - Store : <?= $c['product_quantity'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="supply_detail_quantity">Quantity</label>
                        <input type="text" class="form-control" id="supply_detail_quantity" name="supply_detail_quantity" value="<?= set_value('supply_detail_quantity') ?>">
                        <?= form_error('supply_detail_quantity', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="supply_detail_package">Package</label>
                        <input type="text" class="form-control" id="supply_detail_package" name="supply_detail_package" value="<?= set_value('supply_detail_package') ?>">
                        <?= form_error('supply_detail_package', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Detail
            </button>

        </form>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {

        $('#detail_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url('supplies/add_details'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            })
        })

    })
</script>
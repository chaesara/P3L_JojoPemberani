<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Transaction Code : <?= $transaction['transaction_code']; ?></h1>
    <h5 class="h3 mb-2 text-gray-600">Customer : <?= $transaction['customer_name']; ?></h5>
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
                        <label for="transaction_product_quantity">Quantity</label>
                        <input type="text" class="form-control" id="transaction_product_quantity" name="transaction_product_quantity" value="<?= set_value('transaction_product_quantity') ?>">
                        <?= form_error('transaction_product_quantity', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Product
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
                url: "<?= base_url('supplies/add_product_details'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            })
        })

    })
</script>
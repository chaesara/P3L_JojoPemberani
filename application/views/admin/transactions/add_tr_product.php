<div class="container-fluid">
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form id="transaction_form" class="my-3 mx-3" method="post">

            <div class="form-group">
                <label for="Customer">Customer</label>
                <select class="form-control" name="customer_name" id="customer_name">
                    <?php foreach ($customers as $c) : ?>
                        <option value="<?= $c['customer_name'] ?>"><?= $c['customer_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Transaction
            </button>

        </form>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {

        $('#transaction_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url('transactions/add_product_transactions'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            })
        })

    })
</script>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Transaction Code : <?= $transaction['transaction_code']; ?></h1>
    <h1 class="h5 mb-2 text-gray-800">Transaction Subtotal : <?= $transaction['transaction_subtotal']; ?></h1>
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form id="detail_form" class="my-3 mx-3" method="post">
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="transaction_discount">Discount</label>
                        <input type="text" class="form-control" id="transaction_discount" name="transaction_discount" value="<?= $transaction['transaction_discount']; ?>">
                        <?= form_error('transaction_discount', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Submit Discount
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
                url: "<?= base_url('transactions/add_discount'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            })
        })

    })
</script>
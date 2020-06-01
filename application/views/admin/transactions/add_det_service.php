<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Transaction Code : <?= $transaction['transaction_code']; ?></h1>
    <h5 class="h3 mb-2 text-gray-600">Customer : <?= $transaction['customer_name']; ?></h5>
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form id="detail_form" class="my-3 mx-3" method="post">
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label for="Services">Service</label>
                        <select class="form-control" name="service_name" id="service_name">
                            <?php foreach ($services as $s) : ?>
                                <option value="<?= $s['service_name'] ?>"><?= $s['service_name'] ?>  <?= $s['size_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <label for="Animal">Pet</label>
                        <select class="form-control" name="animal_name" id="animal_name">
                            <?php foreach ($animals as $a) : ?>
                                <option value="<?= $a['animal_name'] ?>"><?= $a['animal_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="transaction_service_quantity">Quantity</label>
                        <input type="text" class="form-control" id="transaction_service_quantity" name="transaction_service_quantity" value="<?= set_value('transaction_service_quantity') ?>">
                        <?= form_error('transaction_service_quantity', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Service
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
                url: "<?= base_url('supplies/add_service_details'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            })
        })

    })
</script>
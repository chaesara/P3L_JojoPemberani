<div class="container-fluid">
    <div class="card center o-hidden border-0 my-5 mx-auto">
        <form id="supply_form" class="my-3 mx-3" method="post">

            <div class="form-group">
                <label for="Customer">Supplier</label>
                <select class="form-control" name="supplier_name" id="supplier_name">
                    <?php foreach ($suppliers as $c) : ?>
                        <option value="<?= $c['supplier_name'] ?>"><?= $c['supplier_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <hr class="sidebar-divider">
            <button type="submit" class="btn btn-primary btn-user btn-block">
                Add Supply
            </button>

        </form>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {

        $('#supply_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url('supplies/add_supplies'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            })
        })

    })
</script>
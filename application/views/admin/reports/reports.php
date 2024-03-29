<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <h1>Reports</h1>
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action" id="list-monthlyIncome-list" data-toggle="list" href="#list-monthlyIncome" role="tab" aria-controls="profile">Monthly Income</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="list-monthlyIncome" role="tabpanel" aria-labelledby="list-monthlyIncome-list">
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Data
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php foreach ($year_tr as $y) : ?>
                                <a class="dropdown-item" href="<?= base_url() ?>reports/monthly_income/<?= $y['year'] ?>/<?= $y['month'] ?>"><?= $y['year'] ?> <?= $y['month'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
            </div>
        </div>
    </div>
</div>
</div>


<script>
    $(document).ready(function() {

        $('#service_monthly_report_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url('reports/monthly_services'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            })
        })

    })
</script>
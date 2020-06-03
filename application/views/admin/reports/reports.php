<div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-outcome-list" data-toggle="list" href="#list-outcome" role="tab" aria-controls="outcome">Outcome</a>
                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
                <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
                <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-outcome" role="tabpanel" aria-labelledby="list-outcome-list">
                    <h2>Laporn Pengadaan</h2>
                    <h5>Bulanan</h5>
                    <form id="report_form" action="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="animalTypes">Tahun</label>
                                    <select class="form-control" name="year" id="year">
                                        <?php foreach ($year as $y) : ?>
                                            <option value="<?= $y['year'] ?>"><?= $y['year'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="animalTypes">Bulan</label>
                                    <select class="form-control" name="month" id="month">
                                        <?php foreach ($month as $y) : ?>
                                            <option value="<?= $y['month'] ?>"><?= $y['month'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Print
                        </button>
                    </form>
                </div>
                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            $year = '2020';
                            $month = 'June';
                            ?>
                            <a class="dropdown-item" href="<?= base_url(); ?>reports/outcome/<?= $year ?>/<?= $month ?>">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
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

        $('#report_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "<?= base_url('reports/outcome'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json"
            })
        })

    })
</script>
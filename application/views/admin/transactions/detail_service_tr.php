<div class="container-fluid">
    <?= $this->session->flashdata('flash'); ?>
    <h1 class="h3 mb-2 text-gray-800">Transaction Code : <?= $transaction['transaction_code']; ?></h1>
    <h5 class="h3 mb-2 text-gray-600">Customer : <?= $transaction['customer_name']; ?></h5>
    <?php if ($transaction['transaction_status'] === 'Paid') : ?>
        <h5>Status : <span class="badge badge-success mb-3"><?= $transaction['transaction_status']; ?></span></h5>
    <?php elseif ($transaction['transaction_status'] === 'Not Yet') : ?>
        <h5>Status : <span class="badge badge-warning mb-3"><?= $transaction['transaction_status']; ?></span></h5>
    <?php else : ?>
        <h5>Status : <span class="badge badge-secondary mb-3"><?= $transaction['transaction_status']; ?></span></h5>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Qty</th>
                            <th>Progress</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($details != null) : ?>
                            <?php foreach ($details as $d) : ?>
                                <tr>
                                    <td><?= $d['service_name'] ?></td>
                                    <td><?= $d['transaction_service_quantity'] ?></td>
                                    <?php if ($transaction['transaction_status'] === 'Draft') : ?>
                                        <?php if ($d['transaction_service_progress'] === 'On Progress') : ?>
                                            <td><a class="list-group-item-action text-warning" href="<?= base_url(); ?>transactions/finish_service_progress/<?= $d['transaction_service_id']; ?>"><?= $d['transaction_service_progress'] ?></a></td>
                                        <?php else : ?>
                                            <td><a class="list-group-item-action text-success" href="<?= base_url(); ?>transactions/finish_service_progress/<?= $d['transaction_service_id']; ?>"><?= $d['transaction_service_progress'] ?></a></td>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <td class="text-success"><?= $d['transaction_service_progress'] ?></td>
                                    <?php endif; ?>
                                    <td><?= $d['transaction_service_subtotal'] ?></td>
                                    <td>
                                        <?php if (($transaction['transaction_status'] === 'Draft') && ($d['transaction_service_progress'] === 'On Progress')) : ?>
                                            <button type="button" class="btn btn-circle btn-secondary" onclick="window.location.href = '<?= base_url(); ?>transactions/edit_service_details/<?= $d['transaction_service_id']; ?>';"><i class="fas fa-pencil-alt"></i></button>
                                            <button type="button" class="btn btn-circle btn-danger" onclick="window.location.href = '<?= base_url(); ?>transactions/delete_service_details/<?= $d['transaction_service_id']; ?>';"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7">
                                    <h3 class="text-center">list was empty</h3>
                                    <p class="text-center">what are you looking for ?</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <p><i>Click <b>progress</b> or <b>edit button</b> to change service progress</i></p>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><b>Total</b></td>
                            <td><b><?= $transaction['transaction_subtotal'] ?></b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="input-group-btn my-3">
        <?php if ($transaction['transaction_status'] === 'Draft' && ($this->session->userdata('role_id') === '2')) : ?>
            <a href="<?= base_url(); ?>transactions/add_service_details/<?= $transaction['transaction_id']; ?>"><button type="button" class="btn btn-primary mb-3">Add Service</button></a>
            <!-- Button trigger modal -->
            <a href="<?= base_url(); ?>transactions/send_transaction_sr/<?= $transaction['transaction_id']; ?>"><button type="button" class="btn btn-success mb-3">Proceed to Cashier</button></a>
            <button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#cancelModal">
                Cancel Transaction
            </button>
        <?php endif; ?>
        <?php if (($transaction['transaction_status'] === 'Not Yet') && ($this->session->userdata('role_id') === '3')) : ?>
            <a href="<?= base_url(); ?>transactions/add_discount/<?= $transaction['transaction_id']; ?>"><button type="button" class="btn btn-primary mb-3">Add Discount</button></a>
            <a href="<?= base_url(); ?>transactions/send_payment/<?= $transaction['transaction_id']; ?>"><button type="button" class="btn btn-success mb-3">Finish Payment</button></a>
        <?php endif; ?>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to cancel the order ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Please check again, who knows you would to change your mind</p>
                <p>All products you want to order earlier will be vanish from universe forever !</p>
                <p>Seriously</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, I've changed my mind</button>
                <a href="<?= base_url(); ?>transactions/cancel_transaction_sr/<?= $transaction['transaction_id']; ?>"><button type="button" class="btn btn-danger">Yes, cancel it !</button></a>
            </div>
        </div>
    </div>
</div>
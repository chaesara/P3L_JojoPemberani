<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Alert Successfully add employee -->
    <?= $this->session->flashdata('flash'); ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Transactions List</h1>
    <a href="<?= base_url('transactions/add_product_transactions'); ?>"><button type="button" class="btn btn-primary mb-3">+ Product Transaction</button></a>
    <a href="<?= base_url('transactions/add_service_transactions'); ?>"><button type="button" class="btn btn-primary mb-3">+ Service Transaction</button></a>

    <div class="input-group mt-3 mb-3">
        <input type="text" class="form-control" id="searchInput" onkeyup="search()" placeholder="Search by a name...">
    </div>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Customer</th>
                            <th>CS</th>
                            <th>Cashier</th>
                            <th>Status</th>
                            <th>Sub Total</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($transactions != null) : ?>
                            <?php foreach ($transactions as $c) : ?>
                                <tr>
                                    <?php if (substr($c['transaction_code'], 0, 2) === 'PR') : ?>
                                        <td><a class="list-group-item-action" href="<?= base_url(); ?>transactions/detail_transaction_pr/<?= $c['transaction_id']; ?>"><?= $c['transaction_code'] ?></a></td>
                                    <?php else : ?>
                                        <td><a class="list-group-item-action" href="<?= base_url(); ?>transactions/detail_transaction_sr/<?= $c['transaction_id']; ?>"><?= $c['transaction_code'] ?></a></td>
                                    <?php endif; ?>
                                    <td><?= $c['customer_name'] ?></td>
                                    <td><?= $c['cs_name'] ?></td>
                                    <td><?= $c['cashier_name'] ?></td>
                                    <td><?= $c['transaction_status'] ?></td>
                                    <td><?= $c['transaction_subtotal'] ?></td>
                                    <td><?= $c['transaction_discount'] ?></td>
                                    <td><?= $c['transaction_total'] ?></td>
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
                        <p><i>Click to view/edit transaction detail</i></p>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
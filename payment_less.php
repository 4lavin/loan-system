<?php include 'db_connect.php' ?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" style="background: #144959; color: white;">
                <large class="card-title">
                    <div class="b-print-group">
                        <div class="list-title">
                            <p>Payment List</p>
                        </div>
                        <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2) : ?>
                            <div class="print">
                                <i class="ri-printer-line"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary btn-sm btn-block col-md-2 float-right" type="button" id="new_payments" style="font-size: 12px; line-height: 30px;"><i class="fa fa-plus"></i> New Payment</button>
                </large>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="loan-list">
                    <!-- Table structure -->
                    <colgroup>
                        <col width="10%">
                        <col width="20%">
                        <col width="15%">
                        <col width="20%">
                        <col width="20%">
                        <col width="10%" class="removeee">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center"><input type="checkbox" id="select-all"></th>
                            <th class="text-center">#</th>
                            <th class="text-center">Reference No</th>
                            <th class="text-center">Mode of Payment</th>
                            <th class="text-center">Receipt No</th>
                            <th class="text-center">Payee</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php
                        $i = 1;

                        $qry = $conn->query("SELECT p.*,l.ref_no,concat(b.lastname,', ',b.firstname,' ',b.middlename)as name, b.contact_no, b.address from payments p inner join loan_list l on l.id = p.loan_id inner join borrowers b on b.id = l.borrower_id where p.status_payment = 1 order by p.id asc");
                        while ($row = $qry->fetch_assoc()) :


                        ?>
                            <tr>
                                <td class="text-center"><input type="checkbox" class="payment-checkbox" data-id="<?php echo $row['id'] ?>"></td>
                                <td class="text-center" data-label="#"><?php echo $i++ ?></td>
                                <td data-label="Reference No.">
                                    <?php echo $row['ref_no'] ?>
                                </td>
                                <td data-label="Status" style="text-align: center;">
                                    <?php if ($row['mode_payment'] == 0) : ?>
                                        <span class="badge badge-warning">Cash</span>
                                    <?php elseif ($row['mode_payment'] == 1) : ?>
                                        <span class="badge badge-warning" style="background: #ADD8E6">Gcash</span>
                                    <?php elseif ($row['mode_payment'] == 2) : ?>
                                        <span class="badge badge-info" style="background: #90EE90">Maya</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Transaction No.">
                                    <?php echo $row['transaction_no'] ?>
                                </td>

                                <td data-label="Payee">
                                    <?php echo $row['payee'] ?>

                                </td>
                                <td data-label="Amount">
                                    <?php echo number_format($row['amount'], 2) ?>

                                </td>
                                <td data-label="Status" style="text-align: center;">
                                    <?php if ($row['status_payment'] == 0) : ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php elseif ($row['status_payment'] == 1) : ?>
                                        <span class="badge badge-warning"><small>Complete, to record <br> payment</small></span>
                                    <?php elseif ($row['status_payment'] == 2) : ?>
                                        <span class="badge badge-warning" style="background: #ADD8E6">Approved</span>
                                    <?php elseif ($row['status_payment'] == 3) : ?>
                                        <span class="badge badge-info" style="background: #FF474C">Declined</span>
                                    <?php endif; ?>
                                </td>

                                <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2) : ?>
                                    <td class="text-center removeee" data-label="Action">
                                        <button class="btn btn-outline-primary btn-sm edit_payment" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-outline-danger btn-sm delete_payment" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
                                    </td>
                                <?php endif; ?>

                            </tr>

                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for updating payment status -->
<div id="update-payment-modal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form id="update-payment-status-form">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="2">Approved</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary btn-sm update-selected-payments" type="button" style="font-size: 12px; line-height: 30px;"><i class="fa fa-edit"></i> Update Selected Payments</button>


<!-- JavaScript code -->
<script>
    $(document).ready(function() {
        // Event handler for the "Update Selected Payments" button
        $('.update-selected-payments').click(function() {
            var selectedIds = getSelectedPaymentIds();
            if (selectedIds.length > 0) {
                // Show modal for updating payment status
                $('#update-payment-modal').modal('show');
            } else {
                alert('Please select at least one payment.');
            }
        });

        // Function to handle form submission for updating payment status
        $('#update-payment-status-form').submit(function(e) {
            e.preventDefault();
            var status = $('#status').val();
            var ids = getSelectedPaymentIds();
            var totalAmount = 0;
            ids.forEach(function(id) {
                var amount = parseFloat($('[data-id="' + id + '"]').closest('tr').find('[data-label="Amount"]').text().replace(',', ''));
                totalAmount += amount;
            });
            $.ajax({
                url: 'update_payment.php',
                method: 'POST',
                data: {
                    ids: ids,
                    status: status,
                    totalAmount: totalAmount
                },
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Selected payments successfully updated", 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    } else {
                        alert_toast("Failed to update payments", 'error');
                    }
                }
            });
        });

        $('#loan-list').dataTable();

        $('#new_payments').click(function() {
            uni_modal("New Payment", "manage_payment.php", 'mid-large')
        });

        $('.edit_payment').click(function() {
            uni_modal("Edit Payment", "manage_payment.php?id=" + $(this).attr('data-id'), 'mid-large')
        });

        $('.delete_payment').click(function() {
            _conf("Are you sure to delete this data?", "delete_payment", [$(this).attr('data-id')])
        });

        $('#select-all').change(function() {
            $('.payment-checkbox').prop('checked', $(this).prop('checked'));
        });

        $('.payment-checkbox').change(function() {
            var allChecked = true;
            $('.payment-checkbox').each(function() {
                if (!$(this).prop('checked')) {
                    allChecked = false;
                    return false; // Break the loop if any checkbox is unchecked
                }
            });
            $('#select-all').prop('checked', allChecked);
        });

        function getSelectedPaymentIds() {
            var selectedIds = [];
            $('.payment-checkbox:checked').each(function() {
                selectedIds.push($(this).data('id'));
            });
            return selectedIds;
        }
    });
</script>
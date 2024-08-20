<?php include 'db_connect.php' ?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" style="background: #144959; color: white;">
                <large class="card-title">
                    <div class="b-print-group">
                        <div class="list-title">
                            <p>Pending Payment List</p>
                        </div>
                        <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2) : ?>
                            <div class="print">
                                <i class="ri-printer-line"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button class="btn btn-primary btn-sm btn-block col-md-2 float-right" type="button" id="new_payments" style="font-size: 12px; line-height: 30px;"><i class="fa fa-plus"></i> New
                        Payment</button>
                </large>

            </div>
            <div class="card-body">
                <table class="table table-bordered" id="loan-list">
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
                            <th class="text-center">#</th>
                            <th class="text-center">Reference No</th>
                            <th class="text-center">Mode of Payment</th>
                            <th class="text-center">Receipt No</th>
                            <th class="text-center">Payee</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Status</th>
                            <?php if ($_SESSION['login_type'] == 1 || $_SESSION['login_type'] == 2) : ?>
                                <th class="text-center removeee">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i = 1;

                        $qry = $conn->query("SELECT p.*,l.ref_no,concat(b.lastname,', ',b.firstname,' ',b.middlename)as name, b.contact_no, b.address from payments p inner join loan_list l on l.id = p.loan_id inner join borrowers b on b.id = l.borrower_id where p.status_payment = 0 order by p.id asc");
                        while ($row = $qry->fetch_assoc()) :


                        ?>
                            <tr>

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



<style>
    td p {
        margin: unset;
    }

    td img {
        width: 8vw;
        height: 12vh;
    }

    td {
        vertical-align: middle !important;
    }

    .card-title {
        display: flex;
        justify-content: space-between;
    }

    .print {
        color: #fff;
        background: #144959;
        border-radius: 50px;

        display: flex;
        justify-content: center;
        align-items: center;
        transition: .5s;
        margin: 0 10px;

    }


    .list-title {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .list-title p {
        font-weight: 700;
        margin: 0;
    }

    .b-print-group {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    @media only screen and (max-width: 1200px) {
        a.nav-item:after {
            background: none;
        }

        main#view-panel {
            width: 95%;
            margin-left: 60px;
            margin-top: 0;

        }

        nav#sidebar {
            width: 75px;
            overflow: hidden;
        }

        .logo1 {
            display: none;
        }

        .navbar .logout {
            right: 5%;
        }

    }

    @media only screen and (max-width: 1000px) {
        td:last-child {
            border-bottom: 1px #000 solid;
        }

        main#view-panel {
            width: 90%;
            margin-left: 80px;
            margin-top: 0;

        }

        .print:hover {
            background: #144959;
        }

        thead {
            display: none;
        }

        .table {
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;


        }

        tbody {
            width: 100%;
            padding: 0 20px 0 0;
        }

        tr,
        td {
            display: block;
            width: 100%;
        }

        .table td {
            position: relative;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .table td:before {
            position: absolute;
            content: attr(data-label);
            text-align: center;
            left: 0;
            width: 30%;
            font-weight: 700;


        }

    }

    @media only screen and (max-width: 800px) {
        main#view-panel {
            width: 90%;
            margin-left: 65px;
            margin-top: 0;

        }
    }


    @media print {
        #sidebar {
            transform: translateX(-1000px);
        }

        .container-fluid {
            position: relative;
            top: 0;
            left: -260px;
            width: 1500px;
            z-index: 1;
        }

        .container-fluid {
            position: relative;
            top: 0;
            width: 135%;
            z-index: 1;
        }

        .container-fluid .card-header .btn,
        .container-fluid .print,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_paginate,
        .removeee {
            display: none;
        }
    }
</style>
<script>
    $('#loan-list').dataTable()
    $('#new_payments').click(function() {
        uni_modal("New Payement", "manage_payment.php", 'mid-large')
    })
    $('.edit_payment').click(function() {
        uni_modal("Edit Payement", "manage_payment.php?id=" + $(this).attr('data-id'), 'mid-large')
    })
    $('.delete_payment').click(function() {
        _conf("Are you sure to delete this data?", "delete_payment", [$(this).attr('data-id')])
    })

    function delete_payment($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_payment',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Payment successfully deleted", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>
<script>
    const printBtn = document.querySelector(".print")

    printBtn.addEventListener("click", () => {
        print()
    })
</script>
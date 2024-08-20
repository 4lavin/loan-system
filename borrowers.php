<?php include 'db_connect.php' ?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header" style="background: #144959; color: white;	">
                <large class="card-title">
                    <div class="b-print-group">
                        <div class="list-title">
                            <p>Borrower List</p>
                        </div>
                        <div class="print">
                            <i class="ri-printer-line"></i>
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block col-md-2 float-right btncreate" type="button"
                        id="new_borrower" style="font-size: 12px;"> <i class="fa fa-plus"></i> New Borrower</button>
                </large>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="borrower-list">
                    <colgroup>
                        <col width="10%">
                        <col width="80%">
                        <col width="10% " class="removeee">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Borrower</th>
                            <th class="text-center removeee">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$i = 1;
							$qry = $conn->query("SELECT * FROM borrowers order by id desc");
							while($row = $qry->fetch_assoc()):

						 ?>
                        <tr>

                            <td data-label="#"><?php echo $i++ ?></td>
                            <td data-label="Borrower">
                                <p>Name
                                    :<b><?php echo ucwords($row['lastname'].", ".$row['firstname'].' '.$row['middlename']) ?></b>
                                </p>
                                <p><small>Address :<b><?php echo $row['address'] ?></small></b></p>
                                <p><small>Contact # :<b><?php echo $row['contact_no'] ?></small></b></p>
                                <p><small>Email :<b><?php echo $row['email'] ?></small></b></p>
                                <p><small>Tax ID :<b><?php echo $row['tax_id'] ?></small></b></p>

                            </td>
                            <td class=" removeee text-center" data-label="Action">
                                <button class="btn btn-outline-primary btn-sm edit_borrower" type="button"
                                    data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>

                                <?php if($_SESSION['login_type'] == 1): ?>
                                <button class="btn btn-outline-danger btn-sm delete_borrower" type="button"
                                    data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>

                                <?php endif; ?>
                            </td>

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
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: .5s;
    margin-left: 5px;

}

.print:hover {
    background: #1f667b;

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
    a.nav-item {
        border: none;
    }
    a.nav-item:after {
  display:none;
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
     
.text-center {
  text-align: right !important;
}
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
        text-align: right;
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
$('#borrower-list').dataTable()
$('#new_borrower').click(function() {
    uni_modal("New borrower", "manage_borrower.php", 'mid-large')
})
$('.edit_borrower').click(function() {
    uni_modal("Edit borrower", "manage_borrower.php?id=" + $(this).attr('data-id'), 'mid-large')
})
$('.delete_borrower').click(function() {
    _conf("Are you sure to delete this borrower?", "delete_borrower", [$(this).attr('data-id')])
})

function delete_borrower($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_borrower',
        method: 'POST',
        data: {
            id: $id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("borrower successfully deleted", 'success')
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
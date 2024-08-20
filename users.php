<?php 

?>

<div class="container-fluid" style ="width: 95%;">

    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New
                user</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12" style ="width: 100%;">
                    <thead>
                        <colgroup>
                            <col width="4%">
                            <col width="32%">
                            <col width="32%">
                            <col width="32%">
                        </colgroup>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
                        <tr>
                            <td>
                                <?php echo $i++ ?>
                            </td>
                            <td>
                                <?php echo $row['name'] ?>
                            </td>
                            <td>
                                <?php echo $row['username'] ?>
                            </td>
                            <td>
                                <center>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button"
                                            class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit_user" href="javascript:void(0)"
                                                data-id='<?php echo $row['id'] ?>'>Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_user" href="javascript:void(0)"
                                                data-id='<?php echo $row['id'] ?>'>Delete</a>
                                        </div>
                                    </div>
                                </center>
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
    tr td {
        text-align: center;
    }
    @media only screen and (max-width: 1200px) {
        a.nav-item:after{
        background: none;
    }
    main#view-panel {
        width: 90%;
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
</style>
<script>
$('#new_user').click(function() {
    uni_modal('New User', 'manage_user.php')
})
$('.edit_user').click(function() {
    uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'))
})
$('.delete_user').click(function() {
    _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
})

function delete_user($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_user',
        method: 'POST',
        data: {
            id: $id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
}
</script>
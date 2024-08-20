<?php include 'db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM loan_list where id = ".$_GET['id']);
    foreach($qry->fetch_array() as $k => $v){
        $$k = $v;
    }
    }
?>
<form id="message-borrower">
    <div class="row form-group">
        <div class="col-md-6">
            <label>From</label>
            <input type="type" class="form-control" id="from_name" value= "Masaligan Microfinance Corp">
        </div>
        <div class="col-md-6">
            <label>To</label>
            <?php
				$borrower = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM borrowers order by concat(lastname,', ',firstname,' ',middlename) asc ");
				?>
				<select class="custom-select browser-default select2 invicible" id="to">
						<?php while($row = $borrower->fetch_assoc()): ?>
							<option value="<?php echo $row['email'] ?>" <?php echo isset($borrower_id) && $borrower_id == $row['id'] ? "selected" : '' ?>><?php echo $row['email']?></option>
						<?php endwhile; ?>
				</select>
        </div>
        <div class="col-md-6">
            <label for="">Message</label>
            <textarea name="message" id="message" cols="30" rows="2" class="form-control">Due date after 5 days</textarea>
        </div>

    </div>
</form>
<script>
$('#message-borrower').submit(function(e) {
    e.preventDefault()
    start_load()
    var params = {
        from_name: from_name.value,
        to: to.value,
        message: message.value,
    }
    emailjs.send("service_p0ol3qg", "template_odk8ogu", params).then(function(res) {
        alert_toast("Message Sent", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)
    })


})
</script>
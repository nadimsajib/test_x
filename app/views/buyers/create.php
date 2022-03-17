<div class="container">
	<div class="jumbotron">
		<form class="cmxform" id="commentForm" method="get" action="">
	
		  <div class="form-group" id="amount-group">
		    <label>Amount</label>
		    <input type="number" class="form-control" name="amount" placeholder="Amount">
		  </div>
		  <div class="form-group" id="buyer-group">
		    <label>Buyer name</label>
		    <input type="text" class="form-control" name="buyer" placeholder="Enter name">
		  </div>
		  <div class="form-group" id="receipt_id-group">
		    <label>receipt id</label>
		    <input type="text" class="form-control" name="receipt_id" placeholder="Enter receipt_id">
		  </div>
		  <div class="form-group" id="items-group">
		    <label>Items</label>
		    <input type="text" class="form-control" name="items[]" placeholder="Enter Items">
			<button id="addButton" class="form-control btn btn-primary btn-sm col-sm-1">add more</button>
			<div id="item_error_found" data-value="0"></div>
		  </div><br>
		  <div class="form-group" id="buyer_email-group">
		    <label>buyer email address</label>
		    <input type="text" class="form-control" name="buyer_email" placeholder="Enter email">
		  </div>
		  <div class="form-group" id="note-group">
		    <label>Note</label>
		    <input type="text" class="form-control" name="note" placeholder="Enter note">
		  </div>
		  <div class="form-group" id="city-group">
		    <label>City</label>
		    <input type="text" class="form-control" name="city" placeholder="Enter city">
		  </div>
		  <div class="form-group" id="phone-group">
		    <label>Phone</label>
		    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone">
		  </div>
		  <div class="form-group" id="entry_by-group">
		    <label>Entry by</label>
		    <input type="number" class="form-control" name="entry_by" placeholder="Enter Entry by">
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
<script>    
// JQuery Script to submit Form
/*$(document).ready(function () {
    $("#commentForm").validate({
        submitHandler : function () {
            // your function if, validate is success
            $.ajax({
                type : "POST",
                url : "<?= BASEURL ?>/buyer/store",
                data : $('#commentForm').serialize(),
                success : function (data) {
                    $('#message').html(data);
                }
            });
        }
    });
});*/
$(document).ready(function () {
	var wrapper = $("#items-group");
	$("#addButton").click(function(e){
		e.preventDefault();
		$(wrapper).append('<div><br><input type="text" class="form-control col-sm-8" name="items[]" placeholder="Enter Items"/><a href="#" class="remove_field form-control col-sm-2 btn btn-danger" >Remove</a></div>');
	})
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove();
    })
	$('#phone').change(function() {
        let total_length = this.value.length;
        
        if(total_length=='11'){
          $("#phone").val("88"+$("#phone").val());
        }
        else if(total_length=='10'){
          $("#phone").val("880"+$("#phone").val());
        }
        else{
           $("#phone").val();
        }
    });
	
	$('form').change(function() {
        var form_field = $('#commentForm').serializeArray();
		$(".form-group").removeClass("has-error");
	  	$(".help-block").remove();
		for (index in form_field) {
			console.log(form_field[index]);
			if(!!form_field[index].value){
				if(form_field[index].name == 'amount'){
					$("#"+form_field[index].name+"-group").removeClass("has-error");
	  				$("#"+form_field[index].name+"-group .help-block").remove();
					if(!/^[0-9]+$/.test(form_field[index].value)){
						$("#"+form_field[index].name+"-group").addClass("has-error");
						$("#"+form_field[index].name+"-group").append(
							'<div class="help-block">amount is only numbers.</div>'
						);
					}
				}
			
				if(form_field[index].name == 'buyer'){
					$("#"+form_field[index].name+"-group").removeClass("has-error");
	  				$("#"+form_field[index].name+"-group .help-block").remove();
					if(!/^[a-z0-9 ]+$/i.test(form_field[index].value)){
						$("#"+form_field[index].name+"-group").addClass("has-error");
						$("#"+form_field[index].name+"-group").append(
							'<div class="help-block">Buyer is only  text, spaces and numbers.</div>'
						);
					}
				}

				if(form_field[index].name == 'city'){
					$("#"+form_field[index].name+"-group").removeClass("has-error");
	  				$("#"+form_field[index].name+"-group .help-block").remove();
					if(!/^[a-z ]+$/i.test(form_field[index].value)){
						$("#"+form_field[index].name+"-group").addClass("has-error");
						$("#"+form_field[index].name+"-group").append(
							'<div class="help-block">City is only text and numbers.</div>'
						);
					}
				}

				if(form_field[index].name == 'phone'){
					$("#"+form_field[index].name+"-group").removeClass("has-error");
	  				$("#"+form_field[index].name+"-group .help-block").remove();
					if(!/^[0-9 ]+$/i.test(form_field[index].value)){
						$("#"+form_field[index].name+"-group").addClass("has-error");
						$("#"+form_field[index].name+"-group").append(
							'<div class="help-block">phone is only numbers.</div>'
						);
					}
				}

				if(form_field[index].name == 'entry_by'){
					$("#"+form_field[index].name+"-group").removeClass("has-error");
	  				$("#"+form_field[index].name+"-group .help-block").remove();
					if(!/^[0-9 ]+$/i.test(form_field[index].value)){
						$("#"+form_field[index].name+"-group").addClass("has-error");
						$("#"+form_field[index].name+"-group").append(
							'<div class="help-block">entry_by is only numbers.</div>'
						);
					}
				}
				
				if(form_field[index].name == 'receipt_id'){
					$("#"+form_field[index].name+"-group").removeClass("has-error");
	  				$("#"+form_field[index].name+"-group .help-block").remove();
					if(!/^[a-z]+$/i.test(form_field[index].value)){
						$("#"+form_field[index].name+"-group").addClass("has-error");
						$("#"+form_field[index].name+"-group").append(
							'<div class="help-block">receipt_id is only  text.</div>'
						);
					}
				}

				if(form_field[index].name == 'buyer_email'){
					$("#"+form_field[index].name+"-group").removeClass("has-error");
	  				$("#"+form_field[index].name+"-group .help-block").remove();
					if(!/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(form_field[index].value)){
						$("#"+form_field[index].name+"-group").addClass("has-error");
						$("#"+form_field[index].name+"-group").append(
							'<div class="help-block">Valid Email is required.</div>'
						);
					}
				}

				if(form_field[index].name.includes("item")){
					$("#item-group").removeClass("has-error");
	  				$("#item-group .help-block").remove();
					if(!/^[a-z]+$/i.test(form_field[index].value)){
						$("#item-group").addClass("has-error");
						$("#item-group").append(
							'<div class="help-block">items is only  text.</div>'
						);
					}
				}
				
			}
			
		}
    });
  $("form").submit(function (event) {
	event.preventDefault();
    $.ajax({
      type: "POST",
      url : "<?= BASEURL ?>/buyer/store",
      data : $('#commentForm').serialize(),
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log(data);
	  $(".form-group").removeClass("has-error");
	  $(".help-block").remove();
	  if (!data.success) {
		for (index in data.errors) {
        	$("#"+index+"-group").addClass("has-error");
			$("#"+index+"-group").append(
				'<div class="help-block">' + data.errors[index] + "</div>"
			);
    	}
      }else if(data.success){
		alert("You will now be redirected.");
        window.location = "<?= BASEURL ?>/buyer";
	  }
    });
  });
});
</script>
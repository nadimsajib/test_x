<div class="container">
	<div class="jumbotron mt-4">
		<h1 class="display-4"><?= $data['text']; ?></h1>

		<a href="<?= BASEURL ?>/buyer/create" class="btn btn-sm btn-primary">
			Add buyer
		</a>
		<form action="<?= BASEURL ?>/buyer" method="POST"> 
			<div class="form-row align-items-center">
				<div class="col-auto">
				<label class="sr-only" for="inlineFormInput">Name</label>
				<input type="date" class="form-control mb-2" name="from_date" placeholder="From date">
				</div>
				<div class="col-auto">
				<label class="sr-only" for="inlineFormInput">Name</label>
				<input type="date" class="form-control mb-2" id="datepicker" name="to_date" placeholder="To date">
				</div>
				<div class="col-auto">
				<button type="submit" class="btn btn-primary mb-2">Search</button>
				</div>
			</div>
		</form>

		<div class="table-responsive mt-5">
			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Amount</th>
			      <th scope="col">buyer</th>
				  <th scope="col">receipt_id</th>
				  <th scope="col">buyer_email</th>
				  <th scope="col">note</th>
				  <th scope="col">phone</th>
				  <th scope="col">city</th>
				  <th scope="col">buyer_ip</th>
				  <th scope="col">hash_key</th>
				  <th scope="col">entry_at</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($data['buyers'] as $key => $value): ?>
				    <tr>
				      <th scope="row"><?= ++$key; ?></th>
				      <td><?= $value['amount']; ?></td>
					  <td><?= $value['buyer']; ?></td>
					  <td><?= $value['receipt_id']; ?></td>
					  <td><?= $value['buyer_email']; ?></td>
					  <td><?= $value['note']; ?></td>
					  <td><?= $value['phone']; ?></td>
					  <td><?= $value['city']; ?></td>
					  <td><?= $value['buyer_ip']; ?></td>
					  <td title="<?php echo $value['hash_key']; ?>">
					  <?php 
					 if (strlen($value['hash_key']) >= 20) {
						echo substr($value['hash_key'], 0, 5). " ... " . substr($value['hash_key'], -5);
					}
					else {
						echo $value['hash_key'];
					} 
					  ?>
					</td>
					  <td><?= $value['entry_at']; ?></td>
				    </tr>
			  	<?php endforeach; ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>
<div class="min-vh-100">
	<nav class="navbar bg-body-tertiary mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo url("/products/add") ?>">Add product</a>
			<div class="d-flex">
				<button id="product-form-submit" class="btn btn-success">Save</button>
				<a class="btn btn-danger ms-2" href="<?php echo url("/products") ?>">Cancel</a>
			</div>
		</div>
	</nav>
	<form id="product-form" class="container col" action="<?php echo url("/products/add/submit") ?>" method="POST">
		<div id="js-response-message-container" class="alert alert-danger d-none" role="alert">
			A simple danger alert—check it out!
		</div>
		<div class="col-md-6 mb-2">
			<label for="sku" class="col-form-label">SKU</label>
			<input type="text" class="form-control" id="sku" name="sku" required>
		</div>
		<div class="col-md-6 mb-2">
			<label for="name" class="col-form-label">Name</label>
			<input type="text" class="form-control" id="name" name="name" required>
		</div>
		<div class="col-md-6 mb-2">
			<label for="price" class="col-form-label">Price($)</label>
			<input type="number" class="form-control" id="price" name="price" step="0.01" required>
		</div>
		<div class="col-md-6 mb-2">
			<label for="type" class="col-form-label">Type</label>
			<select class="form-select" id="product-type" name="product-type" required>
				<option id="dvd" selected value="dvd">DVD</option>
				<option id="book" value="book">Book</option>
				<option id="furniture" value="furniture">Furniture</option>
			</select>
		</div>
		<div id="product-attr-parent">
			<div class="d-none" id="dvd-attr">
				<div class="col-md-6 mb-2">
					<label for="size" class="col-form-label">Size(MB)</label>
					<input type="number" class="form-control" id="size" name="size" required>
				</div>
			</div>
			<div class="d-none" id="book-attr">
				<div class="col-md-6 mb-2">
					<label for="weight" class="col-form-label">Weight(KG)</label>
					<input type="number" class="form-control" id="weight" name="weight" step="0.1" required>
				</div>
			</div>
			<div class="d-none" id="furniture-attr">
				<div class="col-md-6 mb-2">
					<label for="height" class="col-form-label">Height(CM)</label>
					<input type="number" class="form-control" id="height" name="height" step="0.01" required>
				</div>
				<div class="col-md-6 mb-2">
					<label for="width" class="col-form-label">Width(CM)</label>
					<input type="number" class="form-control" id="width" name="width" step="0.01" required>
				</div>
				<div class="col-md-6 mb-2">
					<label for="length" class="col-form-label">Length(CM)</label>
					<input type="number" class="form-control" id="length" name="length" step="0.01" required>
				</div>
			</div>
		</div>
	</form>
</div>
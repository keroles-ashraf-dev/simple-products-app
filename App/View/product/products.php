<div class="min-vh-100">
	<nav class="navbar bg-body-tertiary mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo url("/products") ?>">Product List</a>
			<div class="d-flex">
				<a id="product-form-submit" class="btn btn-primary" href="<?php echo url("/products/add") ?>">Add</a>
				<button id="products-mass-delete" class="btn btn-danger ms-2" data-target="<?php echo url("/products/delete") ?>">Mass delete</button>
			</div>
		</div>
	</nav>
	<div class="products-container container">
		<div id="js-response-message-container" class="alert alert-danger d-none" role="alert"></div>
		<div class="row">
			<?php
			foreach ($products as $p) {
				$html = '
				<div class="col-md-4 mb-3">
					<div class="card">
						<div class="form-check m-2">
							<input class="form-check-input delete-checkbox" type="checkbox" data-id="?id">
						</div>
						<div class="card-body text-center">
							<span class="card-text d-block">?sku</span>
							<span class="card-text d-block">?name</span>
							<span class="card-text d-block">?price $</span>
							<span class="card-text d-block">?attr</span>
						</div>
					</div>
				</div>
				';

				$values = [
					'id' => $p->id(),
					'sku' => $p->sku(),
					'name' => $p->name(),
					'price' => $p->price(),
					'attr' => $p->displayedAttr(),
				];
				echo inject_html($html, $values);
			}
			?>
		</div>
	</div>
</div>
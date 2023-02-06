<div class="min-vh-100">
	<nav class="navbar bg-body-tertiary mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo url("/products") ?>">Product List</a>
			<div class="d-flex">
				<a id="product-form-submit" class="btn btn-primary" href="<?php echo url("/products/add") ?>">Add</a>
				<a class="btn btn-danger ms-2" href="<?php echo url("/products/delete") ?>">Mass delete</a>
			</div>
		</div>
	</nav>
	<div class="products-container container">
		<div class="row">
			<?php
			$html = '
			<div class="col-md-4 mb-3">
				<div class="card">
					<div class="form-check m-2">
						<input class="form-check-input delete-checkbox" type="checkbox">
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
			foreach ($products as $p) {
				$values = [
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
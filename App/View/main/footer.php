<footer class="mt-5 text-center bg-dark text-white">
	<div class="p-3">
		<span>Scandiweb Test Assignment</span>
	</div>
</footer>
<?php
// just import current page js file only
$html = '<script type="module" src="?path"></script>';

if (str_starts_with($path, '/products/add')) {
	echo inject_html($html, ['path' => assets('js/add-product.js')]);
} else if ($path === '/' || str_starts_with($path, '/products')) {
	echo inject_html($html, ['path' => assets('js/products.js')]);
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
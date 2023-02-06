import { log, redirectTo, toggleResponseMessageShowing } from "../js/helpers.js"

// ************************** global vars *************************************//

const responseMessageContainer = document.getElementById('js-response-message-container');

// ************************** functions call *************************************//

handleProductTypeSelectChange();  // handle product type select change to display right attributes

handleProductFormSubmit();  // handle product form submit

// ************************** functions deceleration *************************************//

function handleProductTypeSelectChange() {

	const typeSelect = document.getElementById("product-type");
	const typeAttrParent = document.getElementById("product-attr-parent");

	const typeAttrChildren = Array.from(typeAttrParent?.children);

	handleProductTypeShowing(typeSelect, typeAttrChildren);

	typeSelect?.addEventListener("change", () => {

		handleProductTypeShowing(typeSelect, typeAttrChildren);

	});
}

function handleProductTypeShowing(typeSelect, children) {

	const selectedOption = typeSelect?.options[typeSelect.selectedIndex];
	const selectedType = selectedOption?.id + "-attr";

	children?.forEach(e => {

		if (e.id == selectedType) {
			e.classList.add("d-block");
			e.classList.remove("d-none");
		} else {
			e.classList.add("d-none");
			e.classList.remove("d-block");
		}
	});
}

function handleProductFormSubmit() {

	const productFormSubmit = document.getElementById('product-form-submit');
	const productForm = document.getElementById('product-form');

	productFormSubmit?.addEventListener('click', _ => {

		toggleResponseMessageShowing(responseMessageContainer);

		const data = new FormData(productForm);
		const requestUrl = productForm.attributes['action']['value'];

		createPostRequest(data, requestUrl);
	});
}

function createPostRequest(data, requestUrl) {
	const request = new Request(
		requestUrl,
		{
			method: 'POST',
			body: data,
		});

	fetch(request)
		.then(res =>
			res.json()
		).then(resData => {
			handleApiResponse(resData);
		})
		.catch(e => {
			log(e);
		});
}

function handleApiResponse(resData) {

	if (resData['redirect_to']) {

		return redirectTo(resData['redirect_to']);
	}

	if (resData['message']) {
		toggleResponseMessageShowing(responseMessageContainer, resData['message'], resData['success'], true);
	}
}

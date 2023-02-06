import { log, redirectTo, toggleResponseMessageShowing } from "../js/helpers.js"

// ************************** global vars *************************************//

const responseMessageContainer = document.getElementById('js-response-message-container');

// ************************** functions call *************************************//

handleProductsDelete();  // handle products mass delete 

// ************************** functions deceleration *************************************//

function handleProductsDelete() {

	const productsDeleteBtn = document.getElementById('products-mass-delete');
	const productsDeleteCheckbox = Array.from(document.getElementsByClassName('delete-checkbox'));

	productsDeleteBtn?.addEventListener('click', _ => {

		toggleResponseMessageShowing(responseMessageContainer);

		const data = JSON.stringify({
			'deleted-ids': getDeletedProductsIds(productsDeleteCheckbox)
		});
		const requestUrl = productsDeleteBtn?.dataset.target;

		createPostRequest(data, requestUrl);
	});
}

function getDeletedProductsIds(elements) {

	const ids = [];

	elements?.forEach(e => {

		if (e.checked) ids.push(e.dataset.id);
	});

	return ids;
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

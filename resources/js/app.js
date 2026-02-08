import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
	const toggles = document.querySelectorAll('[data-password-toggle]');

	toggles.forEach((toggle) => {
		toggle.addEventListener('click', () => {
			const field = toggle.closest('.password-field');
			const input = field ? field.querySelector('input') : null;
			if (!input) {
				return;
			}

			const isHidden = input.type === 'password';
			input.type = isHidden ? 'text' : 'password';
			toggle.setAttribute('aria-pressed', String(isHidden));
			toggle.classList.toggle('is-visible', isHidden);
		});
	});
});

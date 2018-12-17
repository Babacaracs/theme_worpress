/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens 
 */
'use strict';
document.addEventListener( 'DOMContentLoaded', () => {
	
	const container = document.querySelector( '.navbar' );
	const button      = container.getElementsByTagName( 'button' )[0];
	const closeButton = container.getElementsByTagName( 'button' )[1]; 
	const menu = container.querySelector( '.menu-wrapper' );

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	// Set event listeners.
	button.onclick      = toggleMenu;
	closeButton.onclick = toggleMenu;
	window.onclick      = closeMenu;
	document.onkeyup    = closeMenuOnEsc;

	// Close the menu when the last focusable element is blurred
	const focusables = menu.querySelectorAll( 'a', 'select', 'input', 'button', 'textarea');
	const lastFocusable = focusables[focusables.length - 1];
	lastFocusable.onblur = toggleMenu;
	
	function toggleMenu() {
		if ( -1 !== menu.className.indexOf( 'open' ) ) {
			menu.className = menu.className.replace( ' open', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			menu.className += ' open';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	function closeMenu(e){
		var menuOpen      = -1 !== menu.className.indexOf( 'open' ),
			buttonClicked = e.target == button || e.target.parentElement == button,
			wrapperWidth  = menu.offsetWidth;

		if ( ! menuOpen ){
			return;
		}
		
		if ( buttonClicked ){
			return;
		}

		if ( e.clientX < ( window.innerWidth - wrapperWidth ) ){
			toggleMenu();
		}
	};

	function closeMenuOnEsc(e){
		var menuOpen      = -1 !== menu.className.indexOf( 'open' );
		
		if ( ! menuOpen ){
			return;
		}
		
		if (e.key == "Esc" || e.keyCode == 27){
			toggleMenu();
		}
	}

	// Get all the link elements within the menu.
	const links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( var i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus(e) {
		let element = e.target;
		const parentLi = element.parentElement;
		parentLi.classList.toggle( 'focus' ); // Focus class on li

		if ( parentLi.classList.contains( 'menu-item-has-children' ) ){
			const subMenu = parentLi.querySelector('.sub-menu');
			subMenu.classList.toggle('open');
		}
		
		while ( ! element.classList.contains( 'menu' ) ) {
			if ( element.classList.contains( 'sub-menu' ) ) {
				element.classList.toggle( 'open' );
			}
			element = element.parentElement;
		}
	}


});
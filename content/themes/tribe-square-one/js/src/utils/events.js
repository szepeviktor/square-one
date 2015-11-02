/**
 * @module
 * @description Some event functions for use in other modules
 */

'use strict';

let on = ( el, name, handler ) => {
	if ( el.addEventListener ) {
		el.addEventListener( name, handler );
	}
	else {
		el.attachEvent( 'on' + name, function() {
			handler.call( el );
		} );
	}
};

let ready = ( fn ) => {
	if ( document.readyState !== 'loading' ) {
		fn();
	}
	else if ( document.addEventListener ) {
		document.addEventListener( 'DOMContentLoaded', fn );
	}
	else {
		document.attachEvent( 'onreadystatechange', function() {
			if ( document.readyState !== 'loading' ) {
				fn();
			}
		} );
	}
};

let trigger = ( opts ) => {

	let event,
		options = _.assign( {
			data  : {},
			el    : document,
			event : '',
			native: true
		}, opts );

	if ( options.native ) {
		event = document.createEvent( 'HTMLEvents' );
		event.initEvent( options.event, true, false );
	}
	else {
		if ( window.CustomEvent ) {
			event = new CustomEvent( options.event, {detail: options.data} );
		}
		else {
			event = document.createEvent( 'CustomEvent' );
			event.initCustomEvent( options.event, true, true, options.data );
		}
	}

	options.el.dispatchEvent( event );

};

export { on, ready, trigger }
 class Notification {
 	success() {
	 	new Noty({
	    type: 'success',
	    layout: 'topRight',
	    text: 'success',
	    timeout: 1000
	}).show();
} 	

	alert() {
		 	new Noty({
		    type: 'alert',
		    layout: 'topRight',
		    text: 'Are you sure?',
		    timeout: 1000
		}).show();
	}	

	error() {
		 	new Noty({
		    type: 'error',
		    layout: 'topRight',
		    text: 'Something went wrong?',
		    timeout: 1000
		}).show();
	}	

	warning() {
		 	new Noty({
		    type: 'warning',
		    layout: 'topRight',
		    text: 'warning',
		    timeout: 1000
		}).show();
	}

	image_validation() {
		 	new Noty({
		    type: 'error',
		    layout: 'topRight',
		    text: 'image must be less than 1mb',
		    timeout: 1000
		}).show();
	}
}

export default Notification = new Notification();
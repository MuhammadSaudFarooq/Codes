jQuery('.msf_user_detail input[name="msf_user_password"]').keyup(function(e) {

	let password = jQuery(this).val();

	let strength = 0;
	let message = '';

	const characters = /^[a-zA-Z0-9+!@#$%^&*()]{0,8}$/; // 1
	const capital = /[A-Z]/; // 1
	const small = /[a-z]/; // 1
	const digit = /[0-9]/; // 1
	const special = /[+!@#$%^&*()]/; // 1

	if(password.length >= 8) strength++;
	if(capital.test(password)) strength++;
	if(small.test(password)) strength++;
	if(digit.test(password)) strength++;
	if(special.test(password)) strength++;

	if(strength <= 0 || strength === 1 || strength === 2){
		message = 'Very Weak';
	}
	if(strength === 3){
		message = 'Weak';
	}
	if(strength === 4){
		message = 'Medium';
	}
	if(strength === 5){
		message = 'Strong';
	}
	if(jQuery(this).val() == ''){
    	message = '';
	}

	console.log(strength);
	console.log(message);

});
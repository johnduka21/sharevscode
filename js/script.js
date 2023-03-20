		//JavaScript for Animated sidebar.
		function openMenu() {
		  document.getElementById("sideNav").style.left = "0";
		  //document.getElementById("sideNav").style.width = "100%";
		}

		function closeMenu() {
		  document.getElementById("sideNav").style.left = "-500px";
		}
		//Fish Submenu
		function openFishMenu() {
		  document.getElementById("mainMenu").style.display = "none";
		  document.getElementById("fishMenu").style.display = "block";
		  document.getElementById("mainCloseButton").style.display = "none";
		  document.getElementById("fishCloseButton").style.display = "block";
		}

		function closeFishMenu() {
		  document.getElementById("mainMenu").style.display = "block";
		  document.getElementById("fishMenu").style.display = "none";
		  document.getElementById("mainCloseButton").style.display = "block";
		  document.getElementById("fishCloseButton").style.display = "none";
		}
		//Aquarium Submenu
		function openAquaMenu() {
		  document.getElementById("mainMenu").style.display = "none";
		  document.getElementById("aquaMenu").style.display = "block";
		  document.getElementById("mainCloseButton").style.display = "none";
		  document.getElementById("aquaCloseButton").style.display = "block";
		}
		function closeAquaMenu() {
		  document.getElementById("mainMenu").style.display = "block";
		  document.getElementById("aquaMenu").style.display = "none";
		  document.getElementById("mainCloseButton").style.display = "block";
		  document.getElementById("aquaCloseButton").style.display = "none";
		}
		//Accessories Submenu
		function openequpMenu() {
		  document.getElementById("mainMenu").style.display = "none";
		  document.getElementById("equpMenu").style.display = "block";
		  document.getElementById("mainCloseButton").style.display = "none";
		  document.getElementById("equpCloseButton").style.display = "block";
		}
		function closeequpMenu() {
		  document.getElementById("mainMenu").style.display = "block";
		  document.getElementById("equpMenu").style.display = "none";
		  document.getElementById("mainCloseButton").style.display = "block";
		  document.getElementById("equpCloseButton").style.display = "none";
		}
		const togglePassword = document.querySelector('#togglePassword');
		const password = document.querySelector('#userPassword');

		if (togglePassword == null || password == null) {
		}
		else {
			togglePassword.addEventListener('click', function (e) {
				// toggle the type attribute
				const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
				password.setAttribute('type', type);
				// toggle the eye slash icon
				this.classList.toggle('fa-eye-slash');
			});
		}
	   

	  const togglePassword2 = document.querySelector('#togglePassword2');
	  const password2 = document.querySelector('#userPassword2');
	 
	  if (togglePassword2 == null || togglePassword2 == null) {
	}
	else {
	  togglePassword2.addEventListener('click', function (e) {
		// toggle the type attribute
		const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
		password2.setAttribute('type', type);
		// toggle the eye slash icon
		this.classList.toggle('fa-eye-slash');
	});
}
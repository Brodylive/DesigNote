window.addEventListener('load', function() {
    FastClick.attach(document.body);
}, false);

(function(){

	//le body
	var body = document.body;

	//reveal menu						
	var reveal = document.getElementsByClassName("reveal");
	Array.prototype.forEach.call(reveal, function(el, i){

		el.onclick = function() { 
				body.classList.toggle("menu-is-revealed");
		};

	});	

	//function to remove active class on section
	function removeActive(e){
		var section = document.getElementsByClassName("page");
		Array.prototype.forEach.call(section, function(el, i){

				el.classList.remove("active");			

		});				

	}

	//page active	
	var menuLink = document.getElementsByClassName('menu-reveal-link');
	Array.prototype.forEach.call(menuLink, function(el, i){

		el.onclick = function() { 
				removeActive();
				var content = this.innerHTML;
				var active = document.getElementsByClassName(content);
				active[0].classList.add("active");
				body.classList.remove("menu-is-revealed");
		};

	});


	var start = {};
	var end = {};
	var tracking = false;
	var thresholdTime = 500;
	var thresholdDistance = 100;
	var swipeElement = document.getElementsByTagName('body')[0];

	gestureStart = function(e) {
		if (e.touches.length>1) {
			tracking = false;
			return;
		} else {
			tracking = true;
			/* Hack - would normally use e.timeStamp but it's whack in Fx/Android */
			start.t = new Date().getTime();
			start.x = e.targetTouches[0].clientX;
			start.y = e.targetTouches[0].clientY;
		}
		console.dir(start);
	};

	gestureMove = function(e) {
		if (tracking) {
			e.preventDefault();
			end.x = e.targetTouches[0].clientX;
			end.y = e.targetTouches[0].clientY;
		}
	}

	gestureEnd = function(e) {
		tracking = false;
		var now = new Date().getTime();
		var deltaTime = now - start.t;
		var deltaX = end.x - start.x;
		var deltaY = end.y - start.y;
		/* work out what the movement was */
		if (deltaTime > thresholdTime) {
			/* gesture too slow */
			return;
		} else {
			if ((deltaX > thresholdDistance)&&(Math.abs(deltaY) < thresholdDistance)) {
				//swipe right
				body.classList.add("menu-is-revealed");
			} else if ((-deltaX > thresholdDistance)&&(Math.abs(deltaY) < thresholdDistance)) {
				//swipe left
				body.classList.remove("menu-is-revealed");
			}
		}
	}

	swipeElement.addEventListener('touchstart', gestureStart, false);
	swipeElement.addEventListener('touchmove', gestureMove, false);
	swipeElement.addEventListener('touchend', gestureEnd, false);







})();
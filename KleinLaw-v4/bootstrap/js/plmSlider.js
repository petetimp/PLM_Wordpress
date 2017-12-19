var plmSlideInterval;

var plmSlider = {
	
	/**
	 * Number of slides in DOM
	 * @return - number of slides
   	 **/
	numSlides : 
		function(){
				return $( "#plm-slider .wow").length;
		},
						
	runSlides: 8000,
						
	forwardAnimation: "fadeInLeft",
						
	backwardAnimation: "fadeInRight", 

	edgeSlide: false,

	sliderAnimate : 
		function(){
			plmSlideInterval = setInterval(this.startSlider,this.runSlides);
		},
	
	/**
	 * Inital function that fires as soon as document is ready. Sets required properties from config object, events, and makes call to start slide
   	 **/	
	init:
		function(config){
			for (prop in config){
				if (config.hasOwnProperty(prop)) {
					this[prop] = config[prop];
				}
			}

			this.setEvents();
			this.sliderAnimate();	
		},

	/**
	 * Sets up required event handlers for plmSlider components
	 **/	
	setEvents:
		function(){
			//Pressed the left arrow
			$(".arrow-left").click(
				function(){
					clearInterval(plmSlideInterval);
					var id = "#" + $('.currSlide').attr("id");

					if(id.indexOf('1') > -1){
						plmSlider.edgeSlide = true;
						$("#slide-" + plmSlider.numSlides()).css("animation-name", plmSlider.backwardAnimation);
					}else{
						plmSlider.edgeSlide = false;
						$(".currSlide").prev().css("animation-name", plmSlider.backwardAnimation);
					}

						plmSlider.switchSlide(id, "prev", plmSlider.edgeSlide);
					}
				);
			//Pressed the right arrow
			$(".arrow-right").click(
				function(){
					clearInterval(plmSlideInterval);
					var id = "#" + $('.currSlide').attr("id");

					if(id.indexOf(plmSlider.numSlides()) > -1){
						plmSlider.edgeSlide = true;
						$("#slide-1").css("animation-name", plmSlider.forwardAnimation);
					}else{
						plmSlider.edgeSlide = false;
						$(".currSlide").next().css("animation-name", plmSlider.forwardAnimation);
					}

					plmSlider.switchSlide(id, "next", plmSlider.edgeSlide);
				}
			);
			//Stops slider on mouseenter. Starts slider on mouseleave.
			$("#plm-slider").hover(
				function(){
					clearInterval(plmSlideInterval);
				},
				function(){
					plmSlideInterval = setInterval(plmSlider.startSlider, plmSlider.runSlides);
				}
			);
		},
						
	/**
	 * Determins if current slide is an edge slide and sets up foward animations when pressing next arrow. Also fires when slider is first initialized.
	 **/	
	startSlider:
		function(){
			var id = "#" + $('.currSlide').attr("id");

			if(id.indexOf(plmSlider.numSlides()) > -1){
				plmSlider.edgeSlide = true;
				$("#slide-1").css("animation-name", this.forwardAnimation);
			}else{
				plmSlider.edgeSlide = false;
				$(".currSlide").next().css("animation-name", this.forwardAnimation);
			}

			plmSlider.switchSlide(id, "next", plmSlider.edgeSlide);	
		},
						
	/**
	 * Determines direction of slide, if we are on a edgeSlide or other slide and fires slide animation
	 * @param id - {{string}} id selector of current slide
	 * @param direction - {{string}} direction slide is going. will be 'prev' or 'next'
	 * @param edgeSlide - {{boolean}} whether we are on the first or last slide or not 
	 **/	
	switchSlide:
		function(id, direction, edgeSlide){
			$(id).hide().removeClass("currSlide");

			if(direction == "next"){
				if(edgeSlide){
					$("#slide-1").show().addClass("currSlide");	
				}else{
					$(id).next().show().addClass("currSlide");
									}	
			}else{
				if(edgeSlide){
					$("#slide-" + this.numSlides()).show().addClass("currSlide");	
				}else{
					$(id).prev().show().addClass("currSlide");
				}
			}

			this.triggerWow();
		},
						
	/**
	 * Triggers WOW required for animation
	 **/	 
	triggerWow:
		function(){
			new WOW().init();
		},

};
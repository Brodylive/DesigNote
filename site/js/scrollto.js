var scrolling = function(){
	var speed     = 500;
	jQuery('a[href^="#"]').bind('click',function(){
		var id = jQuery(this).attr('href');
			        if(id == '#')
			            goTo('body');
			        else
			            goTo(id);
			        return(false);
                 void(0);
			    });
			    function goTo(ancre){
			    	jQuery('html,body').animate({scrollTop:jQuery(ancre).offset().top
			    	},
			    	speed,'swing',function(){
			          if(ancre != 'body')
			                window.location.hash = ancre;
			          else
			              window.location.hash = '#';
			          jQuery(ancre).attr('tabindex','-1');
			          jQuery(ancre).focus();
			          jQuery(ancre).removeAttr('tabindex');
			      });
			    }
			};
			jQuery(function(){
				scrolling();
			});
			
			
			
			
			
			
/* Rien à voir avec le scroll to, c'est pour faire apparaitre et disparaitre la div credit */
			
$(document).ready(function(){
	$("#bouton-credit").click(function(){
		$("#credit").fadeToggle();
	});
});




/* Agrandir une image */

	/*var width = portfolio.find('bloc:first').width();
	var height = portfolio.find('bloc:first').height();
	var cssi = {width:width,height:height};*/

	portfolio.find('a.thumb').click(function(e){
		var elem = $(this);
		var cls = elem.attr('href').replace('#','');
		var fold = portfolio.find('.unfold').removeClass('unfold')/*.css(cssi)*/;
		var unfold = elem.parent().addClass('unfold');
		portfolio.masonry('reload');

		/*var widthf = unfold.width();
		var heightf = unfold.height();*/

		/*unfold.css(cssi).animate({
			width:widthf,
			height:heightf
		})*/
		location.hash = cls;
		e.preventDefault();
	})



/* Pour avoir la catégorie sélectionner grâce à l'url */
	
	if(location.hash != ''){
		$('a[href="'+location.hash+'"]').trigger('click');
	}
})
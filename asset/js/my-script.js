$(function(){
	
	//alert('Jquery ok !');
		
	//activation tooltip bootstrap
	$('[data-toggle="tooltip"]').tooltip();

	//autocompletion recherche metiers/secteurs
	$('#rome').autocomplete({
        source : "./controller/search.php",
				minLength: 3
	});
	//autocompletion recherche metiers/secteurs
	$('#rome_admin').autocomplete({
        source : "../controller/search.php",
				minLength: 3
	});

	//Scroll automatique quand on affiche la liste des opportunités par pays (espace admin)
	//-- detecter param $_get
	function getUrlParam(param) {
		var vars = {};
		window.location.href.replace( location.hash, '' ).replace( 
			/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
			function( m, key, value ) { // callback
				vars[key] = value !== undefined ? value : '';
			}
		);

		if ( param ) {
			return vars[param] ? vars[param] : null;	
		}
		return vars;
	}
	
	var country = getUrlParam('country');

	//-- scroll
	if (country.length) {
		$(window).scrollTop(400);
		}

});
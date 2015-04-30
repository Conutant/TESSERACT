(function($) {

	function beaverVidbg() {

		$('.fl-bg-video > video').each(function() {
			
			var vow = $(this).attr('data-width'),
			voh = $(this).attr('data-height'),
			vratio = parseInt( vow ) / parseInt( voh ), //.5625
			pratio = parseInt( $(this).parent().width() )/ parseInt( $(this).parent().height() ); //.3248
			
			var tc = $(this).closest('.fl-row-content-wrap'),
			pc = $(this).parent();							
				
			$( this ).removeAttr('style');				
				
			var tcw = $(tc).width(),
			tch = $(tc).height(),
			pcw = $(pc).width(),
			pch = $(pc).height();
			
			//If top parent is narrower than the original video width
			if( tcw < vow ) {
				
				var nh = tch,
				nw = nh * vratio;
				
				//Special case: if the new video is narrower than the screen width!!!
				if ( nw < $(window).width() ) {
					var nh = tch * vratio,
					nw = nh * vratio;						
				}
				
			//If top parent is wider or equal to the original video width	
			} else {
				var nh = tcw/vratio,
				nw = $(window).width();				
			}
			
			$(tc).css({overflow: 'hidden', position: 'relative'});
			$(pc).attr('style', 'height: ' + nh + 'px; left: 50%!important; width: ' + nw + 'px!important; margin-left: -' + nw/2 + 'px;');
			$(this).attr('style', 'height: ' + nh + 'px!important;');				

		})
		
	}
			
	$(window).load(function() {								
		
		beaverVidbg();
		
	});
			
	$(window).resize(function(){
		
		beaverVidbg();
		
	});	

})(jQuery);

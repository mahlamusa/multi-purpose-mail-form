(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-specific JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */
	$(function(){
		 /*$('#addoption').click(function(){
			addoptionrow();
			console.log("Adding Row");
		 });*/
		 		 		 
		 $('body').delegate('.removeoption', 'click', function(){
			$(this).parent().parent().remove();
		 });
		 
		 $('body').delegate('.addoption', 'click', function(){
			var id = $(this).data('id');			
			addoptionrow(id);
		 });
	 });
	 
	 function addoptionrow(id){
		var tr = '<tr class="optionsgrp">' +
                	'<td><input name="label[]" placeholder="Option Label" class="form-control input" /></td>' +
                    '<td><input name="value[]" placeholder="Option Value" class="form-control input" /></td>' +
                    '<td><input name="order[]" placeholder="Sort Order" class="form-control input" type="number" /></td>' +
                   '<td><a href="#" class="removeoption btn btn-danger"><i class="glyphicon glyphicon-minus"></i></a></td>' +
                '</tr>';
		$('.fieldoptions'+id).append(tr);
		console.log("Class : fieldoptions"+id);
		console.log("TR : "+tr);
	 }
})( jQuery );
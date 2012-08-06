// jQuery File Tree Plugin
//

if (jQuery) (function($){
	
	$.extend($.fn, {
		fileTree: function(options, callback) {
			// Defaults
      var defaults = {
        script: 'jqueryFileTree.php',
        root: '/',
        loadingMessage: 'Loading...'
      };
      // Expand the defaults with the supplied options
      options = $.extend(defaults, options);
			
			$(this).each(function() {
        var $this = $(this);

        $this.html('<ul class="jqueryFileTree start"><li class="wait">' + options.loadingMessage + '<li></ul>');
				
        $.get(options.script, {dir: 'nothingyet'}, function (data) {
          var listHtml = '';
          for (var i in data) {
            if (data.hasOwnProperty(i)) {
              var item = data[i],
                classHtml = (item.dir?' class="dir"':'');
              console.log(item);
              listHtml += '<li' + classHtml + '>' + item.name + '</li>';
              console.log(listHtml);
            }
          };
          $this.find('.start').html(listHtml);
        }, 'json');
			});
		}
	});
	
})(jQuery);
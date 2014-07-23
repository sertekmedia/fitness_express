(function() {
	tinymce.create('tinymce.plugins.mfnsc', {
		
		init : function(ed, url) {
			
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('mceMfn', function() {
				ed.windowManager.open({
					file : url + '/popup.php',
					width : 450 + ed.getLang('mfnsc.delta_width', 0),
					height : 145 + ed.getLang('mfnsc.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url, // Plugin absolute URL
					some_custom_arg : 'custom arg' // Custom argument
				});
			});

			// Register example button
			ed.addButton('mfnsc', {
				title : 'Insert shortcode',
				cmd : 'mceMfn',
				image : url + '/shortcode.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('mfnsc', n.nodeName == 'IMG');
			});
		},

		createControl : function(n, cm) {
			return null;
		},

		getInfo : function() {
			return {
				longname 	: 'Mfn mce',
				author 		: 'Muffin Group',
				authorurl 	: 'http://muffingroup.com',
				infourl 	: 'http://tinymce.moxiecode.com',
				version 	: "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('mfnsc', tinymce.plugins.mfnsc);
})();
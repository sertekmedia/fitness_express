(function() {
	
	tinymce.PluginManager.add('mfnsc', function(editor, url) {
		editor.addButton('mfnsc', {
			text : false,
			type : 'menubutton',
			icon : 'mfn-sc',
			classes: 'widget btn mfnsc',
			menu : [ {
				text : 'Column',
				menu : [ {
					text : '1/1',
					onclick : function() {
						editor.insertContent('[one]Insert your content here[/one]');
					}
				}, {
					text : '1/2',
					onclick : function() {
						editor.insertContent('[one_second]Insert your content here[/one_second]');
					}
				}, {
					text : '1/3',
					onclick : function() {
						editor.insertContent('[one_third]Insert your content here[/one_third]');
					}
				}, {
					text : '2/3',
					onclick : function() {
						editor.insertContent('[two_third]Insert your content here[/two_third]');
					}
				}, {
					text : '1/4',
					onclick : function() {
						editor.insertContent('[one_fourth]Insert your content here[/one_fourth]');
					}
				}, {
					text : '2/4',
					onclick : function() {
						editor.insertContent('[two_fourth]Insert your content here[/two_fourth]');
					}
				}, {
					text : '3/4',
					onclick : function() {
						editor.insertContent('[three_fourth]Insert your content here[/three_fourth]');
					}
				}, ]
			}, {
				text : 'Content',
				menu : [ {
					text : 'Blockquote',
					onclick : function() {
						editor.insertContent('[blockquote photo="" author="" company="" link="" target="_blank"]Insert your content here[/blockquote]');
					}
				}, {
					text : 'Button',
					onclick : function() {
						editor.insertContent('[button title="" link="" target="_blank" size="" color="" class=""]');
					}
				}, {
					text : 'Code',
					onclick : function() {
						editor.insertContent('[code]Insert your content here[/code]');
					}
				}, {
					text : 'Divider',
					onclick : function() {
						editor.insertContent('[divider height="30" line="1"]');
					}
				}, {
					text : 'Highlight',
					onclick : function() {
						editor.insertContent('[highlight background="" color=""]Insert your content here[/highlight]');
					}
				}, {
					text : 'Ico',
					onclick : function() {
						editor.insertContent('[ico type=""]');
					}
				}, {
					text : 'Icon List',
					onclick : function() {
						editor.insertContent('[icon_list title="" image="" icon=""]Insert your content here[/icon_list]');
					}
				}, {
					text : 'Image',
					onclick : function() {
						editor.insertContent('[image src="" align="" caption="" link="" link_type="" target="" alt=""]');
					}
				}, {
					text : 'Table',
					onclick : function() {
						editor.insertContent('<table><thead><tr><th>Column 1 heading</th><th>Column 2 heading</th><th>Column 3 heading</th></tr></thead><tbody><tr><td>Row 1 col 1 content</td><td>Row 1 col 2 content</td><td>Row 1 col 3 content</td></tr><tr><td>Row 2 col 1 content</td><td>Row 2 col 2 content</td><td>Row 2 col 3 content</td></tr></tbody></table>');
					}
				}, {
					text : 'Vimeo',
					onclick : function() {
						editor.insertContent('[vimeo video="1084537" width="700" height="400"]');
					}
				}, {
					text : 'YouTube',
					onclick : function() {
						editor.insertContent('[youtube video="YE7VzlLtp-4" width="700" height="420"]');
					}
				}, ]
			} ]

		});

	});
	
})();
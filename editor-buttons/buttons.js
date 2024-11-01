(function() {
    tinymce.create('tinymce.plugins.WpJouele', {
        init : function(ed, url) {
            ed.addButton('jouele_link', {
                title : 'Jouele Link',
                cmd : 'jouele_link',
                image : url + '/jouele_link.png'
            });

            ed.addCommand('jouele_link', function() {
                var selected_text = [
                    ed.selection,
                    ed.selection.getRng()
                ],
                    jouele_sc = '[wp-jouele]';

                if (selected_text[1].commonAncestorContainer
                    && selected_text[1].commonAncestorContainer.parentNode) {
                    var parent = selected_text[1].commonAncestorContainer.parentNode;
                    parent.insertAdjacentHTML('beforebegin', jouele_sc);
                    parent.insertAdjacentHTML('afterend', jouele_sc.replace('[', '[/'));
                }
            });

        },
        getInfo : function() {
            return {
                longname : 'WP-Jouele Buttons',
                author : 'Shu Buznik',
                authorurl : 'http://buznik.net/',
                infourl : 'http://wordpress.org/plugins/wp-jouele',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'wp_jouele', tinymce.plugins.WpJouele );
})();
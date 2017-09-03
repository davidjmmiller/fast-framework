$(function() {
    // Read cookie information
    console.log($.cookie('page_information'));
    
    // Capturing all the links
    function anchor_links() {
        $('a').click(
            function (ev) {
                ev.preventDefault();
                var current_path = ev.target.pathname;
                $.get(current_path, {}, function (data) {
                    console.log(data);
                    for (var name in  data) {
                        console.log(name);
                        //$('.component-' + name).html('<span style="background:yellow;">Replaced by component '+ name +"</span>");// +data[name]);
                        //anchor_links();
                    }
                    // console.log('Page ' + current_path + ' loaded')
                }, 'json');
            }
        );
    }
    anchor_links();
});
$(function() {
    // Capturing all the links
    function anchor_links() {
        $('a').click(
            function (ev) {
                ev.preventDefault();
                var current_path = ev.target.pathname;
                $.get(current_path, {}, function (data) {
                    for (var name in  data) {
                        console.log('.component-' + region, $('.component-' + region));
                        $('.component-' + name).html(data[name]);
                        anchor_links();
                    }
                    // console.log('Page ' + current_path + ' loaded')
                }, 'json');
            }
        );
    }
    anchor_links();
});
$(function() {
    // Capturing all the links
    $('a').click(
        function(ev) {
            ev.preventDefault();
            var current_path = ev.target.pathname;
            $.get(current_path,{}, function() {
                console.log('Page ' + path + ' loaded')
            },'json');
    });
});
$(function() {
    // Capturing all the links
    $('a').click(
        function(ev) {
            ev.preventDefault();
            var current_path = ev.target.pathname;
            console.log($);
            alert('Before get');
            $.get(current_path,{}, function() {
                console.log('Page ' + path + ' loaded')
            },'json');
    });
});
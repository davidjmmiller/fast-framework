$(function() {

    // Read cookie information
    // console.log(JSON.parse($.cookie('page_information')));

    window.addEventListener('popstate', function(ev){
        var path = ev.currentTarget.window.location.href.pathname; 
        //console.log(test.currentTarget);
        pageRefresh(ev);
    });
    
    const pushUrl = (href) => {
      history.pushState({}, '', href);
      window.dispatchEvent(new Event('popstate'));
    };

    pageRefresh = function (ev) {
        ev.preventDefault();
        var current_path = ev.target.pathname;
        $.get(current_path, {}, function (data) {
            for (var region in data) {
                $('.region-' + region + ' .component').each(function(itm,elm){
                    var component_name = $(elm).attr('class').split(' ')[1];
                    if (!data[region][component_name]){
                        $('.region-' + region + ' .' + component_name).html('');
                    }
                });
                for ( var component in data[region]){
                    
                    if($('.component-'+ component,'.region-' + region).length > 0){
                        $('.component-'+ component,'.region-' + region).html(data[region][component]);
                    }
                    else {
                        $('.region-' + region).prepend(data[region][component]);
                    }
                }
                
            }
            // Updating the path
            window.history.pushState('Object', 'Title', current_path);

            anchor_links();
        }, 'json');
    }


    // Capturing all the links
    function anchor_links() {
        $('a').click(pageRefresh);
    }
    anchor_links();
});
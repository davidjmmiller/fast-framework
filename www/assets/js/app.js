$(function() {
    // Read cookie information
    // console.log(JSON.parse($.cookie('page_information')));

    // Capturing all the links
    function anchor_links() {
        $('a').click(
            function (ev) {
                //console.log('Click');
                ev.preventDefault();
                var current_path = ev.target.pathname;
                $.get(current_path, {}, function (data) {
                    for (var region in data) {
                        //console.log(region);
                        $('.region-' + region + ' .component').each(function(itm,elm){
                            // console.log(itm,elm);
                            var component_name = $(elm).attr('class').split(' ')[1];
                            // console.log('Component name: ',component_name);
                            if (!data[region][component_name]){
                                $('.region-' + region + ' .' + component_name).html('');
                            }
                        });
                        for ( var component in data[region]){
                            // console.log('Region: ',region);
                            // console.log('Component: ',component);
                            // console.log('Info: ',data[region][component]);
                            // console.log('.component-'+ component,'.region-' + region);
                            // console.log($('.component-'+ component,'.region-' + region).length);
                            
                            
                            if($('.component-'+ component,'.region-' + region).length > 0){
                                $('.component-'+ component,'.region-' + region).html(data[region][component]);
                            }
                            else {
                                // console.log('Region: ',region,' Component: ',component);
                                $('.region-' + region).prepend(data[region][component]);
                            }
                        }
                        
                    }
                    anchor_links();
                    // console.log('Page ' + current_path + ' loaded')
                }, 'json');
            }
        );
    }
    anchor_links();
});
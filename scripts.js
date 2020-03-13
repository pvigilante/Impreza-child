/* Custom Javascript Here */

(function($){

    $(document).ready(function(){

        $('.mz-location-selector').on('change', function(e){
            e.preventDefault();

            var location_link = $(this).val();

            window.location.href = location_link;

            return;
            //console.log(location_link);
        });

    });

})(jQuery);
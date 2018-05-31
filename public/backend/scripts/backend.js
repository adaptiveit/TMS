

$(function() {
    /*var win      = $(window),
    fxel     = $('#data-table thead'),
    eloffset = fxel.offset().top;
    win.scroll(function() {
        if (eloffset < win.scrollTop()) {
            fxel.addClass("data-table-head-fixed");
        } else {
            fxel.removeClass("data-table-head-fixed");
        }
    });
    */
    $('#data-table').dataTable( {
        "fixedHeader": true,
        "bPaginate": true,
        "pageLength": 10,
        "lengthChange": true,
        "order": [[ 0, "desc" ]],
        "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ -1 ] } ],
        "searching": true,
        "info": true,
        //"responsive": true,
        
    });
    

    $('#side-menu').metisMenu();

    /* Get all state city */
    var stateId = $('#state').val(),
    checkedCity = $('#checked_city').val();
    getCity(stateId, checkedCity);
    
    $('#state').on('change', function(){
        var stateId = $(this).val(),
        checkedCity = $('#checked_city').val();
        getCity(stateId, checkedCity);
    });
    
    $("#check_all").change(function () {
        $("#city-list input:checkbox").prop('checked', $(this).prop("checked"));
    });

});

/*
* ajax request with JSONP
*/
function ajaxJsonpMethod(dataURL, postData, calBackfun){
    $.ajax({
        url: dataURL,                   
        type: "POST",
        data: postData,
        success: function( response ) {
            calBackfun(response);
        }
    });
}
/*
* get cities
*/
function getCity(stateId, checkedCity){
    var postData = [];      
    postData.push({name: 'state_id', value: stateId });
    postData.push({name: 'checked_city', value: checkedCity });
    //$('#livekit_loginSliderSubmit').addClass('livekit_loading_button').attr("disabled", true);
    ajaxJsonpMethod('/admin/cities', postData, getCitySuccess);
}

/*
* do action after ajaz success
*/
function getCitySuccess(data){
    //$('#livekit_loginSliderSubmit').removeClass('livekit_loading_button').attr("disabled", false);
    if(data){
        var cityHtml = '',
            city = data['cities'],
            checkedCity = data['checked_city'];
        if(city.length > 0){
            $('.check-all').show();
            for(var i=0; i < city.length; i++){
                var id = city[i]['id'],
                    cityName = city[i]['city_name'],
                    checked = checkedCity.indexOf(id) != -1 ? 'checked="checked"' : '';

                cityHtml += '<li>' +
                                    '<input type="checkbox" id="city'+id+'" name="city[]" value="'+id+'" '+checked+' class="checkbox-inline" >' +
                                    ' <label for="city'+id+'">'+cityName+'</label>'
                                '</li>';
            }
            $('#city-list').html(cityHtml);
        }else{
            $('.check-all').hide();
            $('#city-list').html('');
        }
    }    
}

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    })
})

/*  */
$(document).ready(function(){
    $('.filterable .filters input').val('').prop('disabled', true);
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});

$(document).ready(() => {
    listClients();
    $('#searchButton')
        .children('button')
        .on('click', function (event) {
            //may button wana send the form, so needed preventing the default
            event.preventDefault();
            if (
                validateSearchInputs(
                    $('#clientNameSearch'),
                    $('#clientIdSearch'),
                )
            ) {
                sendSearchInputs($('#clientNameSearch'), $('#clientIdSearch'));
            }
        });

    $('#clearButton')
        .children('button')
        .on('click', function (event) {
            //may button wana send the form, so needed preventing the default
            event.preventDefault();
            listClients();
        });

    $('#clientList').on('click', function (event) {
        if ($(event.target).hasClass('clientName')) {
            $('#clientList')
                .children('tr')
                .children('td:eq(1)')
                .addClass('clientName');
            $(event.target).removeClass('clientName');
            $('.services').remove();
            $('.cars').remove();
            listCarsForClient($(event.target));
        } else if ($(event.target).hasClass('car_id')) {
            $('.cars').children('td:eq(1)').addClass('car_id');
            $(event.target).removeClass('car_id');
            $('.services').remove();
            listServicesForCar($(event.target));
        }
    });
});

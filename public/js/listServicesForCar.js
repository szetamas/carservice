function listServicesForCar(carElement) {
    //MAY 'GET' METHOD NOT SECURE ENOUGH TO SEND ID
    //DONT MODIFY TO 'GET'!
    $.post('/api/car/services', { car_id: carElement.text() }, (services) => {
        for (let i = services.length - 1; i >= 0; i--) {
            let actualHtml = '';
            if (i % 10 === 0) {
                actualHtml += `
                  <tr class="services">
                    <th colspan="1">log number</th>
                    <th colspan="3">event</th>
                    <th colspan="2">event time</th>
                    <th colspan="1">document id</th>
                  </tr>`;
            }
            actualHtml += `
              <tr class="services">
                <td colspan="1">${services[i].log_number}</td>
                <td colspan="3">${services[i].event}</td>
                <td colspan="2">${services[i].event_time}</td>
                <td colspan="1">${services[i].document_id}</td>`;
            carElement.parent().after(actualHtml + `</tr>`);
        }
    }).fail((error) => {
        alert('ERROR: ' + error.responseJSON.message);
    });
}

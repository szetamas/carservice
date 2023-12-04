function listCarsForClient(clientElement) {
    //MAY 'GET' METHOD NOT SECURE ENOUGH TO SEND ID
    //DONT MODIFY TO 'GET'!
    $.post(
        '/api/client/cars',
        { client_id: clientElement.prev().text() },
        async (cars) => {
            for (let i = cars.length - 1; i >= 0; i--) {
                let actualHtml = '';
                if (i % 10 === 0) {
                    actualHtml += `
                    <tr class="cars">
                      <th class="col-1">car id</th>
                      <th class="col-2">type</th>
                      <th class="col-2">registered</th>
                      <th class="col-1">ownbrand</th>
                      <th class="col-1">accidents</th>
                      <th class="col-3">latest service</th>
                      <th class="col-2">latest service time</th>
                    </tr>`;
                }
                actualHtml += `
                <tr class="cars">
                  <td class="car_id col-1">${cars[i].car_id}</td>
                  <td class="col-2">${cars[i].type}</td>
                  <td class="col-2">${cars[i].registered}</td>
                  <td class="col-1">${cars[i].ownbrand ? 'yes' : 'no'}</td>
                  <td class="col-1">${cars[i].accidents}</td>`;
                await $.post(
                    '/api/car/latestservice',
                    { car_id: cars[i].car_id },
                    (service) => {
                        actualHtml += `
                        <td class="col-3">${service.event}</td>
                        <td class="col-2">${service.event_time}</td>`;
                    },
                ).fail((error) => {
                    alert('ERROR: ' + error.responseJSON.message);
                });
                clientElement.parent().after(actualHtml + `</tr>`);
            }
        },
    ).fail((error) => {
        alert('ERROR: ' + error.responseJSON.message);
    });
}

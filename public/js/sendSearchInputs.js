function sendSearchInputs(clientNameInput, clientIdInput) {
    $.post(
        '/api/client/search',
        { client_name: clientNameInput.val(), client_id: clientIdInput.val() },
        (client) => {
            $('#clientList').empty();
            $('#clientList').append(
                `<tr>
                <th>id</th>
                <th>name</th>
                <th>card number</th>
                <th>all cars</th>
                <th>all services</th>
              </tr>
              <tr>
                <td>${client.id}</td>
                <td>${client.name}</td>
                <td>${client.card_number}</td>
                <td>${client.cars_count}</td>
                <td>${client.services_count}</td>
              </tr>`,
            );
        },
    ).fail((error) => {
        alert('ERROR: ' + error.responseJSON.message);
    });
}

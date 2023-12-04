function listClients() {
    $('#clientList').empty();
    $.get('/api/clients', (clients) => {
        for (let i = 0; i < clients.length; i++) {
            if (i % 10 === 0) {
                $('#clientList').append(
                    `<tr>
                  <th colspan="2" class="col-3">id</th>
                  <th colspan="3" class="col-5">name</th>
                  <th colspan="2" class="col-4">card number</th>
                 </tr>`,
                );
            }
            $('#clientList').append(
                `<tr>
              <td colspan="2" class="col-3">${clients[i].id}</td>
              <td colspan="3" class="clientName col-5">${clients[i].name}</td>
              <td colspan="2" class="col-4">${clients[i].card_number}</td>
             </tr>`,
            );
        }
    }).fail((error) => {
        alert('ERROR: ' + error.responseJSON.message);
    });
}

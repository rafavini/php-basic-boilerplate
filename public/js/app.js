document.getElementById('btnLoadApi')?.addEventListener('click', function() {
    const responseDiv = document.getElementById('apiResponse');
    responseDiv.innerHTML = '<p>Carregando...</p>';

    fetch('/php-vanilla/api/users')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                responseDiv.innerHTML = `<p class="error">${data.error}</p>`;
                return;
            }

            let html = '<h4>Dados recebidos da API:</h4><ul>';
            data.forEach(user => {
                html += `<li><strong>${user.name}</strong> - ${user.email} (${user.role_name})</li>`;
            });
            html += '</ul>';
            responseDiv.innerHTML = html;
        })
        .catch(error => {
            console.error('Erro:', error);
            responseDiv.innerHTML = '<p class="error">Erro ao carregar dados da API.</p>';
        });
});

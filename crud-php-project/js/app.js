function changeHeartColor(id) {
    var heartIcon = document.getElementById('heart-icon-' + id);
    var isFavorited = heartIcon.classList.toggle('red-heart');

    $.ajax({
        url: '../actions/atualizar.php',
        method: 'POST',
        data: { id: id, favorito: isFavorited ? 1 : 0 },
        success: function (response) {
            console.log('Atualização bem-sucedida');
        },
        error: function (xhr, status, error) {
            console.error('Erro ao atualizar:', error);
        }
    });
}


function verificarOrdemFavoritos() {
    const cards = document.querySelectorAll('.card');
    const favoritos = Array.from(cards).filter(card => card.querySelector('.heart-icon').classList.contains('red-heart'));
    const naoFavoritos = Array.from(cards).filter(card => !card.querySelector('.heart-icon').classList.contains('red-heart'));

    const ordenados = [...favoritos, ...naoFavoritos];
    if (JSON.stringify(cards) === JSON.stringify(ordenados)) {
        console.log('A ordem dos cards está correta.');
    } else {
        console.log('A ordem dos cards está incorreta.');
    }
}

verificarOrdemFavoritos();


document.addEventListener('DOMContentLoaded', function () {
    const titulos = document.querySelectorAll('.titulo-card');

    titulos.forEach(titulo => {
        titulo.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');

            document.getElementById('cardId').textContent = id;
            document.getElementById('cardTitle').textContent = title;

            var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();

            document.getElementById('confirmDeleteBtn').setAttribute('data-id', id);
        });
    });


    document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
        const id = this.getAttribute('data-id');

        fetch('../actions/delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Livro excluído com sucesso!');
                    document.querySelector(`.titulo-card[data-id='${id}']`).closest('.card').remove();
                    window.location.reload();
                } else {
                    alert('Falha ao excluir o livro.');
                }
            })
            .catch(error => console.error('Erro:', error));
    });
});


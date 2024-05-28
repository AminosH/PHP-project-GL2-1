let page = 0;
let totalTransfers;
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

fetch('getTotalTransfers.php')
    .then(response => response.text())
    .then(data => {
        totalTransfers = parseInt(data);
    });

prevButton.addEventListener('click', function() {
    if (page > 0) {
        page--;
        loadTransfers();
    }
});

nextButton.addEventListener('click', function() {
    if ((page + 1) * 5 < totalTransfers) {
        page++;
        loadTransfers();
    }
});

function loadTransfers() {
    const start = page * 5;
    fetch(`getTransfersTable.php?start=${start}&amount=5`)
        .then(response => response.text())
        .then(data => {
            document.querySelector('.content').innerHTML = data;
            prevButton.disabled = page === 0;
            nextButton.disabled = (page + 1) * 5 >= totalTransfers;
        });
}
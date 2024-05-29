let page = 0;
let totalTransfers;
const TRANSFERS_PER_PAGE = 10;
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
    if ((page + 1) * TRANSFERS_PER_PAGE < totalTransfers) {
        page++;
        loadTransfers();
    }
});

function loadTransfers() {
    const start = page * TRANSFERS_PER_PAGE;
    fetch(`getTransfersTable.php?start=${start}&amount=${TRANSFERS_PER_PAGE}`)
        .then(response => response.text())
        .then(data => {
            document.querySelector('.content').innerHTML = data;
            prevButton.disabled = page === 0;
            nextButton.disabled = (page + 1) * TRANSFERS_PER_PAGE >= totalTransfers;
        });
}
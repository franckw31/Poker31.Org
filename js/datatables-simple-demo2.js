window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimpleb = document.getElementById('datatablesSimpleb');
    if (datatablesSimpleb) {
        new simpleDatatables.DataTable(datatablesSimpleb);
    }
});

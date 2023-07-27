document.getElementById('certType').addEventListener('change', function() {
    var certType = document.getElementById('certType').value;
    var rows = document.getElementById('residenttable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var id = row.querySelector('a').getAttribute('href').split('=')[1];
        row.querySelector('a').setAttribute('href', certType === '' ? '#' : certType + '?id=' + id);
    }
});
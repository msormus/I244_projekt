window.addEventListener('load', function () {

    document.getElementById('vorm2').addEventListener('submit', function (e) {

        var kasutajanimi = document.getElementById('username').value;
        var parool = document.getElementById('pass').value;

        if (kasutajanimi.length < 5 || parool.length < 5) {
            alert('Liiga lühike kasutajanimi või parool!');
            e.preventDefault();
            return;
        }

    });

});
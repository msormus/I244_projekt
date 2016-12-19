window.addEventListener('load', function () {

    document.getElementById('lisa-vorm').addEventListener('submit', function (e) {

        var number = document.getElementById('number').value;

        if (number.length < 2) {
            alert('Liiga lühike nimetus!');
            e.preventDefault();
            return;
        }

    });

});
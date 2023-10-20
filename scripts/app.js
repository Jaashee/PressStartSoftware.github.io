(function () {

    let btn = document.querySelector('#btn');

    let sidebar = document.querySelector('.sidebar');

    btn.onclick = function () {
        sidebar.classList.toggle("active");
    };

    $(document).ready(function() {
        $('#btn').click(function() {
            $('.pressstart').toggleClass('opened');
        });
    });


})();

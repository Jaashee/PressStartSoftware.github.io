let marketButton =document.getElementById('market');
let market = 'https://www.pricecharting.com/category/video-games';

marketButton.addEventListener('click', () =>{
window.open('https://www.pricecharting.com/category/video-games', '_blank')
});

(function () {

    let btn = document.querySelector('#btn');

    let sidebar = document.querySelector('.sidebar');

    btn.onclick = function () {
        sidebar.classList.toggle("active");
    };


})();

let marketButton =document.getElementById('market');
let market = 'https://www.pricecharting.com/category/video-games';

marketButton.addEventListener('click', () =>{
window.open('https://www.pricecharting.com/category/video-games', '_blank')
});
/*
var express = require('express'),
    path = require('path'),
    bodyParser = require('body-parser'),
    cons = require('consolidate'),
    dust = require('dustjs-helpers'),
    pg = require('pg'),
    app = express();

    //connection string to database
var connect = "postgres://pressstart_admin:12345@localhost/PressStart_db"


});*/

(function () {

    document.addEventListener("DOMContentLoaded", function() {
        var btn = document.querySelector('#btn');
        var sidebar = document.querySelector('.sidebar');
        var pressstart = document.querySelector('.pressstart');

        btn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            pressstart.classList.toggle('opened');
        });
    });



})();

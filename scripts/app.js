var express = require('express'),
    path = require('path'),
    bodyParser = require('body-parser'),
    cons = require('consolidate'),
    dust = require('dustjs-helpers'),
    pg = require('pg'),
    app = express();

    //connection string to database
var connect = "postgres://pressstart_admin:12345@localhost/PressStart_db"


//getting element from button
let marketButton =document.getElementById('market');
//event listener so when button is clicked to redirets user to specified website
marketButton.addEventListener('click', () =>{
window.open('https://www.pricecharting.com/category/video-games', '_blank')
});
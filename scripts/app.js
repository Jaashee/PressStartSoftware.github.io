var express = require('express'),
    path = require('path'),
    bodyParser = require('body-parser'),
    cons = require('consolidate'),
    dust = require('dustjs-helpers'),
    pg = require('pg'),
    app = express();

var connect = "postgress://pressstart_admin:12345@127.0.0.1/PressStart_db"

app.engine('dust', cons.dust);

app.set('view engine', 'dust');
app.set('views', __dirname + '/views');

app.use(express.static(path.join(__dirname, 'public')));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended:false}));


app.listen(3000, function(){
    console.log('Server started')
});


app.get('/', function(req,res){
    console.log('TEST');
})
/*
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
*/
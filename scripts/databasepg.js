const {Client} = require('pg')

const client = new Client({
    host: "127.0.0.1",
    user: "pressstart_admin",
    post: "5432",
    password: "12345",
    database: "PressStart_db"
})

client.connect()

client.query('Select * from employee', (err,res)=>{
    if(!err){
        console.log(res.rows);
    }
    else{
        console.log(err.message);
    }
    client.end;
})

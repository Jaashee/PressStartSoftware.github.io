const {Client} = require('pg');

const port = 3000;


const client = new Client({
    host: "127.0.0.1",
    user: "pressstart_admin",
    port: "5432",
    password: "12345",
    database: "PressStart_db"
})

client.connect();

client.query(`Select * from client`, (err,res)=>{
    if(!err){
        console.log(res.rows);
    }
    else{
        console.log(err.message);
    }
})

const getClient = (request, response) => {
    client.query('SELECT * FROM client ORDER BY client_id ASC', (error, results) => {
      if (error) {
        throw error
      }
      response.status(200).json(results.rows)
    })
  }

  const getClientById = (request, response) => {
    const id = parseInt(request.params.id)
  
    client.query('SELECT * FROM client WHERE client_id = $1', [id], (error, results) => {
      if (error) {
        throw error
      }
      response.status(200).json(results.rows)
    })
  }

  const createClient = (request, response) => {
    const {email} = request.body
  
    client.query('INSERT INTO client (client_email) VALUES ($1) RETURNING *', [email], (error, results) => {
      if (error) {
        throw error
      }
      response.status(201).send(`Client added with ID: ${results.rows[0].id}`)
    })
  }

  const updateClient = (request, response) => {
    const id = parseInt(request.params.id)
    const { name, email } = request.body
  
    client.query(
      'UPDATE client SET client_email = $1 WHERE client_id = $3',
      [name, email, id],
      (error, results) => {
        if (error) {
          throw error
        }
        response.status(200).send(`Client modified with ID: ${id}`)
      }
    )
  }

  const deleteClient = (request, response) => {
    const id = parseInt(request.params.id)
  
    client.query('DELETE FROM client WHERE client_id = $1', [id], (error, results) => {
      if (error) {
        throw error
      }
      response.status(200).send(`Client deleted with ID: ${id}`)
    })
  }

  module.exports = {
    getClient,
    getClientById,
    createClient,
    updateClient,
    deleteClient,
  }
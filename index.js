const express = require('express')
const bodyParser = require('body-parser')
const app = express()
const db = require('./databasepg')
const port = 3000

app.use(bodyParser.json())
app.use(
  bodyParser.urlencoded({
    extended: true,
  })
)

app.get('/client', (request, response) => {
    response.json({ info: 'Node.js, Express, and Postgres API' })
  })

app.get('/client', db.getClient)
app.get('/client/:id', db.getClientById)
app.post('/client', db.createClient)
app.put('/client/:id', db.updateClient)
app.delete('/client/:id', db.deleteClient)


  app.listen(port, () => {
    console.log(`Server on ${port}.`)
  })
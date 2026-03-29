const express = require('express')
const bodyParser = require('body-parser')
const cors = require('cors')

const app = express()
app.use(bodyParser.json())
app.use(cors())

let books = [
    { id: 1, title: "Book One", author: "Author A" },
    { id: 2, title: "Book Two", author: "Author B" }
]

app.get('/books', (req, res) => {
    res.json(books)
})

app.get('/books/:id', (req, res) => {
    const book = books.find(b => b.id == req.params.id)
    if (!book) return res.status(404).send("Book not found")
    res.json(book)
})

app.post('/books', (req, res) => {
    const newBook = {
        id: books.length + 1,
        title: req.body.title,
        author: req.body.author
    }
    books.push(newBook)
    res.status(201).json(newBook)
})

app.put('/books/:id', (req, res) => {
    const book = books.find(b => b.id == req.params.id)

    if (!book) return res.status(404).send("Book not found")

    book.title = req.body.title || book.title
    book.author = req.body.author || book.author

    res.json(book)
})

app.delete('/books/:id', (req, res) => {
    const index = books.findIndex(b => b.id == req.params.id)

    if (index === -1) return res.status(404).send("Book not found")

    const deletedBook = books.splice(index, 1)
    res.json(deletedBook)
})

app.listen(3000, () => {
    console.log("Server running on http://localhost:3000")
})
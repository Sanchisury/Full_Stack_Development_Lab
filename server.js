const express = require('express')
const mongoose = require('mongoose')
const cors = require('cors')

const app = express()
app.use(express.json())
app.use(cors())

mongoose.connect('mongodb://127.0.0.1:27017/fsdl')

const StudentSchema = new mongoose.Schema({
    firstName: String,
    lastName: String,
    rollNo: String,
    password: String,
    contact: String
})

const Student = mongoose.model('Student', StudentSchema)

// CREATE
app.post('/students', async (req, res) => {
    const student = new Student(req.body)
    await student.save()
    res.json(student)
})

// READ
app.get('/students', async (req, res) => {
    const students = await Student.find()
    res.json(students)
})

// UPDATE
app.put('/students/:rollNo', async (req, res) => {
    const updated = await Student.findOneAndUpdate(
        { rollNo: req.params.rollNo },
        req.body,
        { new: true }
    )
    res.json(updated)
})

// DELETE
app.delete('/students/:rollNo', async (req, res) => {
    await Student.findOneAndDelete({ rollNo: req.params.rollNo })
    res.send("Deleted")
})

app.listen(3000, () => {
    console.log("Server running on http://localhost:3000")
})
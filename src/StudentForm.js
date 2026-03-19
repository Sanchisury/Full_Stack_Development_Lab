import { useState } from "react";

function StudentForm() {
  const [students, setStudents] = useState([]);
  const [form, setForm] = useState({
    name: "",
    email: "",
    mobile: "",
    department: ""
  });
  const [error, setError] = useState("");

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const validateEmail = (email) => {
    return /\S+@\S+\.\S+/.test(email);
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (!form.name || !form.email || !form.mobile || !form.department) {
      setError("All fields are required!");
      return;
    }

    if (!validateEmail(form.email)) {
      setError("Invalid email format!");
      return;
    }

    setStudents([...students, { ...form, id: Date.now() }]);

    setForm({
      name: "",
      email: "",
      mobile: "",
      department: ""
    });

    setError("");
    alert("Student Added Successfully!");
  };

  const handleDelete = (id) => {
    setStudents(students.filter((s) => s.id !== id));
  };

  return (
    <div className="container">

      <div className="card">
        <h2>Add Student</h2>

        {error && <p className="error">{error}</p>}

        <form onSubmit={handleSubmit}>
          <input
            type="text"
            name="name"
            value={form.name}
            onChange={handleChange}
            placeholder="Enter Name"
          />

          <input
            type="text"
            name="email"
            value={form.email}
            onChange={handleChange}
            placeholder="Enter Email"
          />

          <input
            type="text"
            name="mobile"
            value={form.mobile}
            onChange={handleChange}
            placeholder="Enter Mobile"
          />

          <input
            type="text"
            name="department"
            value={form.department}
            onChange={handleChange}
            placeholder="Enter Department"
          />

          <button type="submit">Add Student</button>
        </form>
      </div>

      <div className="card">
        <h2>Student Records</h2>

        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile</th>
              <th>Department</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            {students.length === 0 ? (
              <tr>
                <td colSpan="6">No Data Found</td>
              </tr>
            ) : (
              students.map((s) => (
                <tr key={s.id}>
                  <td>{s.id}</td>
                  <td>{s.name}</td>
                  <td>{s.email}</td>
                  <td>{s.mobile}</td>
                  <td>{s.department}</td>
                  <td>
                    <button
                      className="delete-btn"
                      onClick={() => handleDelete(s.id)}
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              ))
            )}
          </tbody>
        </table>
      </div>

    </div>
  );
}

export default StudentForm;
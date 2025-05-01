const BASE_URL = 'http://127.0.0.1:8000/api/interviewers';  // Laravel API endpoint

// ✅ Fetch and Display All Interviewers
const fetchInterviewers = async () => {
  try {
    const response = await fetch(BASE_URL);
    const data = await response.json();

    const list = document.getElementById('interviewers-list');
    list.innerHTML = '';

    data.data.forEach(interviewer => {
      const div = document.createElement('div');
      div.innerHTML = `
        <p><strong>${interviewer.first_name} ${interviewer.last_name}</strong></p>
        <p>Email: ${interviewer.email}</p>
        <button onclick="editInterviewer(${interviewer.id})">Edit</button>
        <button onclick="deleteInterviewer(${interviewer.id})">Delete</button>
      `;
      list.appendChild(div);
    });

  } catch (error) {
    console.error('Error fetching interviewers:', error);
  }
};

// ✅ Create New Interviewer
document.getElementById('interviewer-form').addEventListener('submit', async (e) => {
  e.preventDefault();

  const firstName = document.getElementById('first-name').value;
  const lastName = document.getElementById('last-name').value;
  const email = document.getElementById('email').value;

  const response = await fetch(BASE_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      first_name: firstName,
      last_name: lastName,
      email
    })
  });

  if (response.ok) {
    alert('Interviewer created successfully!');
    fetchInterviewers();
  } else {
    alert('Failed to create interviewer.');
  }
});

// ✅ Edit Interviewer
const editInterviewer = async (id) => {
  const firstName = prompt('Enter new first name:');
  const lastName = prompt('Enter new last name:');
  const email = prompt('Enter new email:');

  const response = await fetch(`${BASE_URL}/${id}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      first_name: firstName,
      last_name: lastName,
      email
    })
  });

  if (response.ok) {
    alert('Interviewer updated successfully!');
    fetchInterviewers();
  } else {
    alert('Failed to update interviewer.');
  }
};

// ✅ Delete Interviewer
const deleteInterviewer = async (id) => {
  if (confirm('Are you sure you want to delete this interviewer?')) {
    await fetch(`${BASE_URL}/${id}`, {
      method: 'DELETE'
    });
    fetchInterviewers();
  }
};

// ✅ Load All Interviewers on Page Load
fetchInterviewers();

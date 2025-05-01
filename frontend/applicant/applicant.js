const BASE_URL = 'http://127.0.0.1:8000/api/applicants';  // Laravel API endpoint

// ✅ Fetch and Display All Applicants
const fetchApplicants = async () => {
  try {
    const response = await fetch(BASE_URL);
    const data = await response.json();

    const list = document.getElementById('applicants-list');
    list.innerHTML = '';

    data.data.forEach(applicant => {
      const div = document.createElement('div');
      div.innerHTML = `
        <p><strong>${applicant.first_name} ${applicant.last_name}</strong></p>
        <p>Email: ${applicant.email}</p>
        <button onclick="editApplicant(${applicant.id})">Edit</button>
        <button onclick="deleteApplicant(${applicant.id})">Delete</button>
      `;
      list.appendChild(div);
    });

  } catch (error) {
    console.error('Error fetching applicants:', error);
  }
};

// ✅ Create New Applicant
document.getElementById('applicant-form').addEventListener('submit', async (e) => {
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
    alert('Applicant created successfully!');
    fetchApplicants();
  } else {
    alert('Failed to create applicant.');
  }
});

// ✅ Edit Applicant
const editApplicant = async (id) => {
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
    alert('Applicant updated successfully!');
    fetchApplicants();
  } else {
    alert('Failed to update applicant.');
  }
};

// ✅ Delete Applicant
const deleteApplicant = async (id) => {
  if (confirm('Are you sure you want to delete this applicant?')) {
    await fetch(`${BASE_URL}/${id}`, {
      method: 'DELETE'
    });
    fetchApplicants();
  }
};

// ✅ Load All Applicants on Page Load
fetchApplicants();

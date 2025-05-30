const BASE_URL = 'http://127.0.0.1:8000/api';

// Show Section
const showSection = (sectionId) => {
  document.querySelectorAll('.content-section').forEach(section => {
    section.style.display = 'none';
  });
  document.getElementById(sectionId).style.display = 'block';
};

// Fetch Data
const fetchData = async (model, listId) => {
  try {
    const response = await fetch(`${BASE_URL}/${model}`);
    const data = await response.json();
    
    displayData(data.data, listId);
    
  } catch (error) {
    console.error('Error:', error);
  }
};

// Display Data
const displayData = (data, listId) => {
  const list = document.getElementById(listId);
  list.innerHTML = '';
  
  data.forEach(item => {
    const div = document.createElement('div');
    div.classList.add('admin');
    div.innerHTML = `
      <strong>ID:</strong> ${item.id} - <strong>Name:</strong> ${item.name || item.first_name || 'N/A'}
      <button onclick="deleteData('${item.id}')">Delete</button>
    `;
    list.appendChild(div);
  });
};

// Delete Data
const deleteData = async (id) => {
  const response = await fetch(`${BASE_URL}/admins/${id}`, { method: 'DELETE' });
  if (response.ok) {
    alert('Deleted successfully!');
  }
};

// Initial Fetch
fetchData('admins', 'admin-list');
fetchData('applicants', 'applicant-list');
fetchData('interviewers', 'interviewer-list');

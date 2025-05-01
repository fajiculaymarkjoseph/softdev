const BASE_URL = 'http://127.0.0.1:8000/api/admins';  // Laravel API endpoint

// ✅ Fetch and Display All Admins
const fetchAdmins = async () => {
  try {
    const response = await fetch(BASE_URL);

    if (!response.ok) {
      console.error(`Failed to fetch admins: ${response.status}`);
      return;
    }

    const data = await response.json();
    const tableBody = document.getElementById('admins-table-body');
    tableBody.innerHTML = '';  // Clear previous entries

    data.data.forEach(admin => {
      const row = document.createElement('tr');

      row.innerHTML = `
        <td>${admin.id}</td>
        <td>${admin.name}</td>
        <td>${admin.email}</td>
        <td>
          <button onclick="openEditModal(${admin.id}, '${admin.name}', '${admin.email}')">Edit</button>
          <button onclick="deleteAdmin(${admin.id})">Delete</button>
        </td>
      `;

      tableBody.appendChild(row);
    });

  } catch (error) {
    console.error('Error fetching admins:', error);
  }
};

// ✅ Create Admin
document.getElementById('admin-form').addEventListener('submit', async (e) => {
  e.preventDefault();

  const name = document.getElementById('admin-name').value;
  const email = document.getElementById('admin-email').value;
  const password = document.getElementById('admin-password').value;

  const response = await fetch(BASE_URL, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ name, email, password })
  });

  if (response.ok) {
    alert('Admin created successfully!');
    fetchAdmins();
  } else {
    alert('Failed to create admin.');
  }
});

// ✅ Open Edit Modal
const openEditModal = (id, name, email) => {
  document.getElementById('edit-id').value = id;
  document.getElementById('edit-name').value = name;
  document.getElementById('edit-email').value = email;

  document.getElementById('edit-modal').style.display = 'block';
};

// ✅ Close Edit Modal
const closeModal = () => {
  document.getElementById('edit-modal').style.display = 'none';
};

// ✅ Edit Admin
document.getElementById('edit-form').addEventListener('submit', async (e) => {
  e.preventDefault();

  const id = document.getElementById('edit-id').value;
  const name = document.getElementById('edit-name').value;
  const email = document.getElementById('edit-email').value;

  const response = await fetch(`${BASE_URL}/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ name, email })
  });

  if (response.ok) {
    alert('Admin updated successfully!');
    closeModal();
    fetchAdmins();
  } else {
    alert('Failed to update admin.');
  }
});

// ✅ Delete Admin
const deleteAdmin = async (id) => {
  if (confirm('Are you sure you want to delete this admin?')) {
    await fetch(`${BASE_URL}/${id}`, { method: 'DELETE' });
    fetchAdmins();
  }
};

// ✅ Load all admins on page load
document.addEventListener('DOMContentLoaded', fetchAdmins);

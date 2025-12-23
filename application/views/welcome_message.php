<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter3 and Vue2 </title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
	</style>
	<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>
	<div id="body">
		<hr>
			<div id="app">
				<h2>{{ message }}</h2>
				<button @click="getUsers" style="padding: 6px 12px; font-size: 16px; margin-right: 10px;">Load Users</button>
    			<button @click="openAddForm" style="padding: 6px 12px; font-size: 16px; margin-bottom: 20px;">Add User</button>
				<table v-if="users.length" border="1" cellpadding="4" cellspacing="1" width="50%">
					<thead>
						<tr>
							<th>ID</th>	
							<th>Name</th>
							<th>Email</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="user in users" :key="user.id">
							<td>{{ user.id }}</td>
							<td>{{ user.name }}</td>
							<td>{{ user.email }}</td>
							<td>
								<button @click="editUser(user)">Edit</button>
								<button @click="deleteUser(user.id)">Delete</button>
								<button @click="viewProfile(user.id)">Profile</button>
							</td>
						</tr>
					</tbody>
				</table>
				<p v-else>No users loaded yet.</p>

				<div v-if="showForm" class="form-box" style="">
					<h3>{{ curUser.id ? 'Edit User' : 'Add User' }}</h3>
					<input type="text" v-model="curUser.name" placeholder="Name">
					<input type="email" v-model="curUser.email" placeholder="Email">
					<button @click="saveUser">{{ curUser.id ? 'Update' : 'Save' }}</button>
					<button @click="closeForm">Cancel</button>
				</div>

				<div v-if="showProfile" class="modal">
					<h3>{{profile.id ? 'Profile' :'Add Profile'}}</h3>
					<div v-if="profile.id">	
						<p><strong>Bio:</strong> {{ profile.bio }}</p>
						<p><strong>Address:</strong> {{ profile.address }}</p>
						<button @click="closeProfile">Close</button>
					</div>
					<div v-else>
						<input type="text" v-model="profile.bio" placeholder="Bio">
						<input type="text" v-model="profile.address" placeholder="Address">
						<button @click="addProfile">Save</button>
						<button @click="closeProfile">Cancel</button>
					</div>
				</div>
			</div>
		<hr>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>
</html>

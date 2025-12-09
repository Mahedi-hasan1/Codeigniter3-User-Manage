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
				<button @click="getUsers">Load Users</button>
    			<button @click="openAddForm">Add User</button>
				<ul v-if="users.length">
					<li v-for="user in users" :key="user.id" @click="selectUser(user.id)"
      					:class="{selected: selectedUserId === user.id}">
						<strong>{{ user.name }}</strong> - {{ user.email }}
						<span v-if="selectedUserId === user.id" class="actions">
							<button @click.stop="editUser(user.id)">Edit</button>
							<button @click.stop="deleteUser(user.id)">Delete</button>
							<button @click.stop="viewProfile(user.id)">Profile</button>
						</span>
					</li>
				</ul>
				<p v-else>No users loaded yet.</p>
				<div v-if="showForm" class="form-box">
					<h3>{{ newUser.id ? 'Edit User' : 'Add User' }}</h3>
					<input type="text" v-model="newUser.name" placeholder="Name">
					<input type="email" v-model="newUser.email" placeholder="Email">
					<button @click="saveUser">{{ newUser.id ? 'Update' : 'Save' }}</button>
					<button @click="closeForm">Cancel</button>
				</div>

				<div v-if="showProfile" class="modal">
					<h3>Profile</h3>
					<p><strong>Name:</strong> {{ profile.name }}</p>
					<p><strong>Email:</strong> {{ profile.email }}</p>
					<p><strong>Other Info:</strong> {{ profile.other_info }}</p>
					<button @click="closeProfile">Close</button>
				</div>
			</div>
		<hr>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>
</html>

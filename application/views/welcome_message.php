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
				<button>Add User</button>
				<ul v-if="users.length">
					<li v-for="user in users" :key="user.id">
						<strong>{{ user.name }}</strong> - {{ user.email }}
					</li>
				</ul>
				<p v-else>No users loaded yet.</p>
			</div>
		<hr>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
</body>
</html>

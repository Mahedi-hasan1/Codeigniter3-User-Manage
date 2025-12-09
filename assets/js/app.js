new Vue({
    el: '#app',
    data: {
        message: "Vue 2 is now running!",
		users: []
    },
    methods: {
        getUsers() {
            axios.get('http://192.168.26.71/codeigniter3/index.php/users/')
                .then(response => {
                    this.users = response.data;
                })
                .catch(error => {
                    console.error("Error fetching users:", error);
                    alert("Failed to load users.");
                });
        }
    }
});
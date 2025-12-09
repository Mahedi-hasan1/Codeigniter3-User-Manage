new Vue({
    el: '#app',
    data: {
        message: "Vue 2 is now running!",
		users: [],
        showForm: false,
        newUser: {
            name: "",
            email: ""
        },
        selectedUserId: null,
        showProfile: false,
        profile: {}
    },
    methods: {
        getUsers() {
            axios.get('http://192.168.26.71/codeigniter3/index.php/users/')
                .then(response => {
                    console.log(response.data)
                    this.users = response.data;
                })
                .catch(error => {
                    console.error("Error fetching users:", error);
                    alert("Failed to load users.");
                });
        },
        selectUser(id) {
            this.selectedUserId = this.selectedUserId === id ? null : id;
        },
        openAddForm() {
            this.showForm = true;
            this.newUser = { id:null, name:"", email:"" };
        },
        closeForm() {
            this.showForm = false;
        },
        editUser(id) {
            //console.log(id);
           axios.post(`http://192.168.26.71/codeigniter3/index.php/users/update/${id}`)
            .then(res => {
                this.newUser = {...res.data}; // populate form for update
                this.showForm = true;
            })
            .catch(err => console.error("Error fetching user for edit:", err)); 
        },
        saveUser() {
            if(this.newUser.id){
            // Update user
                axios.post(`http://192.168.26.71/codeigniter3/index.php/users/update/${this.newUser.id}`, this.newUser)
                    .then(() => {
                        this.showForm = false;
                        this.getUsers();
                    })
                    .catch(err => console.error("Error updating user:", err));
            } else {
                // Create user
                axios.post("http://192.168.26.71/codeigniter3/index.php/users/create", this.newUser)
                    .then(() => {
                        this.showForm = false;
                        this.getUsers();
                    })
                    .catch(err => console.error("Error adding user:", err));
            }
        },
        deleteUser(id){
            if(confirm("Are you sure to delete this user?")){
                axios.post(`http://192.168.26.71/codeigniter3/index.php/users/delete/${id}`)
                    .then(()=> this.getUsers())
                    .catch(err => console.error(err));
            }
        },
        viewProfile(id){
            axios.get(`http://192.168.26.71/codeigniter3/index.php/userprofiles/getbyuserid/${id}`)
            .then(res => {
                this.profile = res.data;
                this.showProfile = true;
            })
            .catch(err => console.error("Error fetching profile:", err));
        },
        closeProfile() {
            this.showProfile = false;
        }
    }
});
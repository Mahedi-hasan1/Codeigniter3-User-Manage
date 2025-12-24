new Vue({
    el: '#app',
    data: {
        baseUrl:"http://192.168.26.71/codeigniter3/index.php",
        message: "User Management!",
		users: [],
        showForm: false,
        curUser: {
            name: "",
            email: ""
        },
        selectedUserId: null,
        showProfile: false,
        profile: {}
    },
    methods: {
        getUsers() {
            axios.get(`${this.baseUrl}/users/`)
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
            this.curUser = { id:null, name:"", email:"" };
        },
        closeForm() {
            this.showForm = false;
        },
        editUser(user) {
            //console.log(id);
            this.curUser = {
                id: user.id,
                name: user.name,
                email: user.email
            };
            this.showForm = true;
        },
        saveUser() {
            if(this.curUser.id){
            // Update user
                axios.post(`${this.baseUrl}/users/update/${this.curUser.id}`, this.curUser)
                    .then(() => {
                        this.showForm = false;
                        this.getUsers();
                    })
                    .catch(err => console.error("Error updating user:", err));
            } else {
                // Create user
                axios.post(`${this.baseUrl}/users/create`, this.curUser)
                    .then(() => {
                        this.showForm = false;
                        this.getUsers();
                    })
                    .catch(err => console.error("Error adding user:", err));
            }
        },
        deleteUser(id){
            if(confirm("Are you sure to delete this user?")){
                axios.post(`${this.baseUrl}/users/delete/${id}`)
                    .then(()=> this.getUsers())
                    .catch(err => console.error(err));
            }
        },
        viewProfile(userId){
            this.profile = { id: null};
            this.curUser = {
                id: userId,
            };
            this.showProfile = true;
            console.log("user id ", userId);
            axios.get(`${this.baseUrl}/userprofiles/getbyuserid/${userId}`)
            .then(res => {
                console.log("profile response data: ", res.data);
                if(res.data && res.data.profile.id){
                    this.profile = res.data.profile;
                } else {
                    this.profile = { id: null, bio: '', address: '' };
                }
             //console.log("profile data: ", this.profile);

            })
            .catch(err => console.error("Error fetching profile:", err));
        },
        addProfile(){
            //this.profile = {user_id : this.curUser.id};
            this.profile.user_id = this.curUser.id;
            console.log("add profile data: ", this.profile);
            axios.post(`${this.baseUrl}/userprofiles/create`, this.profile)
            .then(() => {
                        this.showProfile = false;
                        //this.getUsers();
                    })
            .catch(err => console.error("Error adding profile:", err));
        },
        closeProfile() {
            this.showProfile = false;
        }
    }
});
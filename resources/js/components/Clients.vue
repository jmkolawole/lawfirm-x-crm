<template>
    <div id="body">
        <div class="clients container">
            <Alert v-if="alert" v-bind:message="alert"/>
            <div>
                <h1 class="page-header">Manage Clients</h1>
                <input class="form-control" type="text" placeholder="Enter last name" v-model="filterInput"/>
                <br/>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Date Profiled</th>
                            <th scope="col">Primary Legal Counsel</th>
                            <th scope="col">Profile Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr v-for="client in filterBy(clients.data, filterInput)" :key="client.id">
                            <td>{{client.id}}</td>
                            <td>{{ client.firstname }}</td>
                            <td>{{ client.lastname }}</td>
                            <td>{{ client.email }}</td>
                            <td>{{ client.dob | formatDate}}</td>
                            <td>{{ client.created_at | formatDate}}</td>
                            <td>{{ client.primary_legal_counsel }}</td>
                            <td><img :src="clients.file_directory + '/' + client.profile_image" 
                            width="50" height="50" class="img img-thumbnail"/></td>
                            <td><router-link class="btn btn-default" 
                            v-bind:to="'/client/'+client.id">View</router-link></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Alert from './Alert';

export default {
  components: { Alert },
    name: "clients",
    data() {
        return {
            clients: [],
            alert: "",
            filterInput : ''
        };
    },
    methods: {
        fetchClients() {
            this.$http
                .get("http://localhost:8000/api/clients/view-all")
                .then(function(response) {
                    this.clients = response.body
                });
        },
        filterBy(list, value){
            value = value.charAt(0).toUpperCase() + value.slice(1);
            return list.filter(function(client){
                   return client.lastname.indexOf(value) > -1; 
            })
        }
    },
    created: function() {
        this.fetchClients();
        if(this.$route.query.alert){
            this.alert = this.$route.query.alert;
        }
    },
    updated: function() {
        this.fetchClients();
    },
    components: {
        Alert
    }
};
</script>

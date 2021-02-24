<template>
    <div id="body">
        <div class="details container">
            <div>
                <h1 class="page-header">
                    {{ client.data.firstname }} {{ client.data.lastname }}
                     
                    <span class="pull-right">
                        <!--<router-link class="btn btn-primary" v-bind:to="'update/'+client.data.id">Edit</router-link>
                        <button v-on:click="deleteClient(client.data.id)" class="btn btn-danger">Delete</button>-->
                    </span>
                    
                </h1>
                <router-link to="/" class=" btn btn-secondary">&lt;&lt;&nbsp;Back</router-link><br><br>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <img :src="client.file_directory +'/' + client.data.profile_image"                                   width="100"
                                    height="100"
                                    class="img img-thumbnail"
                                />
                            </li>
                            <li class="list-group-item">
                                <b>Name:</b> {{ client.data.lastname }} {{ client.data.firstname }}
                            </li>
                            <li class="list-group-item">
                                <b>Email:</b> {{ client.data.email }}
                            </li>
                            <li class="list-group-item">
                                <b>Date of Birth:</b> {{ client.data.dob | formatDate }}
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-8 col-sm-6 col-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class=" card">
                                    <div class=" card-header">
                                       <b> Date Profiled</b>
                                    </div>
                                    <div class=" card-body">
                                        {{ client.data.created_at | formatDate }}
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <div class=" card">
                                    <div class=" card-header">
                                        <b>Primary Legal Counsel</b>
                                    </div>
                                    <div class=" card-body">
                                        {{ client.data.primary_legal_counsel }}
                                    </div>
                                </div>
                            </li>
                            

                            <li class="list-group-item">
                                <div class=" card">
                                    <div class=" card-header">
                                        <b>Case Details</b>
                                    </div>
                                    <div class=" card-body">
                                        {{ client.data.case_details }}
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "clientdetails",
    data() {
        return {
            client: ""
        };
    },
    methods: {
        fetchClient(id) {
            this.$http
                .get("http://localhost:8000/api/clients/view/" + id)
                .then(function(response) {
                    this.client = response.body;
                    console.log(response.body.data);
                });
        },

        /*deleteClient(id){
            
         this.$http
                .delete("http://localhost:8000/api/clients/delete/" + id)
                .then(function(response) {
                    this.$router.push({path: '/', query:{alert: 'Client deleted successfully'}});
                });
         this.$router.push({path: '/', query:{alert: 'Client deleted successfully'}});       
        }
        */
    },
    created: function() {
        this.fetchClient(this.$route.params.id);
    }
};
</script>

<!--<template>
    <div id="body">
        <div class="about container">
            <div>
                <Alert v-if="alert" v-bind:message="alert"/>
                <h1 class="page-header">Edit Client Details</h1>
                <form v-on:submit="updateClient">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="firstname"
                            v-model="update.firstname"
                        />
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname"
                        v-model="update.lastname" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" 
                        v-model="update.email"/>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date Of Birth</label>
                        <input
                            type="date"
                            class="form-control"
                            id="dob"
                            v-model="client.dob"
                        />
                    </div>

                    <div class="form-group">
                        <label for="primary_legal_counsel"
                            >Primary Legal Counsel</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="primary_legal_counsel"
                            v-model="update.primary_legal_counsel"
                        />
                    </div>

                    <div class="form-group">
                        <label for="profile_image"
                            >Upload Profile Image</label
                        >
                        <input
                            type="file"
                            accept="image/*"
                            class="form-control-file"
                            id="profile_image"
                            @change="onFileChange"   
                        />
                    </div>

                    <div class="form-group">
                        <label for="case_details">Case Details</label>
                        <textarea class="form-control" rows="10" id="case_details"
                        v-model="update.case_details"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
import Alert from './Alert';
export default {
    name: "add",
    components: { Alert },
    data() {
        return {
            client: {},
            file: null,
            update: {}
        };
    },
    methods : {

        fetchClient(id) {
            this.$http
                .get("http://localhost:8000/api/clients/view/" + id)
                .then(function(response) {
                    this.update = response.body.data;
                    
                });
        },
        updateClient(e){
          e.preventDefault();
          if(!this.client.firstname || !this.client.lastname || !this.client.email){
               //console.log('please fill in the required fields')
                this.alert = 'please fill in the required fields';
          }else{

              if(this.onFileChange){
                  
              }else{
                  

              }                

              let updateClient = {
                  firstname : this.client.firstname,
                  lastname : this.client.lastname,
                  email : this.client.email,
                  primary_legal_counsel : this.client.primary_legal_counsel,
                  dob : this.client.dob,
                  firstname : this.client.firstname,
                  case_details : this.client.case_details,
                  profile_image : this.client.profile_image = 'default-avatar.png' ? "" : this.client.profile_image

              }
              
             /*this.$http
                .put("http://localhost:8000/api/clients/update/"+this.$route.params.id, updateClient)
                .then(function(response) {
                    //Redirect after insertion
                    this.$router.push({path: '/', query:{alert: 'Client updated successfully'}});
                });
                */
               console.log(updateClient);

          }
        },

        onFileChange(e) {
            //this.client.profile_image = "";
            let file = e.target.files[0];
            var reader = new FileReader();
            reader.onloadend = () => {
                this.client.profile_image = reader.result;
                
            };

            reader.readAsDataURL(file);
          console.log(this.client.profile_image);  
        }
    },
    created: function(){
        this.fetchClient(this.$route.params.id);
    }
};
</script>
-->
<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    Ronde aanpassen
                    <router-link to="/admin/shippingrounds" class="btn btn-link float-right">Back</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input type="text" name="name" id="name" class="form-control" v-model="shippinground.name" :class="{ 'is-invalid': errors.name }">
                            <span class="invalid-feedback" v-if="errors.name">
                                <strong>{{ errors.name[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="description">Inhoud</label>
                            <input type="text" name="description" id="description" class="form-control" v-model="shippinground.description" :class="{ 'is-invalid': errors.description }">
                            <span class="invalid-feedback" v-if="errors.description">
                                <strong>{{ errors.description[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="description">Extra opmerking</label>
                            <input type="text" name="extra_remark" id="extra_remark" class="form-control" v-model="shippinground.extra_remark" :class="{ 'is-invalid': errors.extra_remark}">
                            <span class="invalid-feedback" v-if="errors.extra_remark">
                              <strong>{{ errors.extra_remark[0] }}</strong>
                            </span>
                        </div>                         
                        <div class="form-group">
                            Huidig bestand 1 : <router-link :to="shippinground.file1" target= "_blank" class="button">{{shippinground.file1}}</router-link><br>
                            <label>File
                              <input type="file" id="file1" ref="file1" v-on:change="handleFileUpload1()"/>
                            </label>
                        </div>
                        <div class="form-group">
                            Huidig bestand 2 : <router-link :to="shippinground.file2" target= "_blank" class="button">{{shippinground.file2}}</router-link><br>
                            <label>File
                              <input type="file" id="file2" ref="file2" v-on:change="handleFileUpload2()"/>
                            </label>
                        </div>
                        <div class="form-group">
                            Huidig bestand 3 : <router-link :to="shippinground.file3" target= "_blank" class="button">{{shippinground.file3}}</router-link><br>
                            <label>File
                              <input type="file" id="file3" ref="file3" v-on:change="handleFileUpload3()"/>
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Aanpassen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        name: "ShippingroundsEdit",
        props: ['id'],
        data() {
            return {
                errors: {},
                shippinground: {},
                file1:'',
                file2:'',
                file3:'',                
            }
        },
        methods: {    
        
            handleFileUpload1(){
              this.file1 = this.$refs.file1.files[0];


            },
            handleFileUpload2(){

              this.file2 = this.$refs.file2.files[0];

            },
            handleFileUpload3(){

              this.file3 = this.$refs.file3.files[0];

            },
            
            
           submit(e) {
                let formData = new FormData(e.target)
                formData.append('_method', 'PUT')
                
                
                if(this.file1 != ''){formData.append('file1', this.file1)};
                if(this.file2 != ''){formData.append('file2', this.file2)};
                if(this.file3 != ''){formData.append('file3', this.file3)};
                
                axios.post(`/shippingrounds/${this.id}`, formData, { 
                  headers: {
                  'Content-Type': 'multipart/form-data'
                  }
                })
                
                .then(response => {
                    if (response.data.success) {
                        this.$router.push('/admin/shippingrounds')
                    }
                })
            }
        },
        mounted() {
            axios.get(`/shippingrounds/${this.id}/edit`)
            .then(response => this.shippinground = response.data.shippinground)
        }
    }
</script>

<style scoped>

</style>
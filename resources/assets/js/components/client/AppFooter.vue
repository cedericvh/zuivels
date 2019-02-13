<template>
    <footer class="site-footer mt-3" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">

                    <h6>Zuivelhandel Els en wim</h6>

                    <p>03 502 89 55</p>
                    <p>Nijverheidsstraat 13<br>
                    2570 Duffel</p>
                    <p><a href="mailto:info@zuivelhandelelsenwim.be">info@zuivelhandelelsenwim.be</a></p>
                    <p>BTW : BE 0702.708.778</p>

                    <form @submit.prevent="submit">
                            <div class="form-group">
                                
                                <input type="text" class="form-control" name="name" id="name" v-model="fields.name" placeholder="UW NAAM"/>
                                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
                            </div>

                            <div class="form-group">
                                
                                <input type="text" class="form-control" name="adres" id="adres" v-model="fields.adres" placeholder="UW ADRES EN GEMEENTE"/>
                                <div v-if="errors && errors.adres" class="text-danger">{{ errors.adres[0] }}</div>
                            </div>

                                                        
                            <div class="form-group">
                                
                                <input type="email" class="form-control" name="email" id="email" v-model="fields.email"  placeholder="UW E-MAIL"/>
                                <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
                            </div>

                            <div class="form-group">
                                
                                <textarea class="form-control" id="message" name="message" rows="5" v-model="fields.message" placeholder="UW BERICHT"></textarea>
                                <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
                            </div>

                            <button type="submit" class="btn btn-primary">NU VERSTUREN</button>
                        </form>

                </div>
                <div class="map_small col-md-6 col-sm-12 d-flex align-items-end justify-content-center">
                    <img src="/images/map_small.jpg" alt="map_small">
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        name: "AppFooter",
        
        
        data() {
          return {
            fields: {},
            errors: {},
          }
        },
        methods: {
          submit() {
            this.errors = {};
            axios.post('/submit', this.fields).then(response => {
              alert('Message sent!');
            }).catch(error => {
              if (error.response.status === 422) {
                this.errors = error.response.data.errors || {};
              }
            });
          },
        },
        
        
        
    }
</script>

<style scoped>

</style>
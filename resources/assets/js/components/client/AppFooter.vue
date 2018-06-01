<template>
    <footer class="site-footer mt-3" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12">

                    <a href="index.html" class="logo">
                        <img src="/images/logo@2x.png" alt="logo">
                    </a>

                    <h6>Zuivelhandel Els en wim</h6>

                    <p>03/502 85 53</p>
                    <p>adres</p>
                    <p><a href="mailto:info@elsenwim.be">info@elsenwim.be</a></p>
                    <p>BTW : XXXXXXXXX</p>

                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="UW NAAM">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="UW E-MAIL">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" cols="10" rows="3" placeholder="UW BERICHT"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit">nu versturen</button>
                        </div>
                    </form>

                </div>
                <div class="map_small col-md-5 col-sm-12 d-flex align-items-end justify-content-center">
                    <img src="/images/map_small.jpg" alt="map_small">
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
    export default {
        name: "AppFooter"
    }
</script>

<style scoped>

</style>
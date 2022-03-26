<template>
    <div> 
        <!-- App.vue -->

            <v-app>

               <!-- Responsive navbar-->
             <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-top: -50px;border-radius: 0px;">
                <div class="container">
                    <router-link class="navbar-brand" to="/">iceandfire</router-link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><router-link class="navbar-brand" to="/"><i class="info-icon icon_book_alt"></i> Books</router-link></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sizes your content based upon application components -->
            <v-main>

                <!-- Provides the application the proper gutter -->
                <v-container fluid>

                <!-- If using vue-router -->
                <router-view style="margin-top: 100px"></router-view>
                </v-container>
            </v-main>

            <v-footer app>
                <!-- -->
            </v-footer>
            </v-app>

    </div>
</template>
 
<script>
    export default {}
</script>

<style>
.lds-ripple {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid #dfc;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}

</style>
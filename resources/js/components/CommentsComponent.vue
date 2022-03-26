<template>
    <div>
        <!-- Main Body -->
        <section>
            <div class="container">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><router-link to="/"><i class="info-icon icon_book_alt"></i> Books</router-link></li>
                        <li class="breadcrumb-item  active"  aria-current="page"><i class="info-icon icon_comment_alt"></i> Comments in {{ $route.params.name }} </li>
                    </ol>
                    </nav>
                </div>
            </div>
            <div class="container mb-5 p-5">
                <div class="row d-flex justify-content-center mt-100 mb-100">
                    <div class="col-lg-8">
                        <v-card elevation="2" shaped>
                            <textarea name="" id="" cols="20" rows="10" style="height: 100%" v-model="comment" maxlength="500" placeholder="Leave a comment" class="form-control" required></textarea>
                           <v-card-actions>
                               <v-btn style="float:right;color: #fff" color="black" @click="post()">Post a comment</v-btn>
                           </v-card-actions>
                            
                        </v-card>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-100 mb-100">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="card-title" style="color: #000">Latest Comments ({{comments.length}})</h4>
                            </div>
                            <div class="comment-widgets">
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row m-t-0 p-4" v-for="comment in comments" :key="comment.id">
                                    <div class="p-4"> <v-avatar color="grey">
                                            <i class="info-icon icon_comment_alt" style="color: white"></i> 
                                            </v-avatar></div>
                                    <div class="comment-text w-100">
                                        <h6 class="font-medium">{{ comment.client_ip }}</h6> <span class="m-b-15 d-block">{{ comment.comment }} </span> <br>
                                        <div class="comment-footer"> <span class="text-muted float-right">{{ comment.created_at }}</span> </div>
                                    </div>
                                    <hr style="color: #000">
                                </div> <!-- Comment Row -->
                            </div> <!-- Card -->
                        </div>
                    </div>
                </div>
                </div>
                 <v-overlay :value="loading">
                    <div class="lds-ripple"><div></div><div></div></div>
                </v-overlay>
        </section>
    </div>
</template>

<script>
    // import moment from 'moment';
    export default {
        data() {
            return {
                loading: false,
                comments: [],
                comment: '',
                responsed: ''
            }
        },
        mounted () {
            this.loading  = true
                axios.get('/api/comments', { params: { name: this.$route.params.name} })
                    .then(response => {
                    // JSON responses are automatically parsed.
                    this.comments = response.data
                    this.loading  = false
                    })
                    .catch(e => {
                        this.errors.push(e)
                         this.loading  = false
                    })
        },
        methods: {
            post () {
            this.loading  = true
                axios.post('/api/comment', { book: this.$route.params.name, comment: this.comment })
                    .then(response => {
                    // JSON responses are automatically parsed.
                    console.log(response)
                    this.responsed  = response.data
                    this.loading  = false
                    this.$router.go(this.$router.currentRoute)      
                    this.comment = ''
                    })
                    .catch(e => {
                        this.errors.push(e)
                         this.loading  = false
                    })
            }
        }
    }
</script>

<style scoped>
.navbar-nav {
    width: 100%
}

@media(min-width:568px) {
    .end {
        margin-left: auto
    }
}

@media(max-width:768px) {
    #post {
        width: 100%
    }
}

#clicked {
    padding-top: 1px;
    padding-bottom: 1px;
    text-align: center;
    width: 100%;
    background-color: #ecb21f;
    border-color: #a88734 #9c7e31 #846a29;
    color: black;
    border-width: 1px;
    border-style: solid;
    border-radius: 13px
}

#profile {
    background-color: unset
}

#post {
    margin: 10px;
    padding: 6px;
    padding-top: 2px;
    padding-bottom: 2px;
    text-align: center;
    background-color: #ecb21f;
    border-color: #a88734 #9c7e31 #846a29;
    color: black;
    border-width: 1px;
    border-style: solid;
    border-radius: 13px;
    width: 50%
}

body {
    background-color: black
}

#nav-items li a,
#profile {
    text-decoration: none;
    color: rgb(224, 219, 219);
    background-color: black
}

.comments {
    margin-top: 5%;
    margin-left: 20px
}

.darker {
    border: 1px solid #ecb21f;
    background-color: black;
    float: right;
    border-radius: 5px;
    padding-left: 40px;
    padding-right: 30px;
    padding-top: 10px
}

.comment {
    border: 1px solid rgba(16, 46, 46, 1);
    background-color: rgba(16, 46, 46, 0.973);
    float: left;
    border-radius: 5px;
    padding-left: 40px;
    padding-right: 30px;
    padding-top: 10px
}

.comment h4,
.comment span,
.darker h4,
.darker span {
    display: inline
}

.comment p,
.comment span,
.darker p,
.darker span {
    color: rgb(184, 183, 183)
}

h1,
h4 {
    color: white;
    font-weight: bold
}

label {
    color: rgb(212, 208, 208)
}

#align-form {
    margin-top: 20px
}

.form-group p a {
    color: white
}

#checkbx {
    background-color: black
}

#darker img {
    margin-right: 15px;
    position: static
}

.form-group input,
.form-group textarea {
    background-color: black;
    border: 1px solid rgba(16, 46, 46, 1);
    border-radius: 12px
}

form {
    border: 1px solid rgba(16, 46, 46, 1);
    background-color: rgba(16, 46, 46, 0.973);
    border-radius: 5px;
    padding: 20px
}
</style>
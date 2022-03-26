<template>
    <div>
       
        <section>
            <div class="container">
                <div class="row intro-tables" style="color: #000">
                    <div class="col-md-4"  v-for="book in books" :key="book.name">
                        <div class="intro-table intro-table-hover">
                            <template >
                                <h5 class="hide-hover"  style="color: #fff" v-for="author in book.authors" :key="author">{{ author }}</h5>
                            </template>
                            <div class="bottom">
                                
                                <h4 class="small-pt" style="color: #fff">{{ book.name }} </h4>
                                <h4 class="small-pt" style="font-size: 12px;letter-spacing: 2px;color: #fff">Released on {{  getHumanDate(book.released) }} </h4>
                                <div class="reveal expand" style="margin-top: px">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="small-pt" style="font-size: 12px;letter-spacing: 2px;color: #fff">ISBN: {{ book.isbn }} </h4>
                                            <h4 class="small-pt" style="font-size: 12px;letter-spacing: 2px;color: #fff"> {{ book.mediaType }},{{ book.numberOfPages }} pages</h4>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div  style="float: right;margin-left: 5px"><router-link :to="{ name: 'comments', params: { name: book.name } }"  class="comment-btn" data-toggle="tooltip" data-placement="bottom" title="Comments"> | Comment <i class="info-icon icon_comment_alt"></i></router-link></div>
                        
                        <div  style="float: right;margin-left: 5px"><router-link :to="{ name: 'characters', params: { book_id: getID(book.url) } }"  class="comment-btn" data-toggle="tooltip" data-placement="bottom" title="Characters">Characters <i class="info-icon icon_star_alt"></i></router-link></div>
                        
                        <div  style="padding-right: 5px;color: #aaa" v-for="comment in comments" :key="comment.id">
                            <span v-if="book.name === comment.book_name">{{ comment.count }} Comments</span>
                        </div>
                        
                    </div>
                <v-overlay :value="loading">
                    <div class="lds-ripple"><div></div><div></div></div>
                </v-overlay>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
    import moment from 'moment';
    export default {
        data() {
            return {
                loading: false,
                books: [],
                comments: [],
            }
        },
        mounted () {

            // consume books api 
                this.loading  = true
                axios.get(`api/books`)
                    .then(response => {
                    // JSON responses are automatically parsed.
                    this.books = response.data
                    this.loading  = false
                    })
                    .catch(e => {
                        this.errors.push(e)
                         this.loading  = false
                    })


            // consume api to get commentsd
                this.loading  = true
                axios.get(`api/get-comments-count`)
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
            getHumanDate : function (date) {
                return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
            },
            getID : function (url) {
                const last = url.charAt(url.length - 1);
                return last;
            }

        }   
    }
</script>

<style scoped>
.reveal {
    display: inline-block;
	/* padding: 1px 16px; */
}

.comment-btn {
    background-color: transparent;
    border-color: transparent;
    color: blue;
}
.comment-btn:hover {
    color: red;
}

</style>
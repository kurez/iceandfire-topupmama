<template>
<div>
        <!-- Main Body -->
        <section>
            <div class="container">
                <div class="row">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><router-link to="/"><i class="info-icon icon_book_alt"></i> Books</router-link></li>
                        <li class="breadcrumb-item  active"  aria-current="page"><i class="info-icon icon_star_alt"></i> Characters in {{ $route.params.book_name }}</li>
                    </ol>
                    </nav>
                </div>
            </div>
            <div class="container mb-5">
                <div class="row">
                    <h4>Sort</h4>
                    <div class="col-6">
                        <v-select
                        v-model="criteria"
                        @change="sortChar()"
                        :items="opt.criteria"
                        label="Select Sort Criteria"
                        outlines
                        ></v-select>
                       
                    </div>
                    <div class="col-6">
                         <v-select
                         v-if="criteria !== null"
                        v-model="sort" 
                        @change="sortChar()"
                        :items="opt.sort"
                        label="Select Sort Mode"
                        outlines
                        ></v-select>
                         <v-select
                         v-else
                        v-model="sort" 
                        @change="sortChar()"
                        :items="opt.sort"
                        label="Select Sort Mode"
                        outlines
                        disabled
                        ></v-select>
                    </div>
                    
                </div>
                <div class="row">
                    <h4>Filter By Gender</h4>
                    <div class="col-6">
                        <v-select
                        v-model="filter_gender" 
                        @change="sortChar()"
                        :items="opt.gender"
                        label="Select Filter Gender"
                        outlines
                        ></v-select>
                       
                    </div>
                    <div class="col-6">
                        <v-select
                        v-model="page" 
                        @change="sortChar()"
                        :items="opt.pages"
                        label="Select Page"
                        outlines
                        ></v-select>
                       
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-100 mb-100">
                    <div class="col-lg-12">
                        <v-subheader>{{ count }} characters. </v-subheader>
                        <v-card>
                        <v-simple-table>
                            
                            <template v-slot:default>
                            <thead>
                                <tr>
                                <th class="text-left">
                                    Name
                                </th>
                                <th class="text-left">
                                    Gender
                                </th>
                                <th class="text-left">
                                    Born
                                </th>
                                <th class="text-left">
                                    Died
                                </th>
                                <th class="text-left">
                                    URL
                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                v-for="item in characters"
                                :key="item.url"
                                >
                                <td>{{ item.name }}</td>
                                <td>{{ item.gender }}</td>
                                <td>{{ item.born }}</td>
                                <td>{{ item.died }}</td>
                                <td>{{ item.url }}</td>
                                </tr>
                            </tbody>
                            </template>
                        </v-simple-table>
                        </v-card>
                    </div>
                </div>
                <v-overlay :value="loading">
                    <div class="lds-ripple"><div></div><div></div></div>
                </v-overlay>
            </div>
        </section>
</div>
</template>

<script>
  export default {
    data () {
      return {
        loading: false,
        characters: [],
        count: 0,
        sort: 'Asc',
        criteria: 'Name',
        filter_gender: 'All',
        page: 1,
        opt: {
            criteria: ['Gender','Name','Age'],
            sort: ['Asc','Desc'],
            gender: ['Male','Female','All'],
            pages: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20]
        }
      }
    },
    mounted() {
        this.loading  = true
        this.sortChar();
    },
    methods: {
        sortChar() {
               this.loading  = true
                axios.get('/api/characters', { params: {
                        name: this.$route.params.book_id,
                        sort: this.sort,
                        criteria: this.criteria.toLowerCase(),
                        gender: this.filter_gender,
                        page: this.page,

                }})
                    .then(response => {
                    // JSON responses are automatically parsed.
                    console.log(response)
                    this.characters = response.data.data
                    this.count = response.data.count
                    this.loading  = false
                    })
                    .catch(e => {
                        this.errors.push(e)
                         this.loading  = false
                    })
        }
    }
  }
</script>
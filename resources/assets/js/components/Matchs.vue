<template>
    <div>
        <h2>Matchs</h2>
        <form @submit.prevent="addMatch" class="mb-3">
            <div class="form-group">
                <label>Status</label>
                <input class="form-control" type="text" placeholder="status" v-model="match.status">
                <label>Jour de competition</label>
                <input class="form-control" type="number" placeholder="jour de compet" v-model="match.matchday">
                <label>Equipe 1</label>
                <input class="form-control" type="text" placeholder="equipe 1" v-model="match.homeTeamName">
                <label>Equipe 2</label>
                <input class="form-control" type="text" placeholder="equipe 2" v-model="match.awayTeamName">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a @click="fetchMatchs(pagination.prev_page_url)" class="page-link" href="#">Previous</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">Page {{pagination.current_page}} sur {{pagination.last_page}}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a @click="fetchMatchs(pagination.next_page_url)" class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
        <div class="card mb-3" v-for="match in matchs" v-bind:key="match.id">
            <div class="card-header">
                <h3>{{match.status}}</h3>
                <h4>{{match.matchday}}</h4>
            </div>
            <div class="card-body">
                <p>{{match.homeTeamName}} vs {{match.awayTeamName}}</p>
                <h3>Résultats</h3>
                <p>{{match.results.result_GoalsHomeTeam}} - {{match.results.result_GoalsAwayTeam}}</p>
                <hr>
                <button @click="deleteMatch(match.id)" class="btn btn-success">Supprimer</button>
                <button @click="editMatch(match)" class="btn btn-danger">Modifier</button>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        name:'matchs',
        data() {
            return {
                matchs: [],
                match: {
                    //id:'',
                    status:'',
                    matchday:'',
                    homeTeamName:'',
                    awayTeamName:''
                },
                matchs_id:'',
                pagination: {},
                edit: false
            }
        },
        created() {
            this.fetchMatchs();
        },
        methods: {
            fetchMatchs(page_url) {
                let self = this;
                page_url = page_url || '/api/matchs';
                fetch(page_url).then(response=>response.json()).then(response=>{
                    /*console.log(response.data)
                    console.log(response)*/
                    this.matchs = response.data;
                    self.makePagination(response.meta, response.links);
                })
                .catch(err => console.log(err))
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                }
                this.pagination = pagination;
            },
            deleteMatch(id){
                if(confirm('etes vous sur')){
                    fetch(`api/matchs/${id}`,{
                        method: 'delete'
                    }).then(response => response.json()).then(response=>{
                        alert('Matchs supprimé');
                        this.fetchMatchs();
                    }).catch(err => console.log(err))
                }
            },
            addMatch() {
               if (this.edit === false) {
                   //add
                   //console.log(this.match);
                   //console.log(JSON.stringify(this.match));
                   fetch('api/matchs', {
                       method: 'post',
                       body: JSON.stringify(this.match),
                       headers: {
                           'content-Type': 'application/json'
                       }
                   }).then(response => response.json()).then(response=>{
                       this.match.status = '';
                       this.match.matchday = '';
                       this.match.homeTeamName = '';
                       this.match.awayTeamName = '';
                       alert('match ajouté');
                       this.fetchMatchs();
                   }).catch(err => console.log(err));
               } else {
                   //update
                   fetch('api/matchs' ,{
                       method: 'put',
                       body: JSON.stringify(this.match),
                       headers: {
                           'content-Type': 'application/json'
                       }
                   }).then(response => response.json()).then(response=>{
                       this.match.status = '';
                       this.match.matchday = '';
                       this.match.homeTeamName = '';
                       this.match.awayTeamName = '';
                       alert('match modifié');
                       this.fetchMatchs();
                   }).catch(err => console.log(err));
               }
            },
            editMatch(match) {
                this.edit = true;
                this.match.id = match.id;
                this.match.match_id = match.id;
                this.match.status = match.status;
                this.match.matchday = match.matchday;
                this.match.homeTeamName = match.homeTeamName;
                this.match.awayTeamName = match.awayTeamName;
            }
        }
    }
</script>
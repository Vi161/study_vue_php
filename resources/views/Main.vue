<template>
  <div class="container">
    <h1>My films</h1>
    <div class="row">
      <div class="col-12 mx-auto pt-4 text-left">
        <label for="name" class="pr-3">User Name: </label>
        <input type="text"
               class="form-group"
               name="name"
               id="name"
               v-model="name"
        >
        <button @click="saveName()">
          Save
        </button>
        <div class="col-12 mx-auto pt-4 text-left border-top mt-4">
          <h5 class="pl-2">My Selectrd Films:</h5>
          <ul class="d-flex flex-wrap"
          >
            <li class="card custom-card d-flex justify-content-center align-items-center p-2"
                v-for="(el, i) in myFilms"
                :key="i"
            >
              <a href="javascript:void(0)"
                 class="w-100 h-100 d-flex justify-content-center align-items-center"
                 @click="unselectFilm(el.id)"
              >
                {{el.name}}
              </a>
            </li>
          </ul>
        </div>
        <div class="col-12 mx-auto pt-4 text-left border-top mt-4">
          <h5 class="pl-2">Films</h5>
          <ul class="d-flex flex-wrap"
          >
            <li class="card custom-card d-flex justify-content-center align-items-center p-2"
                v-for="(el, i) in films"
                :key="i"
            >
              <a href="javascript:void(0)"
                 class="w-100 h-100 d-flex justify-content-center align-items-center"
                  @click="selectFilm(el.id)"
              >
                {{el.name}}
              </a>
            </li>
          </ul>
          <button type="submit"
                  @click="sortByName()"
          >
            Sort by name
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "main",
    data() {
      return {
        name: '',
        users: [
          {
            id: 1,
            name: 'Вова'
          }
        ],
        myFilms: [],
        films: [

        ],
      }
    },
    mounted() {
      this.getFilms()
    },
    methods: {
      getFilms() {
        window.axios.get('http://myfilms.loc/films.php ')
        .then((response) => {
          this.films = (Object.values(response.data))
        }).catch(e => {
          console.log('err', e.response.data.message);
        })
      },
      sortByName() {
        this.films.sort((a, b) => (a.name > b.name) ? 1 : -1);
      },
      selectFilm(id) {
        let films = this.films;
        let selectedFilm = films.filter(el => el.id == id);
        let filmInList = this.myFilms.filter(el => el.id == id);
        if (filmInList.length == 0) {
          this.myFilms.push(selectedFilm[0])
        }
      },
      unselectFilm(id) {
        let unselected = this.myFilms.filter(el => el.id !== id);
        this.myFilms = unselected;
      },
      saveName() {
        window.axios.post('http://myfilms.loc/usersfilms.php',
          {
            name: this.name,
            myFilms: this.myFilms
          })
        .then((response) => {
          console.log('save', response)
        }).catch(e => {
          console.log('err', e.response.data.message);
        })
      }
    }
  }
</script>

<style scoped>
.custom-card {
  display: block;
  width: 150px;
  height: 150px;
  pointer-events: visible;
}
</style>

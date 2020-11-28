<template>
  <div>

    <event-header-component :user_type_id="user.user_type_id"></event-header-component>

    <div v-for="event in events">
      <event-overview-component :event="event"></event-overview-component>
    </div>

    <span v-if="user.user_type_id === 2">
      <router-link v-bind:to="{name: 'events.create'}">
        <button class="search-btn" >
          <i class="fas fa-circle-notch fa-2x"></i>
        </button>
      </router-link>
    </span>


  </div>
</template>

<script>
  import EventHeaderComponent from './EventHeaderComponent';
  import EventOverviewComponent from './EventOverviewComponent';

  export default {
    data () {
      return {
        user: {},
        events: '',
      }
    },
    created () {
      axios.get('/api/events')
        .then((res) => {
          this.events = res.data;
          axios.get('api/me')
            .then((res) => {
              this.user = res.data;
            })
            .catch((error) => {
              this.isError = true;
            });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    components: {
      EventHeaderComponent,
      EventOverviewComponent
    }
  }
</script>>

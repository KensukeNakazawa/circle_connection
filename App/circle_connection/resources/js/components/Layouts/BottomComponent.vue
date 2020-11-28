<template>
  <nav class="navbar navbar-default fixed-bottom navbar-light bg-light">
    <div class="row">
      <div class="col">
        <router-link v-bind:to="{name: 'home'}">
          <span class="nav-link"><i class="fas fa-home fa-2x"></i></span>
        </router-link>
      </div>
      <div class="col">
        <router-link v-bind:to="{name: 'events'}">
          <span class="nav-link"><i class="fas fa-gem fa-2x"></i></span>
        </router-link>
      </div>
      <div class="col">
        <router-link v-bind:to="{name: 'profiles'}">
          <span class="nav-link"><i class="fas fa-search fa-2x"></i></span>
        </router-link>
      </div>
      <div class="col">
        <router-link v-bind:to="{name: 'user'}">
          <span class="nav-link"><i class="fas fa-user fa-2x"></i></span>
        </router-link>
      </div>
    </div>
  </nav>
</template>

<script>
</script>

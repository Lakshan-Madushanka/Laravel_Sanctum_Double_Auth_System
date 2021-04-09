<template>
  <div class="about">
    <h1>Simple authentication system</h1>
    <p>Used laravel sanctum package for SPA authentication</p>
    <p>Front end developed using vue js</p>
    <h3 class="features"><em>Features :</em></h3>
    <ul class="list-group feature-list">
      <li class="list-group-item">Email verificatio</li>
      <li class="list-group-item">SPA authentication</li>
      <li class="list-group-item">CSRF attack prevention</li>
      <li class="list-group-item">
        Also sanctum api tokens can use to other devices[mobile etc...]
      </li>
    </ul>
  </div>
</template>


<style scoped>
.about {
  margin-top: 100px;
}
.feature-list {
  font-style: italic;
}
</style>
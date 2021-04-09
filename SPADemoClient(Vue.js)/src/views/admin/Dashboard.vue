<template>
  <div id="wrapper" class="d-flex" :class="{ toggled: displaySidebar }">
    <!-- Sidebar -->
    <app-admin-side-nav-bar></app-admin-side-nav-bar>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <header>
        <button
          class="btn btn-primary"
          id="menu-toggle"
          @click="displaySidebar = !displaySidebar"
        >
          Toggle Menu
        </button>

        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <h5 class="nav-header">Welcome Admin</h5>
      </header>
      <div class="container-fluid">
        <app-table></app-table>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
</template>
<!-- Bootstrap core JavaScript -->

<!-- Menu Toggle Script -->
<script>
import AdminSideNavBar from "../../components/admin/SideNavBar";
import Table from "../../components/Table";
export default {
  data() {
    return {
      displaySidebar: false,
    };
  },
  components: {
    appAdminSideNavBar: AdminSideNavBar,
    appTable: Table,
  },
  methods: {
    // toggleSidebar() {
    //   thi: this.diaplaySidebarfalse
    // }
  },
};
</script>

<style scoped>
/*!
 * Start Bootstrap - Simple Sidebar (https://startbootstrap.com/template/simple-sidebar)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
 */

#wrapper {
  overflow-x: auto;
}

#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin 0.25s ease-out;
  -moz-transition: margin 0.25s ease-out;
  -o-transition: margin 0.25s ease-out;
  transition: margin 0.25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }

  .collapse-item {
    border-bottom: 1px solid rgb(221, 217, 217);
    padding: 5px;
    font-size: 13px;
  }

  .collapse-item:hover {
    background-color: rgb(190, 190, 190);
    text-decoration: none;
  }

  .nav-header {
    text-align: center;
    color: rgb(19, 138, 235);
    margin-top: 5px;
  }

  header {
    display: flex;
    justify-content: space-between;
    padding: 10px;
  }
}
</style>

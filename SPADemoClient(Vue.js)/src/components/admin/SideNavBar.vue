<template>
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading"><i>Admin Area</i></div>
    <div class="list-group list-group-flush">
      <ul
        className="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
        id="accordionSidebar"
      >
        <a href="#" class="list-group-item list-group-item-action bg-light"
          >Dashboard</a
        >
        <a href="#" class="list-group-item list-group-item-action bg-light"
          >Shortcuts</a
        >
        <a href="#" class="list-group-item list-group-item-action bg-light"
          >Overview</a
        >
        <a href="#" class="list-group-item list-group-item-action bg-light"
          >Events</a
        >

        <a href="#" class="list-group-item list-group-item-action bg-light"
          >Profile</a
        >
        <a href="#" class="list-group-item list-group-item-action bg-light"
          >Status</a
        >
        <!-- drop down -->
        <a
          className="nav-link collapsed list-group-item list-group-item-action bg-light"
          href="#!"
          data-toggle="collapse"
          data-target="#collapseUtilities"
          aria-expanded="true"
          aria-controls="collapseUtilities"
        >
          <i className="fas fa-fw fa-wrench"></i>
          <span>Utilities</span> &nbsp;
          <span class="fas fa-caret-down"></span>
        </a>
        <div
          id="collapseUtilities"
          className="collapse"
          aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar"
        >
          <div
            className="bg-white py-2 collapse-inner rounded"
            style="display: flex; flex-direction: column"
          >
            <!-- <h6 className='collapse-header'>Custom Utilities:</h6> -->
            <a
              className="collapse-item list-group-item list-group-item-action bg-light"
              href="#!"
            >
              Colors
            </a>
            <a className="collapse-item" href="utilities-border.html">
              Borders
            </a>

            <a className="collapse-item" href="utilities-animation.html">
              Animations
            </a>

            <a className="collapse-item" href="utilities-other.html"> Other </a>
          </div>
        </div>
        <a href="#" class="list-group-item list-group-item-action bg-light"
          >Status
        </a>
      </ul>
    </div>
  </div>
  <!-- /#sidebar-wrapper -->
</template>

<style scoped>
.list-group-item {
  color: #2c3e50 !important;
}
#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
  color: rgb(26, 105, 179);
}

#sidebar-wrapper .list-group {
  width: 15rem;
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

  .navbar-nav {
    font-weight: bold;
  }

  .collapse-item {
    color: #007bff;
    background-color: transparent !important;
  }
}
</style>
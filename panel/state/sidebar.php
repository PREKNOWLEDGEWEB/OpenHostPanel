<nav id="sidebar" class="sidebar js-sidebar">
   <div class="sidebar-content js-simplebar">
      <a class="sidebar-brand" href="index.html">
      <span class="align-middle">OpenHostPanel Panel</span>
      </a>
      <ul class="sidebar-nav">
         <li class="sidebar-header">
            OHS
         </li>
         <li class="sidebar-item" onclick="window.location.reload()">
            <a class="sidebar-link" href="#">
                <i class="align-middle" data-feather="sliders"></i> 
                <span class="align-middle">Dashboard</span>
            </a>
         </li>
         <li class="sidebar-item" onclick="loadPage('activeIssue')">
            <a class="sidebar-link" href="#">
                <i class="align-middle" data-feather="alert-circle"></i> 
                <span class="align-middle">Active Issues</span>
            </a>
         </li>
         <li class="sidebar-item" onclick="loadPage('webSites')">
            <a class="sidebar-link" href="#">
                <i class="align-middle" data-feather="globe"></i> 
                <span class="align-middle">My Sites</span>
            </a>
         </li>
      </ul>
   </div>
</nav>

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->firstname.' '.Auth::user()->lastname}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online {{Auth::user()->domain_name}}</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
    </div>
  </form>
  <!-- /.search form -->

  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <!-- Sales -->
    <li class="treeview sales">
      <a href="/accounts">
        <i class="fa fa-laptop"></i> <span>Accounts</span>        
      </a>      
    </li>
    <li class="treeview sales">
      <a href="/checkbook">
        <i class="fa fa-laptop"></i> <span>Check Book</span>        
      </a>      
    </li>
    <li class="treeview sales">
      <a href="/check-issuance">
        <i class="fa fa-laptop"></i> <span>Check Issuance</span>        
      </a>      
    </li>
    <li class="treeview sales">
      <a href="/check-warehouse">
        <i class="fa fa-laptop"></i> <span>Check Warehouse</span>        
      </a>      
    </li>
    <li class="treeview sales">
      <a href="/check-cance">
        <i class="fa fa-laptop"></i> <span>Check Cancel</span>        
      </a>      
    </li>
    <li class="treeview sales">
      <a href="/check-settle">
        <i class="fa fa-laptop"></i> <span>Check Settle</span>        
      </a>      
    </li>
    <li class="treeview sales">
      <a href="/payee">
        <i class="fa fa-laptop"></i> <span>Payee</span>        
      </a>      
    </li>
    
    
    <!-- /Settings -->
  </ul>
</section>
<!-- / sidebar menu -->

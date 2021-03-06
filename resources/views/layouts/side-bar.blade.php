
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</p>
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
     @if(in_array(Auth::user()->user_level_id,[1]))
    <li class="treeview accounts">
      <a href="/accounts">
        <i class="fa fa-laptop"></i> <span>Accounts</span>        
      </a>      
    </li>
    @endif
    @if(in_array(Auth::user()->user_level_id,[1]))
    <li class="treeview sales">
      <a href="/checkbooks">
        <i class="fa fa-laptop"></i> <span>Check Book</span>        
      </a>      
    </li>
    @endif
    @if(in_array(Auth::user()->user_level_id,[1,2]))
    <li class="treeview check-issuances">
      <a href="/check-issuances">
        <i class="fa fa-laptop"></i> <span>Check Issuance</span>        
      </a>      
    </li>
    @endif
    @if(in_array(Auth::user()->user_level_id,[1]))
    <li class="treeview sales">
      <a href="/check-warehouses">
        <i class="fa fa-laptop"></i> <span>Check Warehouse</span>        
      </a>      
    </li>
    @endif
    @if(in_array(Auth::user()->user_level_id,[1]))
    <li class="treeview cancels">
      <a href="/check-reset">
        <i class="fa fa-laptop"></i> <span>Check Reset</span>        
      </a>      
    </li>
    @endif
    @if(in_array(Auth::user()->user_level_id,[1,3]))
    <li class="treeview check-settle">
      <a href="/check-settle">
        <i class="fa fa-laptop"></i> <span>Check Settle</span>        
      </a>      
    </li>
    @endif
    @if(in_array(Auth::user()->user_level_id,[1]))
    <li class="treeview payees">
      <a href="/payees">
        <i class="fa fa-laptop"></i> <span>Payee</span>        
      </a>      
    </li>
    @endif
    @if(in_array(Auth::user()->user_level_id,[1]))
    <li class="treeview logs">
      <a href="/logs">
        <i class="fa fa-laptop"></i> <span>Logs</span>        
      </a>      
    </li>
    @endif
    @if(in_array(Auth::user()->user_level_id,[1]))
    <li class="treeview payees">
      <a href="/reports">
        <i class="fa fa-laptop"></i> <span>Reports</span>        
      </a>      
    </li>
    @endif
    
    
    <!-- /Settings -->
  </ul>
</section>
<!-- / sidebar menu -->

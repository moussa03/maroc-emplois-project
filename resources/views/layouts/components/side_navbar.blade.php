
<div class="  d-none  d-lg-block col-lg-3 col-xl-3 dashboard-header">
        <div class="dashboard">
       <div class="dashboard-logo"> <img style="width: 70px;height: 70px;" class="rounded-img" src="{{ asset('img/' . $profile_picture)}}">
       </div>
            <div class="dashboard-info">
                <div class="employer_title mb-2">
                <span class="font-weight-bold">{{$username}}</span>
                <span> {{$poste}}</span>
                </div>
                <div class="dashboard-notif">
                    <span><i class="fa fa-bell"></i></span>
                    <span><i class="fa fa-cogs"></i></span>
                    <span><i class="fa fa-power-off"></i></span>
                </div>
            </div>
        </div>
        <div class="dashboard-nav">

                <ul class="fa-ul m-0 mt-5 dash-nav-ul ">
                        {{$dashboard}}
                        {{$profile}}
                        {{$pup_anonnce}}
                        {{$jobs}}
                        {{$single_page}}
                        {{-- <a href=""><li class="p-3">  <span> <i class="fa fa-bell"></i> </span> Candidates Alerts</li>  </a> --}}
                        {{$change_password}}
                        {{$log_out}}
                        {{$delete_profile}}
                </ul>
        </div>
</div>
